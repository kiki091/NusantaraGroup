<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Awards as AwardsInterface;
use App\Models\Cms\AwardsModel as AwardsModels;
use App\Models\Cms\AwardsTransModel as AwardsTransModels;
use App\Services\Transformation\Cms\Awards as AwardsTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class Awards extends BaseImplementation implements AwardsInterface
{
	protected $message;
    protected $awards;
    protected $awardsTrans;
    protected $lastInsertId;
    protected $awardsTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(AwardsModels $awards, AwardsTransModels $awardsTrans, AwardsTransformation $awardsTransformation)
    {
        $this->awards = $awards;
        $this->awardsTrans = $awardsTrans;
        $this->awardsTransformation = $awardsTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params
        ];

        $awardsData = $this->awards($data, 'asc', 'array', true);
       
        return $this->awardsTransformation->getAwardsCmsTransform($awardsData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function awards($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $awards = $this->awards
            ->with('property_location')
            ->with('translation');

        if(isset($data['is_active'])) {
            $awards->isActive($data['is_active']);
        }

        if(isset($data['order_by'])) {
            $awards->orderBy('order', $orderType);
        } 

        if(isset($data['id'])) {
            $awards->id($data['id']);
        }

        if(isset($data['property_location_id'])) {
            $awards->propertyId($data['property_location_id']);
        }


        if(!$awards->count())
            return array();

        if(isset($data['id'])) 
        {
            return $awards->first()->toArray();
        }
        
        return $awards->get()->toArray();
    }

    public function store($data, $property_id)
    {
        try {

            DB::beginTransaction();

            if ($this->storeAwards($data, $property_id) != true) {

                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->storeAwardsTranslation($data) != true) {

                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: THUMBNAIL UPLOAD
            if ($this->uploadThumbnail($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->uploadImages($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_data_general'), true);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Awards
     * @param $data
     * @return mixed
     */

    protected function storeAwards($data, $property_id)
    {
        try {

            $store                          = $this->awards;

            if ($this->isEditMode($data)) {
                $store                      = $this->awards->find($data['id']);
            }

            $store->office_name         = isset($data['office_name']) ? $data['office_name'] : "";
            $store->meta_title          = isset($data['meta_title']) ? $data['meta_title'] : "";
            $store->meta_keyword        = isset($data['meta_keyword']) ? $data['meta_keyword'] : "";
            $store->meta_description    = isset($data['meta_description']) ? $data['meta_description'] : "";

            if (!$this->isEditMode($data)) 
            {
                $store->is_active               = true;
                $store->property_location_id    = $property_id;
                $store->thumbnail               = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
                $store->filename               = $this->uniqueIdImagePrefix . '_' .$data['filename']->getClientOriginalName();
                $store->created_by              = $this->getUserId();
                $store->created_at              = $this->mysqlDateTimeFormat();
                $store->updated_at              = $this->mysqlDateTimeFormat();

            } else {
                //TODO: Edit Mode Thumbnail Checker
                if (!empty($data['thumbnail'])) {
                    $store->thumbnail       = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
                }

                if (!empty($data['filename'])) {
                    $store->filename       = $this->uniqueIdImagePrefix . '_' .$data['filename']->getClientOriginalName();
                }
            }

            if($save = $store->save()) {
                $this->lastInsertId = $store->id;
            }

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Storing Awards Translation to database
     * @param $data
     * @param $key
     * @return bool
     */
    protected function storeAwardsTranslation($data)
    {
        if ($this->isEditMode($data)) {
            $this->removeAwardsTranslation($data['id']);
        }

        $finalData = $this->awardsTransformation->getDataForAwardsTranslation($data['awards'], $this->lastInsertId, $this->isEditMode($data));
        return $this->awardsTrans->insert($finalData);
    }

    /**
     * Remove Awards Translation by ID
     * @param $mainBannerId
     * @return bool
     */
    protected function removeAwardsTranslation($accOfferId)
    {
        if (empty($accOfferId))
            return false;

        return $this->awardsTrans->where('awards_id', $accOfferId)->delete();
    }

    /**
     * Upload Thumbnail
     * @param $data
     * @return bool
     */
    protected function uploadThumbnail($data)
    {
        try {
            if (!$this->isEditMode($data)) {

                if ( !$this->thumbnailUploader($data)) {
                    return false;
                }

            } else {
                //TODO: Edit Mode
                if (!empty($data['thumbnail'])) {
                    if (!$this->thumbnailUploader($data)) {
                        return false;
                    }
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    /**
     * Thumbnail Uploader
     * @param $data
     * @return bool
     */
    protected function thumbnailUploader($data)
    {
        if ($data['thumbnail']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();

            if (! $data['thumbnail']->move('./' . AWARDS_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['thumbnail']->getErrorMessage();
            return false;
        }
    }

    /**
     * Upload Images
     * @param $data
     * @return bool
     */
    protected function uploadImages($data)
    {
        try {
            if (!$this->isEditMode($data)) {

                if ( !$this->imagesUploader($data)) {
                    return false;
                }

            } else {
                //TODO: Edit Mode
                if (!empty($data['filename'])) {
                    if (!$this->imagesUploader($data)) {
                        return false;
                    }
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    /**
     * Images Uploader
     * @param $data
     * @return bool
     */
    protected function imagesUploader($data)
    {
        if ($data['filename']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['filename']->getClientOriginalName();

            if (! $data['filename']->move('./' . AWARDS_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['filename']->getErrorMessage();
            return false;
        }
    }

    /**
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }

    /**
     * Get Data For Edit Awards
     * @param $data
     */

    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $singleAwardsData = $this->awards($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->awardsTransformation->getSingleAwardsCmsTransform($singleAwardsData));
    }

    public function changeStatus($data)
    {
     
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->awards->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->awards->id($data['id'])->update($updatedData);

            if($changeStatus) {
                DB::commit();
                return $this->setResponse(trans('message.cms_success_update_status_general'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_update_status_general'), false);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get Single Branch Office
     * @param $params
     */
    public function getSingleAwards($params) {

        $primaryData = $this->awards($params, 'asc', 'array', true);

        return $this->awardsTransformation->getSingleAwardsCmsTransform($primaryData);
    }

    /**
     * Delete Data Awards
     * @param $params
     * @return mixed
     */

    public function delete($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $params = [
                "id" => $data['id']
            ];

            $awardsData = $this->getSingleAwards($params);

            if (!$this->removeAwardsFiles($awardsData['thumbnail'], $awardsData['filename'])) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }
            
            if (!$this->removeAwards($params)) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_delete_data_general'), true);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * remove Awards Files
     * @param $data
     */
    protected function removeAwardsFiles($thumbnail, $filename)
    {
        try {

            $thumbnail_data = isset($thumbnail) && !empty($thumbnail) ? $thumbnail : uniqid();
            $filename_data  = isset($filename) && !empty($filename) ? $filename : uniqid();

            if (file_exists('./' . AWARDS_IMAGES_DIRECTORY . $thumbnail_data)) {
                unlink('./' . AWARDS_IMAGES_DIRECTORY . $thumbnail_data);
            }

            if (file_exists('./' . AWARDS_IMAGES_DIRECTORY . $filename_data)) {
                unlink('./' . AWARDS_IMAGES_DIRECTORY . $filename_data);
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Remove Awards From Database
     * @param $data
     * @return bool
     */
    protected function removeAwards($data)
    {
        try {

            $delete = $this->awards
                ->id($data['id'])
                ->forceDelete();

            if ($delete)
                return true;

            $this->message = trans('message.cms_failed_delete_data_general');
            return false;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Order Data
     * @param $data
     */

    public function order($data)
    {
        try {
            DB::beginTransaction();

            if ($this->orderData($data)) {
                DB::commit();
                return $this->setResponse(trans('message.cms_success_ordering'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_ordering'), false);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Order List Data
     * @param $data
     */

    protected function orderData($data)
    {
        try {
            $i = 1 ;
            foreach ($data as $key => $val) {
                $orderValue = $i++;

                $awardsData           = $this->awards->find($val);

                $awardsData->order  = $orderValue;

                $awardsData->save();
            }

            return true;

        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }
}
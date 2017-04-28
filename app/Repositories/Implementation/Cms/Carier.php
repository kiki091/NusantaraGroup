<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Carier as CarierInterface;
use App\Models\Carier as CarierModels;
use App\Models\CarierDetail as CarierDetailModels;
use App\Services\Transformation\Cms\Carier as CarierTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class Carier extends BaseImplementation implements CarierInterface
{
	protected $message;
    protected $carier;
    protected $carierDetail;
    protected $lastInsertId;
    protected $carierTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(CarierModels $carier, CarierDetailModels $carierDetail, CarierTransformation $carierTransformation)
    {
        $this->carier = $carier;
        $this->carierDetail = $carierDetail;
        $this->carierTransformation = $carierTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    /**
     * Get Data Carier Pages
     */

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params
        ];

        $carierData = $this->carier($data, 'asc', 'array', true);
       
        return $this->carierTransformation->getCarierCmsTransform($carierData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function carier($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $carier = $this->carier
            ->with('detail');

        if(isset($data['is_active'])) {
            $carier->isActive($data['is_active']);
        }

        if(isset($data['order_by'])) {
            $carier->orderBy($data['order_by'], $orderType);
        } else {
            $carier->orderBy('order', $orderType);
        }

        if(isset($data['id'])) {
            $carier->id($data['id']);
        }

        if(!$carier->count())
            return array();

        if(isset($data['id'])) 
        {
            return $carier->first()->toArray();
        }
        
        return $carier->get()->toArray();
    }

    /**
     * Store Carier
     * @param $data
     */

    public function store($data, $property_location_id)
    {
        try {

            DB::beginTransaction();

            //TODO: StoreData
            if ($this->storeData($data, $property_location_id) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: THUMBNAIL UPLOAD
            if ($this->uploadThumbnail($data) != true) {
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
     * Store Carier data
     * @param $data
     * @return mixed
     */

    protected function storeData($data, $property_location_id)
    {
        try {

            $store                          = $this->carier;

            if ($this->isEditMode($data)) {
                $store                      = $this->carier->find($data['id']);
            }

            $store->category_name           = isset($data['category_name']) ? $data['category_name'] : "";

            if (!$this->isEditMode($data))
            {
                $store->is_active               = true;
                $store->property_location_id    = $property_location_id;
                $store->thumbnail               = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
                $store->updated_at              = $this->mysqlDateTimeFormat();
                $store->created_at              = $this->mysqlDateTimeFormat();

            } else {
                //TODO: Edit Mode Thumbnail Checker
                if (!empty($data['thumbnail'])) {
                    $store->thumbnail       = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
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

            if (! $data['thumbnail']->move('./' . CARIER_IMAGES_DIRECTORY, $filename)) {
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
     * Get Data For Edit Carier
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $singleCarierData = $this->carier($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->carierTransformation->getSingleCarierCmsTransform($singleCarierData));
    }

    /**
     * Change Status Data Carier
     * @param $data
     */

    public function changeStatus($data)
    {
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->carier->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->carier->id($data['id'])->update($updatedData);

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
     * Get Single Carier
     * @param $params
     */
    public function getSingleCarier($params) {

        $primaryData = $this->carier($params, 'asc', 'array', true);

        return $this->carierTransformation->getSingleCarierCmsTransform($primaryData);
    }

    /**
     * Delete Data Carier
     * @param $data
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

            $carierData = $this->getSingleCarier($params);

            if (!$this->removeCarierFiles($carierData['thumbnail_image'])) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }
            
            if (!$this->removeCarier($params)) {
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
     * remove Carier Files
     * @param $data
     */
    protected function removeCarierFiles($data)
    {
        try {

            $filename        = isset($data) && !empty($data) ? $data : uniqid();

            if (file_exists('./' . CARIER_IMAGES_DIRECTORY . $filename)) {
                unlink('./' . CARIER_IMAGES_DIRECTORY . $filename);
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Remove Carier From Database
     * @param $data
     * @return bool
     */
    protected function removeCarier($data)
    {
        try {

            $delete = $this->carier
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
     * Order Data Carier
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

                $carier           = $this->carier->find($val);

                $carier->order  = $orderValue;

                $carier->save();
            }

            return true;

        } catch (Exception $e) {
            $this->message = $e->getMessage();
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
}
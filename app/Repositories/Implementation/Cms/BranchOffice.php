<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\BranchOffice as BranchOfficeInterface;
use App\Models\BranchOffice as BranchOfficeModel;
use App\Models\BranchOfficeTrans as BranchOfficeTransModel;
use App\Models\BranchOfficeImages as BranchOfficeImagesModel;
use App\Services\Transformation\Cms\BranchOffice as BranchOfficeTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class BranchOffice extends BaseImplementation implements BranchOfficeInterface
{
	protected $message;
    protected $lastInsertId;
    protected $branchOffice;
    protected $branchOfficeTrans;
    protected $branchOfficeImages;
    protected $uniqueIdImagePrefix = '';
    protected $branchOfficeTransformation;

    function __construct(BranchOfficeModel $branchOffice, BranchOfficeTransModel $branchOfficeTrans, BranchOfficeImagesModel $branchOfficeImages, BranchOfficeTransformation $branchOfficeTransformation)
    {
        $this->branchOffice = $branchOffice;
        $this->branchOfficeTrans = $branchOfficeTrans;
        $this->branchOfficeImages = $branchOfficeImages;
        $this->branchOfficeTransformation = $branchOfficeTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params
        ];
        

        $branchOfficeData = $this->branchOffice($data, 'asc', 'array', true);
        
        return $this->branchOfficeTransformation->getBranchOfficeCmsTransform($branchOfficeData);
    }

    public function getDataTranslation($params)
    {
        $data = [
        	"branch_office_id" => $params
        ];
        

        $branchOfficeData = $this->branchOfficeTrans($data, 'asc', 'array', true);
        
        return $this->branchOfficeTransformation->getBranchOfficeTranslationCmsTransform($branchOfficeData);
    }

    /**
     * Store Data
     * @param $data
     */
    public function store($data, $property_location_id)
    {
        try {

            DB::beginTransaction();

            if ($this->storeBranchOffice($data, $property_location_id) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->storeBranchOfficeTranslation($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->isEditMode($data)) {
                if ($this->storeBranchOfficeImages($data) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            //TODO: THUMBNAIL UPLOAD
            if ($this->uploadThumbnail($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: IMAGE SLIDER UPLOAD
            if (!$this->isEditMode($data)) {
                if ($this->uploadImageDetail($data) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_data_general'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Storing Branch Office Translation to database
     * @param $data
     * @param $key
     * @return bool
     */
    protected function storeBranchOfficeTranslation($data)
    {
        if ($this->isEditMode($data)) {
            $this->removeBranchOfficeTranslation($data['id']);
        }

        $finalData = $this->branchOfficeTransformation->getDataForBranchOfficeTranslation($data['branch_office'], $this->lastInsertId, $this->isEditMode($data));
        return $this->branchOfficeTrans->insert($finalData);
    }

    /**
     * Remove Branch Office Translation by ID
     * @param $mainBannerId
     * @return bool
     */
    protected function removeBranchOfficeTranslation($accOfferId)
    {
        if (empty($accOfferId))
            return false;

        return $this->branchOfficeTrans->where('branch_office_id', $accOfferId)->delete();
    }

    /**
     * Store Branch Office Images
     * @param $data
     * @return mixed
     */
    protected function storeBranchOfficeImages($data)
    {
        try {

            $finalData = [];

            foreach ($data['images'] as $key => $item) 
            {
                $finalData[] = [
                    "office_id"  => $this->lastInsertId,
                    "images"     => $this->uniqueIdImagePrefix . '_' .$item->getClientOriginalName(),
                    "created_at" => $this->mysqlDateTimeFormat(),
                    "created_by" => $this->getUserId(),
                    "updated_at" => $this->mysqlDateTimeFormat(),
                ];
            }

            if ($this->branchOfficeImages->insert($finalData) != true) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Image Detail Uploader
     * @param $data
     */
    protected function uploadImageDetail($data)
    {
        try {

            foreach ($data['images'] as $key => $item) {

                if (!$this->detailImageUploader($item))
                    return false;
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Detail Image Uploader
     * @param $file
     * @return bool
     */
    protected function detailImageUploader($file)
    {
        if ($file->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$file->getClientOriginalName();

            if (! $file->move('./' . BRANCH_OFFICE_IMAGES_SLIDER_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $file->getErrorMessage();
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

            if (! $data['thumbnail']->move('./' . THUMBNAIL_BRANCH_OFFICE_IMAGES_DIRECTORY, $filename)) {
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
     * Store Branch Office
     * @param $data
     * @return mixed
     */
    protected function storeBranchOffice($data, $property_location_id)
    {
        try {

            $store                          = $this->branchOffice;

            if ($this->isEditMode($data)) {
                $store                      = $this->branchOffice->find($data['id']);
            }

            $store->title                   = isset($data['title']) ? $data['title'] : "";
            $store->slug                    = isset($data['slug']) ? $data['slug'] : "";
            $store->side_description        = isset($data['side_description']) ? $data['side_description'] : "";
            $store->description             = isset($data['description']) ? $data['description'] : "";
            $store->office_name             = isset($data['office_name']) ? $data['office_name'] : "";
            $store->address                 = isset($data['address']) ? $data['address'] : "";

            if (!$this->isEditMode($data)) 
            {
                $store->is_active               = true;
                $store->property_location_id    = $property_location_id;
                $store->thumbnail               = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
                $store->created_by              = $this->getUserId();
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

    public function changeStatus($data)
    {
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->branchOffice->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->branchOffice->id($data['id'])->update($updatedData);

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
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function branchOffice($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $branchOffice = $this->branchOffice
            ->with(['translation', 'branch_office', 'property_location', 'slider']);

        if(isset($data['property_location_id'])) {
            $branchOffice->propertyId($data['property_location_id']);
        }

        if(isset($data['id'])) {
            $branchOffice->id($data['id']);
        }

        if(isset($params['order_by'])) {
            $branchOffice->orderBy($params['order_by'], $orderType);
        }

        if(!$branchOffice->count())
            return array();

        if(isset($data['id'])) {

            return $branchOffice->first()->toArray();
        }

        return $branchOffice->get()->toArray();
    }

    /**
     * Get All Data Translation
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function branchOfficeTrans($data = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {

        $branchOfficeTrans = $this->branchOfficeTrans
        	->with('translation');

        if(isset($data['branch_office_id'])) {
            $branchOfficeTrans->officeId($data['branch_office_id']);
        }

        if(isset($data['id'])) {
            $branchOfficeTrans->id($data['id']);
        }

        if(!$branchOfficeTrans->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) 
                {
                    return $branchOfficeTrans->get()->toArray();
                } 
                else 
                {
                    return $branchOfficeTrans->first()->toArray();
                }

            break;
        }
    }

    /**
     * Get Single Branch Office
     * @param $params
     */
    public function getSingleBranchOffice($params) {

        $primaryData = $this->branchOffice($params, 'asc', 'array', true);

        return $this->branchOfficeTransformation->getSingleBranchOfficeCmsTransform($primaryData);
    }

    /**
     * Delete Data Branch Office
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

            $branchOfficeData = $this->getSingleBranchOffice($params);

            if (!$this->removeBranchOfficeFiles($branchOfficeData['thumbnail_image'])) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }
            
            if (!$this->removeBranchOffice($params)) {
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
     * remove Branch Office Files
     * @param $data
     */
    protected function removeBranchOfficeFiles($data)
    {
        try {

            $filename        = isset($data) && !empty($data) ? $data : uniqid();

            if (file_exists('./' . THUMBNAIL_BRANCH_OFFICE_IMAGES_DIRECTORY . $filename)) {
                unlink('./' . THUMBNAIL_BRANCH_OFFICE_IMAGES_DIRECTORY . $filename);
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Remove Branch Office From Database
     * @param $data
     * @return bool
     */
    protected function removeBranchOffice($data)
    {
        try {

            $delete = $this->branchOffice
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
     * Delete Image Slider
     * @param $data
     */

    public function deleteImageSlider($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->branchOfficeImages->find($data['id']);

            if($this->branchOfficeImages->where('id', $data['id'])->delete()) {

                unlink('./'.BRANCH_OFFICE_IMAGES_SLIDER_DIRECTORY . $oldData->images);

                DB::commit();
                
                return $this->setResponse(trans('message.cms_success_delete_data_general'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_delete_data_general'), false);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Delete Office Detail
     * @param $params
     * @return mixed
     */

    public function deleteOfficeDetail($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $params = [
                "id" => $data['id']
            ];

            if (!$this->removeOfficeDetail($params)) {
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
     * Remove Office Detail From Database
     * @param $data
     * @return bool
     */
    protected function removeOfficeDetail($data)
    {
        
        try {

            $delete = $this->branchOfficeTrans
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
     * Get Data For Edit Branch Office
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $singleBranchOfficeData = $this->branchOffice($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->branchOfficeTransformation->getSingleBranchOfficeCmsTransform($singleBranchOfficeData));
    }

    /**
     * Edit Image Slider Branch Office
     * @param $data
     */
    public function editImageSlider($data)
    {
        try {

            DB::beginTransaction();

            $this->lastInsertId = $data['id'];

            if ($this->storeBranchOfficeImages($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->uploadImageDetail($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_update_image_slider_success'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
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

                $branchOffice           = BranchOffice::find($val);

                $branchOffice->order  = $orderValue;

                $branchOffice->save();
            }

            return true;

        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

}
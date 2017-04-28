<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\EventDetail as EventDetailInterface;
use App\Models\Service as EventDetailModels;
use App\Models\ServiceImages as EventImagesDetailModels;
use App\Services\Transformation\Cms\EventDetail as EventDetailTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class EventDetail extends BaseImplementation implements EventDetailInterface
{
	protected $message;
    protected $eventDetail;
    protected $eventImagesDetail;
    protected $lastInsertId;
    protected $eventDetailTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(EventDetailModels $eventDetail, EventImagesDetailModels $eventImagesDetail, EventDetailTransformation $eventDetailTransformation)
    {
        $this->eventDetail = $eventDetail;
        $this->eventImagesDetail = $eventImagesDetail;
        $this->eventDetailTransformation = $eventDetailTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    /**
     * Get Data 
     */

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params,
            "order_by"			   => "order"
        ];

        $eventDetailData = $this->eventDetail($data, 'asc', 'array', true);
       
        return $this->eventDetailTransformation->getEventDetailCmsTransform($eventDetailData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function eventDetail($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $eventDetail = $this->eventDetail->with(['category', 'banner']);

        if(isset($data['id'])) {

            $eventDetail->id($data['id']);
        }

        if(isset($data['order_by'])) {
            $eventDetail->orderBy($data['order_by'], $orderType);
        } else {
            $eventDetail->orderBy('order', $orderType);
        }

        

        if(!$eventDetail->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) 
                {
                    return $eventDetail->get()->toArray();
                }
                else 
                {
                    return $eventDetail->first()->toArray();
                }
            break;
        }
    }

    /**
     * Store Data
     * @param $data
     * @return bool
     */

    public function store($params, $property_id)
    {
    	try {

            DB::beginTransaction();

            if ($this->storeData($params, $property_id) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->isEditMode($params)) {
                if ($this->storeEventImages($params) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            if ($this->uploadImage($params) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: IMAGE SLIDER UPLOAD
            if (!$this->isEditMode($params)) {
                if ($this->uploadEventImages($params) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_upload_image_success'), true);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Data
     * @param $data
     * @return mixed
     */
    protected function storeData($data, $property_id)
    {
        try {

            $store                      = $this->eventDetail;

            if ($this->isEditMode($data)) {
                
                $store                          = $this->eventDetail->find($data['id']);
            }

            $store->service_category_id         = isset($data['service_category_id']) ? $data['service_category_id'] : '';
            $store->title                       = isset($data['title']) ? $data['title'] : '';
            $store->introduction                = isset($data['introduction']) ? $data['introduction'] : '';
            $store->side_description            = isset($data['side_description']) ? $data['side_description'] : '';
            $store->description                 = isset($data['description']) ? $data['description'] : '';
            $store->meta_title                  = isset($data['meta_title']) ? $data['meta_title'] : '';
            $store->meta_keyword                = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
            $store->meta_description            = isset($data['meta_description']) ? $data['meta_description'] : '';

            if (!$this->isEditMode($data))
            {
            	$store->slug                 = $data['slug'];
                $store->is_active            = true;
                $store->order            	 = 1;
                $store->created_by           = $this->getUserId();
                $store->created_at           = $this->mysqlDateTimeFormat();
                $store->updated_at           = $this->mysqlDateTimeFormat();
                $store->images            = $this->uniqueIdImagePrefix . '_' .$data['images']->getClientOriginalName();
            }
            else {
                if (!empty($data['images'])) {
                    
                    $store->images 		 = isset($data['images']) ? $this->uniqueIdImagePrefix . '_' . $data['images']->getClientOriginalName() : '';
                }
            }

            if($save = $store->save()) {
                $this->lastInsertId = $store->id;
            }

            return $save;

        }
        catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Store Images Slider
     * @param $data
     * @return mixed
     */
    protected function storeEventImages($data)
    {
        try {

            $finalData = [];

            foreach ($data['banner_images'] as $key => $item) 
            {
                $finalData[] = [
                    "services_id"  => $this->lastInsertId,
                    "banner_images"     => $this->uniqueIdImagePrefix . '_' .$item->getClientOriginalName(),
                    "created_at" => $this->mysqlDateTimeFormat(),
                    "updated_at" => $this->mysqlDateTimeFormat(),
                ];
            }

            if ($this->eventImagesDetail->insert($finalData) != true) {
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
    protected function uploadEventImages($data)
    {
        try {

            foreach ($data['banner_images'] as $key => $item) {

                if (!$this->detailEventImageUploader($item))
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
    protected function detailEventImageUploader($file)
    {
        if ($file->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$file->getClientOriginalName();

            if (! $file->move('./' . SERVICE_BANNER_IMAGES_DIRECTORY, $filename)) {
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
     * Upload Logo Image
     * @param $data
     * @return bool
     */
    protected function uploadImage($data)
    {
        try {

            if (!$this->isEditMode($data)){

                if (!$this->detailImageUploader($data)){
                    return false;
                }
            }
            else{

                if (!empty($data['images'])) {
                    if (!$this->detailImageUploader($data)) {
                        return false;
                    }
                }
            }

            return true;
        }
        catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Detail Image Uploader
     * @param $file
     * @return bool
     */
    protected function detailImageUploader($data)
    {
        if($data['images']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' . $data['images']->getClientOriginalName();

            if (! $data['images']->move('./' . SERVICE_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['images']->getErrorMessage();
            return false;
        }
    }

    /**
     * Edit Data
     * @param $data
     * @return array
     */

    public function edit($params)
    {
        $data = [
            'id' => $params['id']
        ];

        $singleData = $this->eventDetail($data, 'asc', 'array', false);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->eventDetailTransformation->getSingleEventDetailTransform($singleData));
    }

    /**
     * Change Status Data
     * @param $data
     * @return array
     */

    public function changeStatus($data)
    {
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->eventDetail->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->eventDetail->id($data['id'])->update($updatedData);

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

                $eventDetail         = $this->eventDetail->find($val);

                $eventDetail->order  = $orderValue;

                $eventDetail->save();
            }

            return true;

        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Delete List Data
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

            $getData = $this->getSingleEventDetail($params);

            if (!$this->removeEventDetailFiles($getData['images'])) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }
            
            if (!$this->removeEventDetail($params)) {
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
     * Remove Data From Database
     * @param $data
     * @return bool
     */
    protected function removeEventDetail($data)
    {
        try {

            $delete = $this->eventDetail
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
     * Get Single Data
     * @param $params
     */
    public function getSingleEventDetail($params) {

        $primaryData = $this->eventDetail($params, 'asc', 'array', true);

        return $this->eventDetailTransformation->getSingleEventDetailTransform($primaryData);
    }

    /**
     * remove Files
     * @param $data
     */
    protected function removeEventDetailFiles($data)
    {
        try {

            $filename        = isset($data) && !empty($data) ? $data : uniqid();

            if (file_exists('./' . SERVICE_IMAGES_DIRECTORY . $filename)) {
                unlink('./' . SERVICE_IMAGES_DIRECTORY . $filename);
            }

            return true;

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

            $oldData = $this->eventImagesDetail->find($data['id']);

            if($this->eventImagesDetail->where('id', $data['id'])->delete()) {

                unlink('./'.SERVICE_BANNER_IMAGES_DIRECTORY . $oldData->banner_images);

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
     * Edit Image Slider
     * @param $data
     */
    public function editImageSlider($data)
    {
        try {

            DB::beginTransaction();

            $this->lastInsertId = $data['id'];

            if ($this->storeEventImages($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->uploadEventImages($data) != true) {
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
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}
<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\EventCategory as EventCategoryInterface;
use App\Models\ServiceCategory as EventCategoryModels;
use App\Services\Transformation\Cms\EventCategory as EventCategoryTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class EventCategory extends BaseImplementation implements EventCategoryInterface
{
	protected $message;
    protected $eventCategory;
    protected $lastInsertId;
    protected $eventCategoryTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(EventCategoryModels $eventCategory, EventCategoryTransformation $eventCategoryTransformation)
    {
        $this->eventCategory = $eventCategory;
        $this->eventCategoryTransformation = $eventCategoryTransformation;
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

        $eventCategoryData = $this->eventCategory($data, 'asc', 'array', true);
       
        return $this->eventCategoryTransformation->getEventCategoryCmsTransform($eventCategoryData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function eventCategory($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $eventCategory = $this->eventCategory->with('property_location');

        if(isset($data['property_location_id'])) {
            $eventCategory->propertyId($data['property_location_id']);
        }

        if(isset($data['id'])) {

            $eventCategory->id($data['id']);
        }

        if(isset($data['order_by'])) {
            $eventCategory->orderBy($data['order_by'], $orderType);
        } else {
            $eventCategory->orderBy('order', $orderType);
        }

        

        if(!$eventCategory->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) 
                {
                    return $eventCategory->get()->toArray();
                }
                else 
                {
                    return $eventCategory->first()->toArray();
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

            if ($this->uploadImage($params) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
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

            $store                      = $this->eventCategory;

            if ($this->isEditMode($data)) {
                
                $store                  = $this->eventCategory->find($data['id']);
            }

            $store->name                = $data['name'];

            if (!$this->isEditMode($data))
            {
            	$store->slug                 = $data['slug'];
                $store->is_active            = true;
                $store->order            	 = 1;
                $store->property_location_id =  $property_id;
                $store->created_by           = $this->getUserId();
                $store->created_at           = $this->mysqlDateTimeFormat();
                $store->updated_at           = $this->mysqlDateTimeFormat();
                $store->thumbnail            = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
            }
            else {
                if (!empty($data['thumbnail'])) {
                    
                    $store->thumbnail 		 = isset($data['thumbnail']) ? $this->uniqueIdImagePrefix . '_' . $data['thumbnail']->getClientOriginalName() : '';
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

                if (!empty($data['thumbnail'])) {
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
        if($data['thumbnail']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' . $data['thumbnail']->getClientOriginalName();

            if (! $data['thumbnail']->move('./' . SERVICE_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['thumbnail']->getErrorMessage();
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

        $singleData = $this->eventCategory($data, 'asc', 'array', false);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->eventCategoryTransformation->getSingleEventCategoryTransform($singleData));
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

            $oldData = $this->eventCategory->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->eventCategory->id($data['id'])->update($updatedData);

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

                $eventCategory         = $this->eventCategory->find($val);

                $eventCategory->order  = $orderValue;

                $eventCategory->save();
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
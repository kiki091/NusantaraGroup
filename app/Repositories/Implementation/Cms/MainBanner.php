<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\MainBanner as MainBannerInterface;
use App\Models\Cms\MainBannerModel as MainBannerModel;
use App\Services\Transformation\Cms\MainBanner as MainBannerTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class MainBanner extends BaseImplementation implements MainBannerInterface
{
	protected $message;
    protected $mainBanner;
    protected $lastInsertId;
    protected $mainBannerTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(MainBannerModel $mainBanner, MainBannerTransformation $mainBannerTransformation)
    {
        $this->mainBanner = $mainBanner;
        $this->mainBannerTransformation = $mainBannerTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    public function getData($params, $key)
    {
        $data = [
            "property_location_id" => $params,
            "banner_key"           => $key
        ];

        $mainBannerData = $this->mainBanner($data, 'asc', 'array', true);
       
        return $this->mainBannerTransformation->getMainBannerCmsTransform($mainBannerData);
    }

    /**
     * Store Data
     * @param $data
     * @return bool
     */

    public function store($params, $property_id, $key)
    {
        try {

            DB::beginTransaction();

            if ($this->storeData($params, $property_id, $key) != true) {
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

            if (! $data['images']->move('./' . MAIN_BANNER_IMAGES_DIRECTORY, $filename)) {
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
     * Store Data
     * @param $data
     * @return mixed
     */
    protected function storeData($data, $property_id, $key)
    {
        try {

            $store                      = $this->mainBanner;

            if ($this->isEditMode($data)) {
                
                $store                  = $this->mainBanner->find($data['id']);
            }

            $store->title                = $data['title'];

            if (!$this->isEditMode($data))
            {
                $store->banner_key           = $key;
                $store->is_active            = true;
                $store->property_location_id =  $property_id;
                $store->created_by           = $this->getUserId();
                $store->created_at           = $this->mysqlDateTimeFormat();
                $store->images               = $this->uniqueIdImagePrefix . '_' .$data['images']->getClientOriginalName();
            }
            else {
                if (!empty($data['images'])) {
                    
                    $store->images      = isset($data['images']) ? $this->uniqueIdImagePrefix . '_' . $data['images']->getClientOriginalName() : '';
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

    public function edit($params)
    {
        $data = [
            'id' => $params
        ];

        $singleData = $this->mainBanner($data, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->mainBannerTransformation->getSingleForEditMainBannerTransform($singleData));
    }

    public function changeStatus($data)
    {
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->mainBanner->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->mainBanner->id($data['id'])->update($updatedData);

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
     * Delete Data
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
            $mainBannerData = $this->getSingleMainBanner($params);

            if (!$this->removeMainBannerFiles($mainBannerData['image_url'])) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }

            if (!$this->removeMainBanner($params)) {
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
     * Get Single Dining Offers
     * @param $params
     */
    public function getSingleMainBanner($params) {

        $primaryData = $this->mainBanner($params, 'asc', 'array', true);

        return $this->mainBannerTransformation->getSingleForEditMainBannerTransform($primaryData);
    }

    /**
     * remove Main Banner Files
     * @param $data
     */
    protected function removeMainBannerFiles($data)
    {
        try {

            $filename        = isset($data['images']) && !empty($data['images']) ? $data['images'] : uniqid();

            if (file_exists('./' . MAIN_BANNER_IMAGES_DIRECTORY . $filename)) {
                unlink('./' . MAIN_BANNER_IMAGES_DIRECTORY . $filename);
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Remove Main Banner Data From Database
     * @param $data
     * @return bool
     */
    protected function removeMainBanner($data)
    {
        try {

            $delete = $this->mainBanner
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
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function mainBanner($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $mainBanner = $this->mainBanner->with('property_location');

        if(isset($data['is_active'])) {
            $mainBanner->isActive($data['is_active']);
        }

        if(isset($data['banner_key'])) {
            $mainBanner->isKey($data['banner_key']);
        }

        if(isset($data['id'])) {
            $mainBanner->id($data['id']);
        }

        if(isset($data['property_location_id'])) {
            $mainBanner->propertyId($data['property_location_id']);
        }

        if(isset($params['order_by'])) {
            $mainBanner->orderBy($params['order_by'], $orderType);
        } 


        if(!$mainBanner->count())
            return array();

        if(isset($data['id'])) 
        {
            return $mainBanner->first()->toArray();
        }
        
        return $mainBanner->get()->toArray();
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

                $mainBanner         = MainBannerModel::find($val);

                $mainBanner->order  = $orderValue;

                $mainBanner->save();
            }

            return true;

        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

}
<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\MainBanner as MainBannerInterface;
use App\Model\Cms\MainBannerModel as MainBannerModels;
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
    protected $mainBannerformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(MainBannerModels $mainBanner, MainBannerTransformation $mainBannerformation)
    {
        $this->mainBanner = $mainBanner;
        $this->mainBannerformation = $mainBannerformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    public function getData($params, $key)
    {
        $data = [
            "property_location_id" => $params,
            "banner_key"           => $key
        ];

        $mainBannerData = $this->mainBanner($data, 'asc', 'array', true);
       
        return $this->mainBannerformation->getMainBannerCmsTransform($mainBannerData);
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
            return $this->setResponse(trans('message.cms_upload_image_failed'), true);
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
    protected function storeData($params, $property_id, $key)
    {
        try {

            $store                      = $this->mainBanner;

            if ($this->isEditMode($params)) {
                $store                  = $this->mainBanner->find($params['id']);
            }

            if (!$this->isEditMode($params))
            {
                $store->title                = $params['title'];
                $store->banner_key           = $key;
                $store->is_active            = true;
                $store->property_location_id =  $property_id;
                $store->created_by           = $this->getUserId();
                $store->created_at           = $this->mysqlDateTimeFormat();
                $store->images               = $params['images']->getClientOriginalName();
            }
            else {
                if (!empty($params['images'])) {
                    
                    $store->images      = isset($params['images']) ? $this->uniqueIdImagePrefix . '_' . $params['images']->getClientOriginalName() : '';
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

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->mainBannerformation->getSingleForEditMainBannerTransform($singleData));
    }

    public function changeStatus($params)
    {
        
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
            $mainBanner->isId($data['id']);
        }

        if(isset($data['property_location_id'])) {
            $mainBanner->propertyId($data['property_location_id']);
        }


        if(!$mainBanner->count())
            return array();

        if(isset($data['id'])) 
        {
            return $mainBanner->first()->toArray();
        }
        
        return $mainBanner->get()->toArray();
    }
}
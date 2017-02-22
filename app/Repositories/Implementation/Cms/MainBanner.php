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

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params
        ];

        $mainBannerData = $this->mainBanner($data, 'asc', 'array', true);
       
        return $this->mainBannerformation->getMainBannerCmsTransform($mainBannerData);
    }

    /**
     * Store Data
     * @param $data
     * @return bool
     */

    public function store($params, $key)
    {
        try {

            DB::beginTransaction();

            if ($this->storeData($params, $key) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->uploadImage($params) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }
            

            if (!$this->isEditMode($params)) {
                if ($this->storeImage($params) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_upload_image_failed'), true);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Images
     * @param $data
     * @return mixed
     */
    protected function storeImage($data)
    {
        try {

            if (isset($data['images']) && !empty($data['images'])) {
                $finalData = [];
                foreach ($data['images'] as $key => $item) {

                    $finalData[] = [
                        "images" => $this->uniqueIdImagePrefix . '_' .$item->getClientOriginalName(),
                    ];
                }

                if ($this->mainBanner->insert($finalData) != true) {
                    $this->message = trans('message.cms_upload_image_failed');
                    return false;
                }
            }

            return true;

        } catch (\Exception $e) {
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

            if (isset($data['images']) && !empty($data['images'])) {

                foreach ($data['images'] as $key => $item) {

                    if (!$this->detailImageUploader($item))
                        return false;
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
    protected function detailImageUploader($file, $path = MAIN_BANNER_IMAGES_DIRECTORY)
    {
        if(!empty($file)) {
            if ($file->isValid()) {

                $filename = $this->uniqueIdImagePrefix . '_' .$file->getClientOriginalName();

                if (! $file->move('./' . $path, $filename)) {
                    $this->message = trans('message.cms_upload_image_failed');
                    return false;
                }

                return true;

            } else {
                $this->message = $file->getErrorMessage();
                return false;
            }
        }

        return true;
    }

    /**
     * Store Data
     * @param $data
     * @return mixed
     */
    protected function storeData($params, $key)
    {
        try {

            $store                      = $this->mainBanner;

            if ($this->isEditMode($params)) {
                $store                  = $this->mainBanner->find($params['id']);
            }

            $store->title               = $params['title'];
            $store->banner_key          = $key;

            if (!$this->isEditMode($params)) 
            {
                $store->created_by          = Auth::id();
                $store->created_at          = $this->mysqlDateTimeFormat();
            }

            if($save = $mainBanner->save()) {
                $this->lastInsertId = $mainBanner->id;
            }

            return $save;

        }
    }

    public function edit($params)
    {

    }

    public function changeStatus($params)
    {
        
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

        if(isset($data['id'])) {
            $mainBanner->id($data['id']);
        }

        if(isset($data['property_location_id'])) {
            $mainBanner->propertyId($data['property_location_id']);
        }


        if(!$mainBanner->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) {
                    return $mainBanner->get()->toArray();
                } else {
                    return $mainBanner->first()->toArray();
                }
                break;
        }
    }
}
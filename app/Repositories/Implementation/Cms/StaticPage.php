<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\StaticPage as StaticPageInterface;
use App\Models\Cms\StaticPageModel as StaticPageModels;
use App\Services\Transformation\Cms\StaticPage as StaticPageTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class StaticPage extends BaseImplementation implements StaticPageInterface
{

    protected $message;
    protected $staticPage;
    protected $lastInsertId;
    protected $staticPageTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(StaticPageModels $staticPage, StaticPageTransformation $staticPageTransformation)
    {
        $this->staticPage = $staticPage;
        $this->staticPageTransformation = $staticPageTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params
        ];

        $staticPageData = $this->staticPage($data, 'asc', 'array', true);
        
        return $this->staticPageTransformation->getStaticPageCmsTransform($staticPageData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function staticPage($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $staticPage = $this->staticPage->with('property_location');

        if(isset($data['is_active'])) {
            $staticPage->isActive($data['is_active']);
        }

        if(isset($data['id'])) {
            $staticPage->id($data['id']);
        }

        if(isset($data['property_location_id'])) {
            $staticPage->propertyId($data['property_location_id']);
        }


        if(!$staticPage->count())
            return array();

        return $staticPage->first()->toArray();
    }

    public function store($params)
    {
        try {

            DB::beginTransaction();

            if ($this->storeData($params) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: THUMBNAIL UPLOAD
            if ($this->uploadImage($params) != true) {
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
     * Upload Logo Image
     * @param $data
     * @return bool
     */
    protected function uploadImage($data)
    {
        try {

            if (!empty($data['logo_images'])) {
                if (!$this->logoImageUploader($data)) {
                    return false;
                }
            }

            if (!empty($data['favicon_images'])) {
                if (!$this->faviconImageUploader($data)) {
                    return false;
                }
            }

            if (!empty($data['og_images'])) {
                if (!$this->ogImageUploader($data)) {
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
     * Logo Images Uploader
     * @param $data
     * @return bool
     */
    protected function logoImageUploader($data)
    {

        if ($data['logo_images']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' . $data['logo_images']->getClientOriginalName();

            if (! $data['logo_images']->move('./' . STATIC_PAGE_LOGO_IMAGE_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['logo_images']->getErrorMessage();
            return false;
        }
    }

    /**
     * Favicon Images Uploader
     * @param $data
     * @return bool
     */
    protected function faviconImageUploader($data)
    {
        if ($data['favicon_images']->isValid()) 
        {

            $filename = $this->uniqueIdImagePrefix . '_' . $data['favicon_images']->getClientOriginalName();

            if (! $data['favicon_images']->move('./' . STATIC_PAGE_FAVICON_IMAGE_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['favicon_images']->getErrorMessage();
            return false;
        }
    }

    /**
     * Favicon Images Uploader
     * @param $data
     * @return bool
     */
    protected function ogImageUploader($data)
    {
        if ($data['og_images']->isValid()) 
        {

            $filename = $this->uniqueIdImagePrefix . '_' . $data['og_images']->getClientOriginalName();

            if (! $data['og_images']->move('./' . STATIC_PAGE_OG_IMAGE_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['og_images']->getErrorMessage();
            return false;
        }
    }

    /**
     * Store Data
     * @param $data
     * @return mixed
     */
    protected function storeData($params)
    {
        try {

                $store                      = $this->staticPage;
                $store                      = $this->staticPage->find($params['id']);
                
                $store->site_title          = isset($params['site_title']) ? $params['site_title'] : '';
                $store->site_name           = isset($params['site_name']) ? $params['site_name'] : '';
                $store->og_title            = isset($params['og_title']) ? $params['og_title'] : '';
                $store->og_description      = isset($params['og_description']) ? $params['og_description'] : '';
                $store->box_wrapper_left    = isset($params['box_wrapper_left']) ? $params['box_wrapper_left'] : '';
                $store->box_wrapper_center  = isset($params['box_wrapper_center']) ? $params['box_wrapper_center'] : '';
                $store->box_wrapper_right   = isset($params['box_wrapper_right']) ? $params['box_wrapper_right'] : '';
                $store->meta_title          = isset($params['meta_title']) ? $params['meta_title'] : '';
                $store->meta_keyword        = isset($params['meta_keyword']) ? $params['meta_keyword'] : '';
                $store->meta_description    = isset($params['meta_description']) ? $params['meta_description'] : '';

                if (!empty($params['logo_images'])) {
                    
                    $store->logo_images      = isset($params['logo_images']) ? $this->uniqueIdImagePrefix . '_' . $params['logo_images']->getClientOriginalName() : '';
                }

                if (!empty($params['favicon_images'])) {
                    $store->favicon_images      = isset($params['favicon_images']) ? $this->uniqueIdImagePrefix . '_' . $params['favicon_images']->getClientOriginalName() : '';
                }

                if (!empty($params['og_images'])) {
                    $store->og_images      = isset($params['og_images']) ? $this->uniqueIdImagePrefix . '_' . $params['og_images']->getClientOriginalName() : '';
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
     * Get Data For Edit
     * @param $data
     */
    public function edit($params)
    {
        $data = [
            "id" => isset($params['id']) ? $params['id'] : '',
        ];

        $singleData = $this->staticPage($data, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->staticPageTransformation->getSingleForEditStaticPageTransform($singleData));
    }

    /**
     * Change Status
     * @param $params
     * @return mixed
     */
    public function changeStatus($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->staticPage->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->staticPage->id($data['id'])->update($updatedData);

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

}
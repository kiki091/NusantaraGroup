<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\StaticPage as StaticPageInterface;
use App\Model\Cms\StaticPageModel as StaticPageModels;
use App\Services\Transformation\Cms\StaticPage as StaticPageTransformation;
use Cache;
use Session;
use DB;

class StaticPage extends BaseImplementation implements StaticPageInterface
{

    protected $message;
    protected $staticPage;
    protected $lastInsertId;
    protected $staticPageformation;
    protected $uniqueIdThumbnailPrefix = '';

    function __construct(StaticPageModels $staticPage, StaticPageTransformation $staticPageformation)
    {
        $this->staticPage = $staticPage;
        $this->staticPageformation = $staticPageformation;
        $this->uniqueIdThumbnailPrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    public function getData($params)
    {
        $data = [
            "is_active" => true,
            "property_location_id" => $params,
        ];

        $staticPageData = $this->staticPage($data, 'asc', 'array', true);
        
        return $this->staticPageformation->getStaticPageCmsTransform($staticPageData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function staticPage($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $staticPage = $this->staticPage;

        if(isset($data['is_active'])) {
            $staticPage->isActive($data['is_active']);
        }

        if(isset($data['property_location_id'])) {
            $staticPage->isPropertyId($data['property_location_id']);
        }


        if(!$staticPage->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $staticPage->get()->toArray();
                } 
                else 
                {
                    return $staticPage->first()->toArray();
                }

            break;
        }
    }

    public function store($params)
    {
        try {

            DB::beginTransaction();

            $this->lastInsertId = $params['id'];

            if ($this->storeData($params) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse($this->message), true);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
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
                
                $store->site_title          = isset($data['site_title']) ? $data['site_title'] : '';
                $store->logo_images         = $this->uniqueIdThumbnailPrefix . '_' . $data['logo_images']->getClientOriginalName();
                $store->favicon_images      = $this->uniqueIdThumbnailPrefix . '_' . $data['favicon_images']->getClientOriginalName();
                $store->og_images           = $this->uniqueIdThumbnailPrefix . '_' . $data['og_images']->getClientOriginalName();
                $store->site_name           = isset($data['site_name']) ? $data['site_name'] : '';
                $store->og_title            = isset($data['og_title']) ? $data['og_title'] : '';
                $store->og_description      = isset($data['og_description']) ? $data['og_description'] : '';
                $store->box_wrapper_left    = isset($data['box_wrapper_left']) ? $data['box_wrapper_left'] : '';
                $store->box_wrapper_center  = isset($data['box_wrapper_center']) ? $data['box_wrapper_center'] : '';
                $store->box_wrapper_right   = isset($data['box_wrapper_right']) ? $data['box_wrapper_right'] : '';
                $store->meta_title          = isset($data['meta_title']) ? $data['meta_title'] : '';
                $store->meta_keyword        = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
                $store->meta_description    = isset($data['meta_description']) ? $data['meta_description'] : '';

                if($save = $store->save()) {
                    $this->lastInsertId = $store->id;
                }

                return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

}
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

    protected $staticPage;
    protected $staticPageformation;

    function __construct(StaticPageModels $staticPage, StaticPageTransformation $staticPageformation)
    {
        $this->staticPage = $staticPage;
        $this->staticPageformation = $staticPageformation;
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

}
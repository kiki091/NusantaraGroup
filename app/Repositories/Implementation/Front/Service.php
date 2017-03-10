<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\Service as ServiceInterface;
use App\Models\Front\ServiceModel as ServiceModel;
use App\Models\Front\ServiceModelImages as ServiceModelImages;
use App\Models\Front\ServiceModelCategory as ServiceModelCategory;
use App\Services\Transformation\Front\Service as ServiceTransformation;
use Cache;
use Session;
use DB;

class Service implements ServiceInterface
{

    protected $services;
    protected $servicesImages;
    protected $servicesCategory;
    protected $servicesTransformation;

    function __construct(ServiceModel $services, ServiceModelImages $servicesImages, ServiceModelCategory $servicesCategory, ServiceTransformation $servicesTransformation)
    {
        $this->services = $services;
        $this->servicesImages = $servicesImages;
        $this->servicesCategory = $servicesCategory;
        $this->servicesTransformation = $servicesTransformation;
    }

    public function getServices()
    {
        $params = [
            'is_active' => true,
        ];
        $servicesData = $this->services($params);
        //dd($mainBannerData);
        return $this->servicesTransformation->getServiceFrontTransform($servicesData);
    }

    public function getServicesLanding()
    {
        $params = [
            'is_active' => true,
            'limit_data' => 2,
        ];
        $servicesData = $this->servicesLanding($params);
        //dd($mainBannerData);
        return $this->servicesTransformation->getServiceFrontTransform($servicesData);
    }

    public function getServicesCategory()
    {
        $params = [
            'is_active' => true,
        ];

        $servicesData = $this->servicesCategory($params);

        return $this->servicesTransformation->getServiceCategoryFrontTransform($servicesData);
    }

    public function getServicesByCategory($slug)
    {
        $params = [
            'slug' => $slug,
            'is_active' => true,
        ];
        $servicesData = $this->servicesCategory($params, 'asc', 'array', true);
        $servicesGroupData = $this->servicesGroupCategory('', $servicesData);

        return $this->servicesTransformation->getServiceByCategoryFrontTransform($servicesData, $servicesGroupData);
    }

    public function getDetailService($slug)
    {
        $params = [
            'slug' => $slug,
            'is_active' => true,
        ];
        $servicesData = $this->servicesDetail($params, 'asc', 'array', true);

        return $this->servicesTransformation->getServiceDetailFrontTransform($servicesData);
    }

    public function getSeoService($slug)
    {
        $params = [
            'slug' => $slug,
            'is_active' => true,
        ];
        $servicesDataSeo = $this->servicesDetail($params, 'asc', 'array', true);

        return $this->servicesTransformation->getServiceSeoFrontTransform($servicesDataSeo);
    }

    /**
     * Get All Services
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function services($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $services = $this->services
            ->with('translation')
            ->with('translations');

        if(isset($params['is_active'])) {
            $services->isActive($params['is_active']);
        }


        if(!$services->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $services->get()->toArray();
                } 
                else 
                {
                    return $services->first()->toArray();
                }

            break;
        }
    }

    /**
     * Get All Services
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function servicesLanding($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $services = $this->services
            ->with('translation')
            ->with('translations');

        if(isset($params['is_active'])) {
            $services->isActive($params['is_active']);
        }


        if(!$services->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $services->get()->toArray();
                } 
                else 
                {
                    return $services->first()->toArray();
                }

            break;
        }
    }

    /**
     * Get All Services Category
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function servicesCategory($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $servicesCategory = $this->servicesCategory
            ->with('category');

        if(isset($params['is_active'])) {
            $servicesCategory->isActive($params['is_active']);
        }

        if(isset($params['slug'])) {
            $servicesCategory->slug($params['slug']);
        }


        if(!$servicesCategory->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $servicesCategory->get()->toArray();
                } 
                else 
                {
                    return $servicesCategory->first()->toArray();
                }

            break;
        }
    }

    /**
     * Get All Services Group Category
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function servicesGroupCategory($servicesCategoryId = '', $data = array())
    {
        if(empty($servicesCategoryId) && empty($data))
            return array();

        if(empty($servicesCategoryId) && !empty($data)) {
            $servicesCategoryId = isset($data['id']) ? $data['id'] : '';
        }

        $services = $this->services
            ->with('translations')
            ->ServicesCategoryId($servicesCategoryId);

        if(!$services->count())
            return array();

        return $services->get()->toArray();
    }

    /**
     * Get All Service Detail
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function servicesDetail($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $services = $this->services
            ->with('banner')
            ->with('translations');

        if(isset($params['slug'])) {
            $services->slug($params['slug']);
        }

        if(isset($params['is_active'])) {
            $services->isActive($params['is_active']);
        }

        if(!$services->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $services
                    ->get()->toArray();
                } else {
                    return $services
                    ->first()->toArray();
                }
                break;
        }

    }

}
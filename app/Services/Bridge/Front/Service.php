<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Service as ServiceInterface;

class Service {

	protected $services;

    public function __construct(ServiceInterface $services)
    {
        $this->services = $services;
    }

    /**
     * Get Data Services
     * @param $params
     * @return mixed
     */
    public function getServices()
    {
        return $this->services->getServices();
    }

    /**
     * Get Data Services
     * @param $params
     * @return mixed
     */
    public function getServicesLanding()
    {
        return $this->services->getServicesLanding();
    }

    /**
     * Get Data Services Category
     * @param $params
     * @return mixed
     */
    public function getServicesCategory()
    {
        return $this->services->getServicesCategory();
    }

    /**
     * Get Data Services By Category
     * @param $params
     * @return mixed
     */
    public function getServicesByCategory($slug)
    {
        return $this->services->getServicesByCategory($slug);
    }

    /**
     * Get Detail Service
     * @param $params
     * @return mixed
     */
    public function getDetailService($slug)
    {
        return $this->services->getDetailService($slug);
    }

    /**
     * Get Seo Service
     * @param $params
     * @return mixed
     */
    public function getSeoService($slug)
    {
        return $this->services->getSeoService($slug);
    }

}
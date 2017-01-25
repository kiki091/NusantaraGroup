<?php

namespace App\Repositories\Contracts\Front;


interface Service
{

    /**
     * Get Data Service
     * @param $params
     * @return mixed
     */
    public function getServices();

    /**
     * Get Data Services Category
     * @param $params
     * @return mixed
     */
    public function getServicesCategory();

    /**
     * Get Data Services By Category
     * @param $params
     * @return mixed
     */
    public function getServicesByCategory($slug);

    /**
     * Get Detail Service
     * @param $params
     * @return mixed
     */
    public function getDetailService($slug);

    /**
     * Get Seo Service
     * @param $params
     * @return mixed
     */
    public function getSeoService($slug);
}
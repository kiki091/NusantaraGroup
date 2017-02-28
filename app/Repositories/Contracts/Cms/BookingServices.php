<?php

namespace App\Repositories\Contracts\Cms;


interface BookingServices
{

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params);

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function showData($params);

    /**
     * Search Data 
     * @param $params
     * @return mixed
     */
    public function searchData($params);

}
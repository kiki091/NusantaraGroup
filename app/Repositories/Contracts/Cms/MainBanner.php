<?php

namespace App\Repositories\Contracts\Cms;


interface MainBanner
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
    public function store($params, $key);

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params, $key);

    /**
     * Change Status
     * @param $params
     * @return mixed
     */
    public function changeStatus($params, $key);
}
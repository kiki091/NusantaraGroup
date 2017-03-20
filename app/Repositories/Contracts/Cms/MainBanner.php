<?php

namespace App\Repositories\Contracts\Cms;


interface MainBanner
{

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params, $key);

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params, $property_id, $key);

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params);

    /**
     * Change Status
     * @param $params
     * @return mixed
     */
    public function changeStatus($params);

    /**
     * Order Data
     * @param $params
     * @return mixed
     */
    public function order($params);

    /**
     * Delete Data
     * @param $params
     * @return mixed
     */
    public function delete($params);
}
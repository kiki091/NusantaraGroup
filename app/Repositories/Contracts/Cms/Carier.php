<?php

namespace App\Repositories\Contracts\Cms;


interface Carier
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
    public function store($params, $property_location_id);

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params);

    /**
     * Change Status Data 
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
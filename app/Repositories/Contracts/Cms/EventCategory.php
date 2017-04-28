<?php

namespace App\Repositories\Contracts\Cms;


interface EventCategory
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
    public function store($params, $property_id);

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params);

    /**
     * Change status Data 
     * @param $params
     * @return mixed
     */
    public function changeStatus($params);

    /**
     * Ordering Data 
     * @param $params
     * @return mixed
     */
    public function order($params);
}
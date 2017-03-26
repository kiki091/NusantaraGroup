<?php

namespace App\Repositories\Contracts\Cms;


interface Awards
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
     * Change Status
     * @param $params
     * @return mixed
     */
    public function changeStatus($params);

    /**
     * Ordering
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
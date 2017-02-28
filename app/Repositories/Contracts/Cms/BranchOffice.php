<?php

namespace App\Repositories\Contracts\Cms;


interface BranchOffice
{

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * Get Data Translation
     * @param $params
     * @return mixed
     */
    public function getDataTranslation($params);

    /**
     * Store Data
     * @param $params
     * @return mixed
     */
    public function store($params, $property_location_id);

    /**
     * Change Status
     * @param $params
     * @return mixed
     */
    public function changeStatus($params);

}
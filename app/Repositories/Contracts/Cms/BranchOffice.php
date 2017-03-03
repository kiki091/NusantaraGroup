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
     * Delete Data
     * @param $params
     * @return mixed
     */
    public function delete($params);

    /**
     * Delete Image Slider
     * @param $params
     * @return mixed
     */
    public function deleteImage($params);

    /**
     * Delete Office Detail
     * @param $params
     * @return mixed
     */
    public function deleteOfficeDetail($params);

}
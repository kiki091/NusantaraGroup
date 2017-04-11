<?php

namespace App\Repositories\Contracts\Cms;


interface Promotion
{
	/**
     * Get Data Promotion
     * @param $params
     * @return mixed
     */
    public function getData();

    /**
     * Store Promotion Detail
     * @param $params
     * @return mixed
     */

    public function storePromotion($params);

    /**
     * Edit Data Promotion Detail
     * @param $params
     * @return mixed
     */

    public function edit($params);

    /**
     * Edit Image Promotion Gallery
     * @param $params
     * @return mixed
     */

    public function editImageSlider($params);

    /**
     * Change Status Promotion
     * @param $params
     * @return mixed
     */

    public function changeStatus($params);

    /**
     * Delete Data Promotion
     * @param $params
     * @return mixed
     */

    public function delete($params);

    /**
     * Order Data Promotion
     * @param $params
     * @return mixed
     */

    public function order($params);

    /**
     * Delete Image Promotion Gallery
     * @param $params
     * @return mixed
     */

    public function deleteImageSlider($params);

}
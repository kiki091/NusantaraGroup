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

}
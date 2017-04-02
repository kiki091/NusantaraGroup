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
     * Get Data Category Promotion
     * @param $params
     * @return mixed
     */
    public function getCategoryPromotion();

    /**
     * Store Data Categori Promotion
     * @param $params
     * @return mixed
     */
    public function storeCategori($params);

    /**
     * Edit Data Categori Promotion
     * @param $params
     * @return mixed
     */
    public function editCategori($params);

    /**
     * Change status Categori Promotion
     * @param $params
     * @return mixed
     */
    public function changeStatusCategori($params);

    /**
     * Delete Data Categori Promotion
     * @param $params
     * @return mixed
     */
    public function deleteCategori($params);

    /**
     * Ordering Data Categori Promotion
     * @param $params
     * @return mixed
     */
    public function orderCategori($params);

}
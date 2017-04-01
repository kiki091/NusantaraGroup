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

}
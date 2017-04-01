<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\Promotion as PromotionInterface;

class Promotion {

	protected $promotion;

    public function __construct(PromotionInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * Get Data Promotion
     * @param $params
     * @return mixed
     */
    public function getData()
    {
        return $this->promotion->getData();
    }

    /**
     * Get Data Category Promotion
     * @param $params
     * @return mixed
     */
    public function getCategoryPromotion()
    {
        return $this->promotion->getCategoryPromotion();
    }

    /**
     * Store Data Categori Promotion
     * @param $params
     * @return mixed
     */
    public function storeCategori($params)
    {
        return $this->promotion->storeCategori($params);
    }


}
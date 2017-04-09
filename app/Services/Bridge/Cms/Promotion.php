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
     * Store Promotion Detail
     * @param $params
     * @return mixed
     */
    
    public function storePromotion($params = [])
    {
        return $this->promotion->storePromotion($params);
    }

    /**
     * Edit Data Promotion Detail
     * @param $params
     * @return mixed
     */
    
    public function edit($params = [])
    {
        return $this->promotion->edit($params);
    }
}
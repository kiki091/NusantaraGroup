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
    public function getData($params)
    {
        return $this->promotion->getData($params);
    }


}
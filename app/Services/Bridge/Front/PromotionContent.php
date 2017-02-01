<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\PromotionContent as PromotionContentInterface;

class PromotionContent {

	protected $promotion;

    public function __construct(PromotionContentInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * Store Booking Services
     * @param $params
     * @return mixed
     */
    public function storeBookingServices($data = [])
    {
        return $this->promotion->storeBookingServices($data);
    }

}
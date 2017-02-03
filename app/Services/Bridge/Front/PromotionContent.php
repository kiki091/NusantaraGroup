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

    /**
     * Store Booking Test Drive
     * @param $params
     * @return mixed
     */
    public function storeBookingTestDrive($data = [])
    {
        return $this->promotion->storeBookingTestDrive($data);
    }

    /**
     * Get Data Promotion
     * @param $params
     * @return mixed
     */
    public function getPromotion()
    {
        return $this->promotion->getPromotion();
    }

    /**
     * Get Data Promotion Detail
     * @param $params
     * @return mixed
     */
    public function getPromotionDetail($slug)
    {
        return $this->promotion->getPromotionDetail($slug);
    }

}
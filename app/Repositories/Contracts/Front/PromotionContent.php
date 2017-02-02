<?php

namespace App\Repositories\Contracts\Front;


interface PromotionContent
{

    /**
     * Store Booking Services
     * @param $params
     * @return mixed
     */
    public function storeBookingServices($data);

    /**
     * Store Booking Test Drive
     * @param $params
     * @return mixed
     */
    public function storeBookingTestDrive($data);

    /**
     * Get Data Promotion
     * @param $params
     * @return mixed
     */
    public function getPromotion();


}
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

    /**
     * Edit Data Categori Promotion
     * @param $params
     * @return mixed
     */
    
    public function editCategori($params)
    {
        return $this->promotion->editCategori($params);
    }

    
    /**
     * Change status Categori Promotion
     * @param $params
     * @return mixed
     */
    
    public function changeStatusCategori($params)
    {
        return $this->promotion->changeStatusCategori($params);
    }

    

    /**
     * Delete Data Categori Promotion
     * @param $params
     * @return mixed
     */
    
    public function deleteCategori($params)
    {
        return $this->promotion->deleteCategori($params);
    }

    /**
     * Ordering Data Categori Promotion
     * @param $params
     * @return mixed
     */
    
    public function orderCategori($params)
    {
        return $this->promotion->orderCategori($params);
    }

    

    /**
     * Store Promotion Detail
     * @param $params
     * @return mixed
     */
    
    public function storePromotion($params)
    {
        return $this->promotion->storePromotion($params);
    }
}
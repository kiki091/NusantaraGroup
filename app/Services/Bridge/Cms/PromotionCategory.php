<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\PromotionCategory as PromotionCategoryInterface;

class PromotionCategory {

	protected $promotionCategory;

    public function __construct(PromotionCategoryInterface $promotionCategory)
    {
        $this->promotionCategory = $promotionCategory;
    }

    /**
     * Get Data Category Promotion
     * @param $params
     * @return mixed
     */
    public function getCategoryPromotion()
    {
        return $this->promotionCategory->getCategoryPromotion();
    }

    /**
     * Store Data Categori Promotion
     * @param $params
     * @return mixed
     */
    public function storeCategori($params)
    {
        return $this->promotionCategory->storeCategori($params);
    }

    /**
     * Edit Data Categori Promotion
     * @param $params
     * @return mixed
     */
    
    public function editCategori($params)
    {
        return $this->promotionCategory->editCategori($params);
    }

    
    /**
     * Change status Categori Promotion
     * @param $params
     * @return mixed
     */
    
    public function changeStatusCategori($params)
    {
        return $this->promotionCategory->changeStatusCategori($params);
    }

    /**
     * Delete Data Categori Promotion
     * @param $params
     * @return mixed
     */
    
    public function deleteCategori($params)
    {
        return $this->promotionCategory->deleteCategori($params);
    }

    /**
     * Ordering Data Categori Promotion
     * @param $params
     * @return mixed
     */
    
    public function orderCategori($params)
    {
        return $this->promotionCategory->orderCategori($params);
    }
}
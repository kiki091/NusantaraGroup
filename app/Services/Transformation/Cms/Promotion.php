<?php

namespace App\Services\Transformation\Cms;

use Auth;

class Promotion
{
	/**
     * get Data Promotion Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getPromotionCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setPromotionCmsTransform($data);
    }

    protected function setPromotionCmsTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'title' => isset($data['title']) ? $data['title'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'thumbnail_url' => isset($data['thumbnail']) ? asset(PROMOTION_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }

    /*
    * Promotion Category Cms Transform
    */

    public function getPromotionCategoryCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setPromotionCategoryCmsTransform($data);
    }

    protected function setPromotionCategoryCmsTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'category_name' => isset($data['category_name']) ? $data['category_name'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'thumbnail_category_url' => isset($data['thumbnail_category']) ? asset(PROMOTION_IMAGES_CATEGORY_DIRECTORY.rawurlencode($data['thumbnail_category'])) : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }

}
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

    /*
    * Get Single Data Categori Promotion Transformation
    */

    public function getSingleCategoriPromotionCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleCategoriPromotionCmsTransform($data);
    }

    /*
    * Set Single Data Categori Promotion Transformation
    */

    protected function setSingleCategoriPromotionCmsTransform($data)
    {
        $dataTransform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTransform['category_name'] = isset($data['category_name']) ? $data['category_name'] : '';
        $dataTransform['category_slug'] = isset($data['category_slug']) ? $data['category_slug'] : '';
        $dataTransform['thumbnail_category'] = isset($data['thumbnail_category']) ? $data['thumbnail_category'] : '';
        $dataTransform['thumbnail_category_url'] = isset($data['thumbnail_category']) ? asset(PROMOTION_IMAGES_CATEGORY_DIRECTORY.rawurlencode($data['thumbnail_category'])) : '';
        $dataTransform['introduction'] = isset($data['introduction']) ? $data['introduction'] : '';
        $dataTransform['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $dataTransform['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $dataTransform['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';

        return $dataTransform;
    }

    /**
     * Get Promotion Transformation For Insert
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */
    public function getDataForPromotionTranslation($data, $lastInsertId, $isEditMode)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataForPromotionTranslation($data, $lastInsertId, $isEditMode);
    }

    /**
     * Set Promotion Transformation For Insert
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */
    protected function setDataForPromotionTranslation($data, $lastInsertId, $isEditMode)
    {
        try {

            $dataTransform = [

                'introduction'          => isset($data['introduction']) ? $data['introduction'] : '',
                'side_description'      => isset($data['side_description']) ? $data['side_description'] : '',
                'description'           => isset($data['description']) ? $data['description'] : '',
                'interior_description'  => isset($data['interior_description']) ? $data['interior_description'] : '',
                'exterior_description'  => isset($data['exterior_description']) ? $data['exterior_description'] : '',
                'safety_description'    => isset($data['safety_description']) ? $data['safety_description'] : '',
                'accesories_description'    => isset($data['accesories_description']) ? $data['accesories_description'] : '',
                'promotion_id'          => $lastInsertId,
                'meta_title'            => isset($data['meta_title']) ? $data['meta_title'] : '',
                'meta_keyword'          => isset($data['meta_keyword']) ? $data['meta_keyword'] : '',
                'meta_description'      => isset($data['meta_description']) ? $data['meta_description'] : '',
                'created_at'            => mysqlDateTimeFormat(),
                'updated_at'            => mysqlDateTimeFormat(),
            ];

            return $dataTransform;
            
        }catch (\Exception $e) {
            return false;
        }
    }

}
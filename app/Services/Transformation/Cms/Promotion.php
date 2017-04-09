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

    /*
    * Get Single Data Cms Promotion Transformation
    */

    public function getSinglePromotionCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSinglePromotionCmsTransform($data);
    }

    /*
    * Set Single Data Cms Promotion Transformation
    */

    protected function setSinglePromotionCmsTransform($data)
    {
        //dd($data['detail']);
        $dataTransform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTransform['title'] = isset($data['title']) ? $data['title'] : '';
        $dataTransform['thumbnail_url'] = isset($data['thumbnail']) ? asset(PROMOTION_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $dataTransform['promotion_category_id'] = isset($data['promotion_category_id']) ? $data['promotion_category_id'] : '';

        $dataTransform['equipment_exterior'] = isset($data['detail'][0]['equipment_exterior']) ? $data['detail'][0]['equipment_exterior'] : '';
        $dataTransform['equipment_interior'] = isset($data['detail'][0]['equipment_interior']) ? $data['detail'][0]['equipment_interior'] : '';
        $dataTransform['information'] = isset($data['detail'][0]['information']) ? $data['detail'][0]['information'] : '';


        $dataTransform['banner_image_url'] = isset($data['images'][0]['banner_image']) ? asset(PROMOTION_IMAGES_DIRECTORY.rawurlencode($data['images'][0]['banner_image'])) : '';
        $dataTransform['interior_image_url'] = isset($data['images'][0]['interior_image']) ? asset(PROMOTION_IMAGES_DIRECTORY.rawurlencode($data['images'][0]['interior_image'])) : '';
        $dataTransform['exterior_image_url'] = isset($data['images'][0]['exterior_image']) ? asset(PROMOTION_IMAGES_DIRECTORY.rawurlencode($data['images'][0]['exterior_image'])) : '';
        $dataTransform['accesories_image_url'] = isset($data['images'][0]['accesories_image']) ? asset(PROMOTION_IMAGES_DIRECTORY.rawurlencode($data['images'][0]['accesories_image'])) : '';
        $dataTransform['safety_image_url'] = isset($data['images'][0]['safety_image']) ? asset(PROMOTION_IMAGES_DIRECTORY.rawurlencode($data['images'][0]['safety_image'])) : '';


        $dataTransform['introduction'] = isset($data['translation'][0]['introduction']) ? $data['translation'][0]['introduction'] : '';
        $dataTransform['side_description'] = isset($data['translation'][0]['side_description']) ? $data['translation'][0]['side_description'] : '';
        $dataTransform['description'] = isset($data['translation'][0]['description']) ? $data['translation'][0]['description'] : '';
        $dataTransform['interior_description'] = isset($data['translation'][0]['interior_description']) ? $data['translation'][0]['interior_description'] : '';
        $dataTransform['exterior_description'] = isset($data['translation'][0]['exterior_description']) ? $data['translation'][0]['exterior_description'] : '';
        $dataTransform['safety_description'] = isset($data['translation'][0]['safety_description']) ? $data['translation'][0]['safety_description'] : '';
        $dataTransform['accesories_description'] = isset($data['translation'][0]['accesories_description']) ? $data['translation'][0]['accesories_description'] : '';
        $dataTransform['meta_title'] = isset($data['translation'][0]['meta_title']) ? $data['translation'][0]['meta_title'] : '';
        $dataTransform['meta_keyword'] = isset($data['translation'][0]['meta_keyword']) ? $data['translation'][0]['meta_keyword'] : '';
        $dataTransform['meta_description'] = isset($data['translation'][0]['meta_description']) ? $data['translation'][0]['meta_description'] : '';

        $dataTransform['total_detail_image'] = isset($data['gallery']) ? $this->setDefaultTotalDetailImage($data['gallery']) : [];

        $dataTransform['filename_url'] = isset($data['gallery']) ? $this->setImageUrlImagesForEdit($data['gallery'], 'filename') : [];
        $dataTransform['gallery'] = isset($data['gallery']) ? $this->populateImagesForEdit($data['gallery'], 'filename') : [];

        return $dataTransform;
    }

    /**
     * Set Default Total Detail Image For Edit Promotion Gallery
     * @param $data
     * @param $index
     * @return array
     */
    protected function setDefaultTotalDetailImage($data)
    {
        try {

            $returnValue = [];
            $totalImages = count($data);

            for($i=0; $i<$totalImages; $i++) {
                $returnValue[] = $i;
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Set Images URL For Edit Promotion Gallery
     * @param $data
     * @param $index
     * @return array
     */
    protected function setImageUrlImagesForEdit($data, $index)
    {
        try {

            $returnValue = [];
            foreach ($data as $key => $item) {
                $returnValue[] = asset(PROMOTION_IMAGES_GALLERY_DIRECTORY.rawurlencode($item[$index]));
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Populate Images URL For Edit Promotion Gallery
     * @param $data
     * @param $index
     * @return array
     */
    protected function populateImagesForEdit($data, $index)
    {
        try {

            $dataTransform = array_map(function($data)
            {
                return [
                    'id' => isset($data['id']) ? $data['id'] : '',
                    'filename' => isset($data['filename']) ? $data['filename'] : '',
                ];
            }, $data);

        } catch (\Exception $e) {
            return [];
        }
    }
}
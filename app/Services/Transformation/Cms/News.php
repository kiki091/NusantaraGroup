<?php

namespace App\Services\Transformation\Cms;

use Auth;

class News
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getNewsCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setNewsCmsTransform($data);
    }

    /**
     * get Single Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getSingleNewsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleNewsTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setNewsCmsTransform($data)
    {
        $dataTransform = array_map(function($data)
        {
            return [
                'id'            => isset($data['id']) ? $data['id'] : '',
                'title'         => isset($data['title']) ? $data['title'] : '',
                'is_active'     => isset($data['is_active']) ? $data['is_active'] : '',
                'thumbnail_url' => isset($data['thumbnail']) ? asset(NEWS_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                
            ];
        }, $data);
        
        return $dataTransform;
    }

    /**
     * set Single Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setSingleNewsTransform($data)
    {
        $dataTransform['id']                    = isset($data['id']) ? $data['id'] : '';
        $dataTransform['title']                 = isset($data['title']) ? $data['title'] : '';
        $dataTransform['slug']                  = isset($data['slug']) ? $data['slug'] : '';
        $dataTransform['thumbnail']             = isset($data['thumbnail']) ? $data['thumbnail'] : '';
        $dataTransform['thumbnail_url']         = isset($data['thumbnail']) ? asset(NEWS_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $dataTransform['introduction']          = isset($data['introduction']) ? $data['introduction'] : '';
        $dataTransform['side_description']      = isset($data['side_description']) ? $data['side_description'] : '';
        $dataTransform['quote_description']     = isset($data['quote_description']) ? $data['quote_description'] : '';
        $dataTransform['description']           = isset($data['description']) ? $data['description'] : '';
        $dataTransform['service_category_id']   = isset($data['service_category_id']) ? $data['service_category_id'] : '';
        $dataTransform['meta_title']            = isset($data['meta_title']) ? $data['meta_title'] : '';
        $dataTransform['meta_keyword']          = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $dataTransform['meta_description']      = isset($data['meta_description']) ? $data['meta_description'] : '';

        $dataTransform['total_detail_image'] = isset($data['images_detail']) ? $this->setDefaultTotalDetailImage($data['images_detail']) : [];
        $dataTransform['filename_url'] = isset($data['images_detail']) ? $this->setImageUrlImagesForEdit($data['images_detail'], 'filename') : [];
        $dataTransform['images_detail'] = isset($data['images_detail']) ? $this->populateImagesForEdit($data['images_detail'], 'filename') : [];

        return $dataTransform;
    }

    /**
     * Set Default Total Detail Image For Edit
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
     * Set Images URL For Edit 
     * @param $data
     * @param $index
     * @return array
     */
    protected function setImageUrlImagesForEdit($data, $index)
    {
        try {

            $returnValue = [];
            foreach ($data as $key => $item) {
                $returnValue[] = asset(NEWS_IMAGES_DIRECTORY.rawurlencode($item[$index]));
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Populate Images URL For Edit
     * @param $data
     * @param $index
     * @return array
     */
    protected function populateImagesForEdit($data, $index)
    {
        try {

            return array_map(function($data)
            {
                return [
                    'id'        => isset($data['id']) ? $data['id'] : '',
                    'filename'  => isset($data['filename']) ? $data['filename'] : '',
                ];
            }, $data);

        } catch (\Exception $e) {
            return [];
        }
    }

}
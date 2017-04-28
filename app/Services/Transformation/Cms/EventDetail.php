<?php

namespace App\Services\Transformation\Cms;

use Auth;

class EventDetail
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getEventDetailCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setEventDetailCmsTransform($data);
    }

    /**
     * get Single Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getSingleEventDetailTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleEventDetailTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setEventDetailCmsTransform($data)
    {
        $dataTransform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'images' => isset($data['images']) ? $data['images'] : '',
                'title' => isset($data['title']) ? $data['title'] : '',
                'slug' => isset($data['slug']) ? $data['slug'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'images_url' => isset($data['images']) ? asset(SERVICE_IMAGES_DIRECTORY.rawurlencode($data['images'])) : '',
                
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

    protected function setSingleEventDetailTransform($data)
    {
        $dataTransform['id']            = isset($data['id']) ? $data['id'] : '';
        $dataTransform['title']          = isset($data['title']) ? $data['title'] : '';
        $dataTransform['slug']          = isset($data['slug']) ? $data['slug'] : '';
        $dataTransform['images']     = isset($data['images']) ? $data['images'] : '';
        $dataTransform['images_url'] = isset($data['images']) ? asset(SERVICE_IMAGES_DIRECTORY.rawurlencode($data['images'])) : '';
        $dataTransform['introduction']          = isset($data['introduction']) ? $data['introduction'] : '';
        $dataTransform['side_description']          = isset($data['side_description']) ? $data['side_description'] : '';
        $dataTransform['description']          = isset($data['description']) ? $data['description'] : '';
        $dataTransform['service_category_id']          = isset($data['service_category_id']) ? $data['service_category_id'] : '';
        $dataTransform['meta_title']          = isset($data['meta_title']) ? $data['meta_title'] : '';
        $dataTransform['meta_keyword']          = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $dataTransform['meta_description']          = isset($data['meta_description']) ? $data['meta_description'] : '';

        $dataTransform['total_detail_image'] = isset($data['banner']) ? $this->setDefaultTotalDetailImage($data['banner']) : [];
        $dataTransform['banner_images_url'] = isset($data['banner']) ? $this->setImageUrlImagesForEdit($data['banner'], 'banner_images') : [];
        $dataTransform['banner'] = isset($data['banner']) ? $this->populateImagesForEdit($data['banner'], 'banner_images') : [];

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
                $returnValue[] = asset(SERVICE_BANNER_IMAGES_DIRECTORY.rawurlencode($item[$index]));
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
                    'id' => isset($data['id']) ? $data['id'] : '',
                    'banner_images' => isset($data['banner_images']) ? $data['banner_images'] : '',
                ];
            }, $data);

        } catch (\Exception $e) {
            return [];
        }
    }

}
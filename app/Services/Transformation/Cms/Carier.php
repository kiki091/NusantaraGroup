<?php

namespace App\Services\Transformation\Cms;

use Auth;

class Carier
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getCarierCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setCarierCmsTransform($data);
    }

    public function getSingleCarierCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleCarierCmsTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setCarierCmsTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'category_name' => isset($data['category_name']) ? $data['category_name'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'thumbnail_url' => isset($data['thumbnail']) ? asset(CARIER_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }

    /**
     * set Single Data For Edit
     * @param $data
     * @return array|void
     */

    protected function setSingleCarierCmsTransform($data)
    {
        $dataTransform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTransform['category_name'] = isset($data['category_name']) ? $data['category_name'] : '';
        $dataTransform['thumbnail_image'] = isset($data['thumbnail']) ? $data['thumbnail'] : '';
        $dataTransform['thumbnail_url'] = isset($data['thumbnail']) ? asset(CARIER_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';

        return $dataTransform;
    }
}
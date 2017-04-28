<?php

namespace App\Services\Transformation\Cms;

use Auth;

class EventCategory
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getEventCategoryCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setEventCategoryCmsTransform($data);
    }

    /**
     * get Single Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getSingleEventCategoryTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleEventCategoryTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setEventCategoryCmsTransform($data)
    {
        $dataTransform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'thumbnail' => isset($data['thumbnail']) ? $data['thumbnail'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'slug' => isset($data['slug']) ? $data['slug'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'thumbnail_url' => isset($data['thumbnail']) ? asset(SERVICE_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                
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

    protected function setSingleEventCategoryTransform($data)
    {
        $dataTransform['id']            = isset($data['id']) ? $data['id'] : '';
        $dataTransform['name']          = isset($data['name']) ? $data['name'] : '';
        $dataTransform['slug']          = isset($data['slug']) ? $data['slug'] : '';
        $dataTransform['thumbnail']     = isset($data['thumbnail']) ? $data['thumbnail'] : '';
        $dataTransform['thumbnail_url'] = isset($data['thumbnail']) ? asset(SERVICE_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';

        return $dataTransform;
    }

}
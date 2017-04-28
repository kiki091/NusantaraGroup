<?php

namespace App\Services\Transformation\Cms;

use Auth;

class CarierDetail
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getCarierDetailCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setCarierDetailCmsTransform($data);
    }

    public function getSingleCarierDetailCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleCarierDetailCmsTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setCarierDetailCmsTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'category_name' => isset($data['category']['category_name']) ? $data['category']['category_name'] : '',
                'job_title' => isset($data['job_title']) ? $data['job_title'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'thumbnail_url' => isset($data['category']['thumbnail']) ? asset(CARIER_IMAGES_DIRECTORY.rawurlencode($data['category']['thumbnail'])) : '',
                
            ];
        }, $data);
        
        $finalData = [];
        foreach ($dataTranform as $item) {
            $finalData[$item['category_name']][] = $item;

        }

        return $finalData;
    }

    /**
     * set Single Data
     * @param $data
     * @return array|void
     */

    protected function setSingleCarierDetailCmsTransform($data)
    {
        $dataTranform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTranform['carier_category_id'] = isset($data['carier_category_id']) ? $data['carier_category_id'] : '';
        $dataTranform['job_title'] = isset($data['job_title']) ? $data['job_title'] : '';
        $dataTranform['job_description'] = isset($data['job_description']) ? $data['job_description'] : '';
        $dataTranform['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $dataTranform['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $dataTranform['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';

        return $dataTranform;
    }
}
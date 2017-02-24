<?php

namespace App\Services\Transformation\Cms;


class MainBanner
{
	/**
     * get Data Static Page Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getMainBannerCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setMainBannerCmsTransform($data);
    }

    protected function setMainBannerCmsTransform($data)
    {
    	$dataTranform = array_map(function($data)
        {
            return [
                'id'             => isset($data['id']) ? $data['id'] : '',
                'title'          => isset($data['title']) ? $data['title'] : '',
                'banner_url'     => isset($data['images']) ? asset(MAIN_BANNER_IMAGES_DIRECTORY.rawurlencode($data['images'])) : '',
                'is_active'      => isset($data['is_active']) ? $data['is_active'] : '',
                
            ];
        }, $data);

        return $dataTranform;
    }

    public function getSingleForEditMainBannerTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleForEditMainBannerTransform($data);
    }

    protected function setSingleForEditMainBannerTransform($data)
    {
        $dataTranform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTranform['title'] = isset($data['title']) ? $data['title'] : '';
        $dataTranform['image_url'] = isset($data['images']) ? asset(MAIN_BANNER_IMAGES_DIRECTORY.rawurlencode($data['images'])) : '';

        return $dataTranform;
    }

}
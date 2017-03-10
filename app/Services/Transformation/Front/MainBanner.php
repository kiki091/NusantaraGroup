<?php

namespace App\Services\Transformation\Front;


class MainBanner
{
    /**
     * get Data For Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getMainBannerFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setMainBannerFrontTransform($data);
    }

    protected function setMainBannerFrontTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'title' => isset($data['title']) ? $data['title'] : '',
                'images' => isset($data['images']) ? asset(MAIN_BANNER_IMAGES_DIRECTORY.rawurlencode($data['images'])) : ''
            ];
        }, $data);

        return $dataTranform;
    }

}

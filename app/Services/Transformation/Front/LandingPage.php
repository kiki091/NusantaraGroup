<?php

namespace App\Services\Transformation\Front;


class LandingPage
{

    /**
     * get Data For Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getlandingPageFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setLandingPageFrontTransform($data);
    }

    public function getlandingPageSeoFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setLandingPageSeoFrontTransform($data);
    }

    protected function setLandingPageFrontTransform($data)
    {
        
        $data['site_title'] = isset($data['site_title']) ? $data['site_title'] : '';
        $data['logo_images'] = isset($data['logo_images']) ? asset('images/db/main_page/logo/'.rawurlencode($data['logo_images'])) : '';
        $data['site_name'] = isset($data['site_name']) ? $data['site_name'] : '';
        $data['favicon_images'] = isset($data['favicon_images']) ? asset('images/db/main_page/favicon/'.rawurlencode($data['favicon_images'])) : '';
        $data['og_title'] = isset($data['og_title']) ? $data['og_title'] : '';
        $data['og_images'] = isset($data['og_images']) ? asset('images/db/main_page/share_image/'.rawurlencode($data['og_images'])) : '';
        $data['og_description'] = isset($data['og_description']) ? $data['og_description'] : '';
        $data['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $data['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $data['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        return $data;

    }

    protected function setLandingPageSeoFrontTransform($data)
    {
        $data['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $data['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $data['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        
        return $data;

    }

}

<?php

namespace App\Services\Transformation\Cms;


class StaticPage
{
    /**
     * get Data Static Page Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getStaticPageCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setStaticPageCmsTransform($data);
    }

    protected function setStaticPageCmsTransform($data)
    {
        $dataTranform['site_title'] = isset($data['site_title']) ? $data['site_title'] : '';
        $dataTranform['logo_images'] = isset($data['logo_images']) ? asset(STATIC_PAGE_LOGO_IMAGE_DIRECTORY.rawurlencode($data['logo_images'])) : '';
        $dataTranform['site_name'] = isset($data['site_name']) ? $data['site_name'] : '';
        $dataTranform['favicon_images'] = isset($data['favicon_images']) ? asset(STATIC_PAGE_FAVICON_IMAGE_DIRECTORY.rawurlencode($data['favicon_images'])) : '';
        $dataTranform['og_title'] = isset($data['og_title']) ? $data['og_title'] : '';
        $dataTranform['og_images'] = isset($data['og_images']) ? asset(STATIC_PAGE_OG_IMAGE_DIRECTORY.rawurlencode($data['og_images'])) : '';
        $dataTranform['og_description'] = isset($data['og_description']) ? $data['og_description'] : '';
        $dataTranform['box_wrapper_left'] = isset($data['box_wrapper_left']) ? $data['box_wrapper_left'] : '';
        $dataTranform['box_wrapper_center'] = isset($data['box_wrapper_center']) ? $data['box_wrapper_center'] : '';
        $dataTranform['box_wrapper_right'] = isset($data['box_wrapper_right']) ? $data['box_wrapper_right'] : '';
        $dataTranform['is_active'] = isset($data['is_active']) ? $data['is_active'] : '';
        $dataTranform['property_location_id'] = isset($data['property_location_id']) ? $data['property_location_id'] : '';
        $dataTranform['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $dataTranform['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $dataTranform['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        
        return $dataTranform;
    }

}

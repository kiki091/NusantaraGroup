<?php

namespace App\Services\Transformation\Front;


class Service
{
    /**
     * get Data For Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getServiceFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setServiceFrontTransform($data);
    }

    public function getServiceCategoryFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setServiceCategoryFrontTransform($data);
    }

    public function getServiceByCategoryFrontTransform($servicesData, $servicesGroupData)
    {
        if(!is_array($servicesGroupData) || empty($servicesGroupData))
            return array();

        return $this->setServiceByCategoryFrontTransform($servicesData, $servicesGroupData);
    }

    public function getServiceDetailFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setServiceDetailFrontTransform($data);
    }

    public function getServiceSeoFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setServiceSeoFrontTransform($data);
    }

    protected function setServiceFrontTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'title' => isset($data['title']) ? $data['title'] : '',
                'slug' => isset($data['slug']) ? $data['slug'] : '',
                'introduction' => isset($data['introduction']) ? $data['introduction'] : '',
                'side_description' => isset($data['side_description']) ? $data['side_description'] : '',
                'description' => isset($data['description']) ? $data['description'] : '',
                'service_category_id' => isset($data['service_category_id']) ? $data['service_category_id'] : '',
                'meta_title' => isset($data['meta_title']) ? $data['meta_title'] : '',
                'meta_keyword' => isset($data['meta_keyword']) ? $data['meta_keyword'] : '',
                'meta_description' => isset($data['meta_description']) ? $data['meta_description'] : '',
                'images' => isset($data['images']) ? asset(SERVICE_IMAGES_DIRECTORY.rawurlencode($data['images'])) : '',
                
            ];
        }, $data);

        $finalData = [];
        foreach ($dataTranform as $item) {
            $finalData[$item['title']][] = $item;

        }
        return $finalData;
    }

    protected function setServiceCategoryFrontTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'name' => isset($data['name']) ? $data['name'] : '',
                'slug' => isset($data['slug']) ? $data['slug'] : ''
                
            ];
        }, $data);

        return $data;
    }

    protected function setServiceByCategoryFrontTransform($servicesData, $servicesGroupData)
    {
        $dataTranform['name'] = isset($servicesData['name']) ? $servicesData['name']: '';
        $dataTranform['group_data'] = $this->getGroupDataByCategoryId($servicesGroupData);

        return $dataTranform;
    }

    protected function getGroupDataByCategoryId($servicesGroupData)
    {
        $groupData = array_map(function($servicesGroupData)
        {
            return [
                'title' => isset($servicesGroupData['title']) ? $servicesGroupData['title'] : '',
                'introduction' => isset($data['introduction']) ? $data['introduction'] : '',
                'side_description' => isset($servicesGroupData['side_description']) ? $servicesGroupData['side_description'] : '',
                'description' => isset($servicesGroupData['description']) ? $servicesGroupData['description'] : '',
                'images' => isset($servicesGroupData['images']) ? asset(SERVICE_IMAGES_DIRECTORY.rawurlencode($servicesGroupData['images'])) : ''
            ];
        },$servicesGroupData);

        return $servicesGroupData;
    }

    protected function setServiceDetailFrontTransform($data)
    {

        $data['id'] = isset($data['id']) ? $data['id'] : '';
        $data['title'] = isset($data['title']) ? $data['title'] : '';
        $data['introduction'] = isset($data['introduction']) ? $data['introduction'] : '';
        $data['side_description'] = isset($data['side_description']) ? $data['side_description'] : '';
        $data['description'] = isset($data['description']) ? $data['description'] : '';
        $data['images'] = isset($data['images']) ? asset(SERVICE_IMAGES_DIRECTORY.rawurlencode($data['images'])) : '';

        $data['slider'] = $this->getSliderFromDetailServices($data);
        
        return $data;
        
    }

    protected function getSliderFromDetailServices($data)
    {
        try {

            $returnValue = [];
            foreach ($data['banner'] as $key => $item) {
                $returnValue[] = asset(SERVICE_BANNER_IMAGES_DIRECTORY.rawurlencode($item['banner_images']));
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    protected function setServiceSeoFrontTransform($data)
    {

        $data['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $data['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $data['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        
        return $data;
        
    }
}

<?php

namespace App\Services\Transformation\Front;


class BranchOffice
{
    /**
     * get Data For Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getBranchOfficeFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setBranchOfficeFrontTransform($data);
    }

    public function getBranchOfficeDetailFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setBranchOfficeDetailFrontTransform($data);
    }

    public function getBranchOfficeSeoDetailFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setBranchOfficeSeoDetailFrontTransform($data);
    }

    protected function setBranchOfficeFrontTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'title' => isset($data['title']) ? $data['title'] : '',
                'slug' => isset($data['slug']) ? $data['slug'] : '',
                'side_description' => isset($data['side_description']) ? $data['side_description'] : '',
                'office_name' => isset($data['office_name']) ? $data['office_name'] : '',
                'title_description' => isset($data['translation']['title_description']) ? $data['translation']['title_description'] : '',
                'address' => isset($data['translation']['address']) ? $data['translation']['address'] : '',
                'meta_title' => isset($data['meta_title']) ? $data['meta_title'] : '',
                'meta_keyword' => isset($data['meta_keyword']) ? $data['meta_keyword'] : '',
                'meta_description' => isset($data['meta_description']) ? $data['meta_description'] : '',
                'thumbnail' => isset($data['thumbnail']) ? asset('images/db/branch_office/'.rawurlencode($data['thumbnail'])) : '',
                
            ];
        }, $data);

        $finalData = [];
        foreach ($dataTranform as $item) {
            $finalData[$item['title']][] = $item;

        }
        return $finalData;
    }

    protected function setBranchOfficeDetailFrontTransform($data)
    {
        
        $data['id'] = isset($data['id']) ? $data['id'] : '';
        $data['title'] = isset($data['title']) ? $data['title'] : '';
        $data['slug'] = isset($data['slug']) ? $data['slug'] : '';
        $data['side_description'] = isset($data['side_description']) ? $data['side_description'] : '';
        $data['description'] = isset($data['description']) ? $data['description'] : '';
        $data['banner'] = $this->setImageSliderFrontDetail($data);
        $data['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $data['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $data['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        //$data['detail'] = $this->setDetailBranchOfficeData($data);
        
        return $data;
        
    }

    protected function setBranchOfficeSeoDetailFrontTransform($data)
    {
        $data['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $data['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $data['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        
        return $data;
        
    }

    /*protected function setDetailBranchOfficeData($data)
    {
        
    }*/

    protected function setImageSliderFrontDetail($data)
    {
        try {

            $returnValue = [];
            foreach ($data['slider'] as $key => $item) {
                $returnValue[] = asset('images/db/branch_office/slider/'.rawurlencode($item['images']));
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    

}

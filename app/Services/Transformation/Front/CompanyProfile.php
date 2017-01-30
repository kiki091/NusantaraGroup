<?php

namespace App\Services\Transformation\Front;


class CompanyProfile
{
    /**
     * get Data For Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getCompanyProfileFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setCompanyProfileFrontTransform($data);
    }

    public function getCompanyProfileSeoFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setCompanyProfileSeoFrontTransform($data);
    }

    protected function setCompanyProfileFrontTransform($data)
    {

        $dataTranform['title'] = isset($data['title']) ? $data['title'] : '';
        $dataTranform['introduction'] = isset($data['introduction']) ? $data['introduction'] : '';
        $dataTranform['side_description'] = isset($data['side_description']) ? $data['side_description'] : '';
        $dataTranform['description'] = isset($data['description']) ? $data['description'] : '';
        $dataTranform['images'] = isset($data['images']) ? asset(COMPANY_PROFILE_IMAGES_DIRECTORY.$data['images']) : '';

        return $dataTranform;
    }

    protected function setCompanyProfileSeoFrontTransform($data)
    {

        $dataTranform['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $dataTranform['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $dataTranform['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        
        return $dataTranform;
    }

    

}

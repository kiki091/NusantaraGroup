<?php

namespace App\Services\Transformation\Front;


class CompanyHistory
{
    /**
     * get Data For Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getCompanyHistoryFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setCompanyHistoryFrontTransform($data);
    }

    public function getCompanyHistoryImageFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setCompanyHistoryImageFrontTransform($data);
    }

    public function getCompanyHistorySeoDetailFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setCompanyHistorySeoDetailFrontTransform($data);
    }

    protected function setCompanyHistoryFrontTransform($data)
    {
        $dataTranform['content'] = array_map(function($data)
        {
            return [
                'title' => isset($data['title']) ? $data['title'] : '',
                'side_description' => isset($data['side_description']) ? $data['side_description'] : '',
                'year' => isset($data['year']) ? $data['year'] : '',
                'description' => isset($data['description']) ? $data['description'] : ''
            ];
        }, $data);

        $finalData['year'] = [];
        foreach ($dataTranform['content'] as $item) {
            $finalData['year'][$item['year']][] = $item;

        }
        return $finalData;
    }

    protected function setCompanyHistoryImageFrontTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'filename' => isset($data['filename']) ? asset(COMPANY_HISTORY_IMAGES_DIRECTORY.$data['filename']) : ''
            ];
        }, $data);

        return $dataTranform;
    }

    protected function setCompanyHistorySeoDetailFrontTransform($data)
    {

        $dataTranform = array_map(function($data)
        {
            return [
                'meta_title' => isset($data['meta_title']) ? $data['meta_title'] : '',
                'meta_keyword' => isset($data['meta_keyword']) ? $data['meta_keyword'] : '',
                'meta_description' => isset($data['meta_description']) ? $data['meta_description'] : ''
            ];
        }, $data);

        return $dataTranform;
    }


}

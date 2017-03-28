<?php

namespace App\Services\Transformation\Front;


class Awards
{
    /**
     * get Data For Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getAwardsFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setAwardsFrontTransform($data);
    }

    protected function setAwardsFrontTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'office_name' => isset($data['office_name']) ? $data['office_name'] : '',
                'awards_description' => $this->setDetailTranslation($data),

                'meta_title' => isset($data['meta_title']) ? $data['meta_title'] : '',
                'meta_keyword' => isset($data['meta_keyword']) ? $data['meta_keyword'] : '',

                'meta_description' => isset($data['meta_description']) ? $data['meta_description'] : '',

                'images' => isset($data['filename']) ? asset(AWARDS_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',

                'thumbnail' => isset($data['thumbnail']) ? asset(AWARDS_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                
            ];
        }, $data);

        $finalData = [];
        foreach ($dataTranform as $item) {
            $finalData[$item['office_name']][] = $item;

        }
        return $finalData;
    }

    protected function setDetailTranslation($data)
    {
        try {

            $returnValue = [];
            foreach ($data['translations'] as $key => $item) {
                $returnValue[] = $item['description'];
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    

}

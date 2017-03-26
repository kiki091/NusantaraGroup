<?php

namespace App\Services\Transformation\Front;


class Carier
{
    /**
     * get Data For Carier
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getCarierFrontTransform($carierData)
    {
        if(!is_array($carierData) || empty($carierData))
            return array();

        return $this->setCarierFrontTransform($carierData);
    }

    protected function setCarierFrontTransform($carierData)
    {
        $dataTranform['job_desc'] = array_map(function($carierData)
        {
            return [
                'job_category' => isset($carierData['category']['category_name']) ? $carierData['category']['category_name'] : '',
                'job_title' => isset($carierData['job_title']) ? $carierData['job_title'] : '',
                'slug' => isset($carierData['slug']) ? $carierData['slug'] : '',
                'job_description' => isset($carierData['job_description']) ? $carierData['job_description'] : '',
                
            ];
        }, $carierData);

        $finalData['content'] = [];
        foreach ($dataTranform['job_desc'] as $item) {
            $finalData['content'][$item['job_category']][] = $item;

        }
        
        return $finalData['content'];
    }

}

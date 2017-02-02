<?php

namespace App\Services\Transformation\Front;


class Promotion
{
	/**
     * get Data For Promotion Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getPromotionServiceTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setPromotionServiceTransform($data);
    }

    protected function setPromotionServiceTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'title' => isset($data['title']) ? $data['title'] : '',
                'side_description' => $this->setDataTranslationPromotion($data),
                'slug' => isset($data['slug']) ? $data['slug'] : '',
                'thumbnail' => isset($data['thumbnail']) ? asset(PROMOTION_IMAGES_DIRECTORY.$data['thumbnail']) : '',
            ];
        }, $data);
//dd($dataTranform);
        return $dataTranform;
    }

    protected function setDataTranslationPromotion($data)
    {
    	try {

            $returnValue = [];
            foreach ($data['translation'] as $key => $item) {
                $returnValue[] = $item['side_description'];
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }
}
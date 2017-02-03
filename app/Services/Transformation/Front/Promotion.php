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

    public function getPromotionServiceDetailTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setPromotionServiceDetailTransform($data);
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

    protected function setPromotionServiceDetailTransform($data)
    {
        $dataTranform['title'] = isset($data['title']) ? $data['title'] : '';
        $dataTranform['thumbnail'] = isset($data['title']) ? asset(PROMOTION_IMAGES_DIRECTORY.$data['thumbnail']) : '';
        $dataTranform['content'] = $this->setDataTranslationPromotionContent($data);
        $dataTranform['detail'] = $this->setDataTranslationPromotionDetail($data);
        $dataTranform['gallery'] = $this->setDataTranslationPromotionGallery($data['gallery']);
        $dataTranform['detail_images'] = $this->setImagesTranslationPromotion($data);

        return $dataTranform;

    }

    protected function setDataTranslationPromotionContent($data)
    {
        try {

            $returnValue = [];
            foreach ($data['translation'] as $key => $item) {
                $returnValue['introduction'] = $item['introduction'];
                $returnValue['description'] = $item['description'];
                $returnValue['interior_description'] = $item['interior_description'];
                $returnValue['exterior_description'] = $item['exterior_description'];
                $returnValue['safety_description'] = $item['safety_description'];
                $returnValue['accesories_description'] = $item['accesories_description'];
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    protected function setDataTranslationPromotionDetail($data)
    {
        try {

            $returnValue = [];
            foreach ($data['detail'] as $key => $item) {
                $returnValue['equipment'] = $item['equipment'];
                $returnValue['equipment_interior'] = $item['equipment_interior'];
                $returnValue['equipment_exterior'] = $item['equipment_exterior'];
                $returnValue['information'] = $item['information'];
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    protected function setImagesTranslationPromotion($data)
    {
        try {

            $returnValue = [];
            foreach ($data['images'] as $key => $item) {
                $returnValue['banner_image'] = asset(PROMOTION_IMAGES_DIRECTORY.$item['banner_image']);
                $returnValue['interior_image'] = asset(PROMOTION_IMAGES_DIRECTORY.$item['interior_image']);
                $returnValue['exterior_image'] = asset(PROMOTION_IMAGES_DIRECTORY.$item['exterior_image']);
                $returnValue['safety_image'] = asset(PROMOTION_IMAGES_DIRECTORY.$item['safety_image']);
                $returnValue['accesories_image'] = asset(PROMOTION_IMAGES_DIRECTORY.$item['accesories_image']);
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    protected function setDataTranslationPromotionGallery($data)
    {
        
        $dataTranform = array_map(function($data)
        {
            return [
                'filename' => asset(PROMOTION_IMAGES_DIRECTORY.$data['filename']),
            ];
        }, $data);

        return $dataTranform;
    }
}
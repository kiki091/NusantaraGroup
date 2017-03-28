<?php

namespace App\Services\Transformation\Cms;

use Auth;

class Awards
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getAwardsCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setAwardsCmsTransform($data);
    }

    protected function setAwardsCmsTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'office_name' => isset($data['office_name']) ? $data['office_name'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'filename_url' => isset($data['filename']) ? asset(AWARDS_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }

    /**
     * Get Awards Transformation For Insert
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */
    public function getDataForAwardsTranslation($data, $lastInsertId, $isEditMode)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataForAwardsTranslation($data, $lastInsertId, $isEditMode);
    }

    /**
     * Set Awards Transformation For Insert
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */
    protected function setDataForAwardsTranslation($data, $lastInsertId, $isEditMode)
    {
        try {

            $finalData = [];
            foreach ($data as $key => $value) {

                $finalData[] = [
                    "description" => isset($data[$key]['description']) ? $data[$key]['description'] : '',
                    "awards_id" => $lastInsertId,
                    "created_at" => mysqlDateTimeFormat(),
                    "updated_at" => mysqlDateTimeFormat(),
                ];
            }
            return $finalData;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getSingleAwardsCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleAwardsCmsTransform($data);
    }

    protected function setSingleAwardsCmsTransform($data)
    {

        $dataTranform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTranform['office_name'] = isset($data['office_name']) ? $data['office_name'] : '';
        $dataTranform['thumbnail'] = isset($data['thumbnail']) ? $data['thumbnail'] : '';
        $dataTranform['filename'] = isset($data['filename']) ? $data['filename'] : '';

        $dataTranform['thumbnail_url'] = isset($data['thumbnail']) ? asset(AWARDS_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $dataTranform['filename_url'] = isset($data['filename']) ? asset(AWARDS_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '';

        $dataTranform['total_detail_description'] = isset($data['translation']) ? $this->setDefaultTotalDetailAwardsDescription($data['translation']) : [];

        $dataTranform['awards'] = $this->getAwardsTranslation($data['translation']);

        $dataTranform['total_description'] = isset($data['translation']) ? $this->setDefaultTotalAwardsDescription($data['translation']) : [];

        $dataTranform['meta_title'] = isset($data['meta_title']) ? $data['meta_title'] : '';
        $dataTranform['meta_keyword'] = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $dataTranform['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';

        return $dataTranform;
    }

    /**
     * Get Awards Translation
     * @param $data
     */
    protected function getAwardsTranslation($data)
    {
        return array_map(function($data)
        {
            return [
                'description' => isset($data['description']) ? $data['description'] : '',
            ];
        }, $data);
    }

    /**
     * Set Default Total Detail Description For Edit Awards
     * @param $data
     * @param $index
     * @return array
     */
    protected function setDefaultTotalDetailAwardsDescription($data)
    {
        try {

            $returnValue = [];
            $totalImages = count($data);

            for($i=0; $i<$totalImages; $i++) {
                $returnValue[] = $i;
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Set Default Total Description Awards For Edit
     * @param $data
     * @param $index
     * @return array
     */
    protected function setDefaultTotalAwardsDescription($data)
    {
        try {

            $returnValue = [];
            $totalData = count($data);

            for($i=0; $i<$totalData; $i++) {
                $returnValue[] = $i;
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }

}
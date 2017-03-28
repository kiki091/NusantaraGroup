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
}
<?php

namespace App\Services\Transformation\Cms;

use Auth;

class BranchOffice
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getBranchOfficeCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setBranchOfficeCmsTransform($data);
    }

    public function getBranchOfficeTranslationCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setBranchOfficeTranslationCmsTransform($data);
    }

    /**
     * Get Branch Office Transformation For Insert
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */
    public function getDataForBranchOfficeTranslation($data, $lastInsertId, $isEditMode)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataForBranchOfficeTranslation($data, $lastInsertId, $isEditMode);
    }

    protected function setBranchOfficeTranslationCmsTransform($data)
    {
    	$dataTranform = array_map(function($data)
        {
            return [
                'id'            		=> isset($data['id']) ? $data['id'] : '',
                'title_description'     => isset($data['title_description']) ? $data['title_description'] : '',
                'address'  	 		    => isset($data['address']) ? $data['address'] : '',
                'branch_office_id'      => isset($data['branch_office_id']) ? $data['branch_office_id'] : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }

    protected function setBranchOfficeCmsTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'title' => isset($data['title']) ? $data['title'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'thumbnail_url' => isset($data['thumbnail']) ? asset(THUMBNAIL_BRANCH_OFFICE_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }

    /**
     * Set Branch Office Transformation For Insert
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */
    protected function setDataForBranchOfficeTranslation($data, $lastInsertId, $isEditMode)
    {
        try {

            $finalData = [];
            foreach ($data as $key => $value) {

                $finalData[] = [
                    "title_description" => isset($data[$key]['title_description']) ? $data[$key]['title_description'] : '',
                    "address" => isset($data[$key]['address']) ? $data[$key]['address'] : '',
                    "latitude" => isset($data[$key]['latitude']) ? $data[$key]['latitude'] : '',
                    "longitude" => isset($data[$key]['longitude']) ? $data[$key]['longitude'] : '',
                    "branch_office_id" => $lastInsertId,
                    "created_at" => mysqlDateTimeFormat(),
                    "created_by" => Auth::id(),
                    "updated_at" => mysqlDateTimeFormat(),
                ];
            }
            return $finalData;
        }catch (\Exception $e) {
            return false;
        }
    }
}
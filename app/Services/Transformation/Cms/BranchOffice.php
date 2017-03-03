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

    public function getSingleBranchOfficeCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleBranchOfficeCmsTransform($data);
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

    protected function setSingleBranchOfficeCmsTransform($data)
    {

        $dataTranform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTranform['title'] = isset($data['title']) ? $data['title'] : '';
        $dataTranform['slug'] = isset($data['slug']) ? $data['slug'] : '';
        $dataTranform['side_description'] = isset($data['side_description']) ? $data['side_description'] : '';
        $dataTranform['description'] = isset($data['description']) ? $data['description'] : '';
        $dataTranform['office_name'] = isset($data['office_name']) ? $data['office_name'] : '';
        $dataTranform['address'] = isset($data['address']) ? $data['address'] : '';
        $dataTranform['thumbnail_image'] = isset($data['thumbnail']) ? $data['thumbnail'] : '';
        $dataTranform['thumbnail_url'] = isset($data['thumbnail']) ? asset(THUMBNAIL_BRANCH_OFFICE_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';

        $dataTranform['total_detail_image'] = isset($data['slider']) ? $this->setDefaultTotalDetailImage($data['slider']) : [];

        $dataTranform['images_url'] = isset($data['slider']) ? $this->setImageUrlImagesForEdit($data['slider'], 'images') : [];

        $dataTranform['slider'] = isset($data['slider']) ? $this->populateImagesForEdit($data['slider'], 'images') : [];

        $dataTranform['branch_office'] = $this->getBranchOfficeTranslation($data['branch_office']);
dd($dataTranform);
        return $dataTranform;
    }

    /**
     * Get Branch Office Translation
     * @param $data
     */
    protected function getBranchOfficeTranslation($data)
    {
        return array_map(function($data)
        {
            return [
                'title_description' => isset($data['title_description']) ? $data['title_description'] : '',
                'address' => isset($data['address']) ? $data['address'] : '',
                'latitude' => isset($data['latitude']) ? $data['latitude'] : '',
                'longitude' => isset($data['longitude']) ? $data['longitude'] : '',
            ];
        }, $data);
    }

    /**
     * Set Default Total Detail Image For Edit Branch Office
     * @param $data
     * @param $index
     * @return array
     */
    protected function setDefaultTotalDetailImage($data)
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
     * Populate Images URL For Edit Branch Office
     * @param $data
     * @param $index
     * @return array
     */
    protected function populateImagesForEdit($data, $index)
    {
        try {

            return array_map(function($data)
            {
                return [
                    'id' => isset($data['id']) ? $data['id'] : '',
                    'images' => isset($data['images']) ? $data['images'] : '',
                ];
            }, $data);

        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Set Images URL For Edit Branch Office
     * @param $data
     * @param $index
     * @return array
     */
    protected function setImageUrlImagesForEdit($data, $index)
    {
        try {

            $returnValue = [];
            foreach ($data as $key => $item) {
                $returnValue[] = asset(BRANCH_OFFICE_IMAGES_SLIDER_DIRECTORY.rawurlencode($item[$index]));
            }

            return $returnValue;

        } catch (\Exception $e) {
            return [];
        }
    }
}
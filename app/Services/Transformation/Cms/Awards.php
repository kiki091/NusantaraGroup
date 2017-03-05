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
                'images_url' => isset($data['images']) ? asset(AWARDS_IMAGES_DIRECTORY.rawurlencode($data['images'])) : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }
}
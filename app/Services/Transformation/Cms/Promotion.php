<?php

namespace App\Services\Transformation\Cms;

use Auth;

class Promotion
{
	/**
     * get Data Promotion Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getPromotionCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setPromotionCmsTransform($data);
    }

    protected function setPromotionCmsTransform($data)
    {
        dd($data);
    }

}
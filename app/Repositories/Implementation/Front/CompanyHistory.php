<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\CompanyHistory as CompanyHistoryInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\CompanyHistory as CompanyHistoryModel;
use App\Models\CompanyHistoryImage as CompanyHistoryImageModel;
use App\Services\Transformation\Front\CompanyHistory as CompanyHistoryTransformation;
use Cache;
use Session;
use DB;

class CompanyHistory extends BaseImplementation implements CompanyHistoryInterface
{

    protected $companyHistory;
    protected $companyHistoryImage;
    protected $companyHistoryTransformation;

    function __construct(CompanyHistoryModel $companyHistory, CompanyHistoryImageModel $companyHistoryImage, CompanyHistoryTransformation $companyHistoryTransformation)
    {
        $this->companyHistory = $companyHistory;
        $this->companyHistoryImage = $companyHistoryImage;
        $this->companyHistoryTransformation = $companyHistoryTransformation;
    }

    public function getCompanyHistory($params = array())
    {
        $params = [
            'is_active' => true,
        ];
        $companyHistoryData = $this->getCompanyHistoryData($params, 'asc', 'array', true);
        //dd($mainBannerData);
        return $this->companyHistoryTransformation->getCompanyHistoryFrontTransform($companyHistoryData);
    }

    public function getCompanyHistoryImage($params = array())
    {
        $params = [
            'is_active' => true,
        ];
        $companyHistoryImageData = $this->getCompanyHistoryImageBanner($params, 'asc', 'array', true);
        //dd($mainBannerData);
        return $this->companyHistoryTransformation->getCompanyHistoryImageFrontTransform($companyHistoryImageData);
    }

    public function getCompanyHistorySeo()
    {
        $params = [
            'is_active' => true,
        ];
        $companyHistoryData = $this->getCompanyHistoryData($params, 'asc', 'array', true);

        return $this->companyHistoryTransformation->getCompanyHistorySeoDetailFrontTransform($companyHistoryData);
    }

    /**
     * Get All Company History
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    
    protected function getCompanyHistoryData($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $companyHistory = $this->companyHistory;

        if(isset($params['is_active'])) {
            $companyHistory->isActive($params['is_active']);
        }


        if(!$companyHistory->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) 
                {
                    return $companyHistory->get()->toArray();
                } 
                else 
                {
                    return $companyHistory->first()->toArray();
                }

            break;
        }
    }

    /**
     * Get All Company History Image
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    
    protected function getCompanyHistoryImageBanner($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $companyHistoryImage = $this->companyHistoryImage;

        if(isset($params['is_active'])) {
            $companyHistoryImage->isActive($params['is_active']);
        }


        if(!$companyHistoryImage->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) 
                {
                    return $companyHistoryImage->get()->toArray();
                } 
                else 
                {
                    return $companyHistoryImage->first()->toArray();
                }

            break;
        }
    }

}
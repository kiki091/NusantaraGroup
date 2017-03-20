<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\CompanyProfile as CompanyProfileInterface;
use App\Models\Front\CompanyProfileModel as CompanyProfileModel;
use App\Services\Transformation\Front\CompanyProfile as CompanyProfileTransformation;
use Cache;
use Session;
use DB;

class CompanyProfile implements CompanyProfileInterface
{

    protected $companyProfile;
    protected $companyProfileTransformation;

    function __construct(CompanyProfileModel $companyProfile, CompanyProfileTransformation $companyProfileTransformation)
    {
        $this->companyProfile = $companyProfile;
        $this->companyProfileTransformation = $companyProfileTransformation;
    }

    public function getCompanyProfile()
    {
        $companyProfileData = $this->companyProfile();
        //dd($mainBannerData);
        return $this->companyProfileTransformation->getCompanyProfileFrontTransform($companyProfileData);
    }

    public function getCompanyProfileSeo()
    {
        $companyProfileData = $this->companyProfile();
        
        return $this->companyProfileTransformation->getCompanyProfileSeoFrontTransform($companyProfileData);
    }

    /**
     * Get All Branch Office
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function companyProfile($params = array(), $returnType = 'array', $returnSingle = false)
    {

        $companyProfile = $this->companyProfile;


        if(!$companyProfile->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $companyProfile->first()->toArray();
                } 
                else 
                {
                    return $companyProfile->first()->toArray();
                }

            break;
        }
    }

}
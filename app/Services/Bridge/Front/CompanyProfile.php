<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\CompanyProfile as CompanyProfileInterface;

class CompanyProfile {

	protected $companyProfile;

    public function __construct(CompanyProfileInterface $companyProfile)
    {
        $this->companyProfile = $companyProfile;
    }

    /**
     * Get Data Company Profile
     * @param $params
     * @return mixed
     */
    public function getCompanyProfile()
    {
        return $this->companyProfile->getCompanyProfile();
    }

    /**
     * Get Data Seo Company Profile
     * @param $params
     * @return mixed
     */
    public function getCompanyProfileSeo()
    {
        return $this->companyProfile->getCompanyProfileSeo();
    }

}
<?php

namespace App\Repositories\Contracts\Front;


interface CompanyProfile
{

    /**
     * Get Company Profile
     * @param $params
     * @return mixed
     */
    public function getCompanyProfile();

    /**
     * Get Seo Company Profile
     * @param $params
     * @return mixed
     */
    public function getCompanyProfileSeo();


}
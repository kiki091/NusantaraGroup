<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\CompanyHistory as CompanyHistoryInterface;

class CompanyHistory {

	protected $companyHistory;

    public function __construct(CompanyHistoryInterface $companyHistory)
    {
        $this->companyHistory = $companyHistory;
    }

    /**
     * Get Data Company History
     * @param $params
     * @return mixed
     */
    public function getCompanyHistory()
    {
        return $this->companyHistory->getCompanyHistory();
    }

    /**
     * Get Data Company History
     * @param $params
     * @return mixed
     */
    public function getCompanyHistoryImage()
    {
        return $this->companyHistory->getCompanyHistoryImage();
    }

    /**
     * Get Data Company History SEO
     * @param $params
     * @return mixed
     */
    public function getCompanyHistorySeo()
    {
        return $this->companyHistory->getCompanyHistorySeo();
    }

}
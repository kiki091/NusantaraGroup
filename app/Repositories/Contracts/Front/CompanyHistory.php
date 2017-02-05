<?php

namespace App\Repositories\Contracts\Front;


interface CompanyHistory
{

    /**
     * Get Data Company History
     * @param $params
     * @return mixed
     */
    public function getCompanyHistory();

    /**
     * Get Data Company History
     * @param $params
     * @return mixed
     */
    public function getCompanyHistoryImage();

    /**
     * Get Data Company History SEO
     * @param $params
     * @return mixed
     */
    public function getCompanyHistorySeo();


}
<?php

namespace App\Repositories\Contracts\Front;


interface BranchOffice
{

    /**
     * Get Data Branch Office
     * @param $params
     * @return mixed
     */
    public function getBranchOffice();

    /**
     * Get Data Branch Office For Booking Service
     * @param $params
     * @return mixed
     */
    public function getBranchOfficeForBookingService();

	/**
     * Get Data BranchOffice Detail
     * @param $params
     * @return mixed
     */
    public function getBranchOfficeDetail($slug);

    /**
     * Get Data BranchOffice Seo
     * @param $params
     * @return mixed
     */

    public function getBranchOfficeSeo($slug);

}
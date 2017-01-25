<?php

namespace App\Repositories\Contracts\Front;


interface BranchOffice
{

    /**
     * Get Data Main Banner
     * @param $params
     * @return mixed
     */
    public function getBranchOffice();

    public function getBranchOfficeDetail($slug);

    public function getBranchOfficeSeo($slug);

}
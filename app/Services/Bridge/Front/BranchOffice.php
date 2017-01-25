<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\BranchOffice as BranchOfficeInterface;

class BranchOffice {

	protected $BranchOffice;

    public function __construct(BranchOfficeInterface $BranchOffice)
    {
        $this->BranchOffice = $BranchOffice;
    }

    /**
     * Get Data Branch Office
     * @param $params
     * @return mixed
     */
    public function getBranchOffice()
    {
        return $this->BranchOffice->getBranchOffice();
    }

    /**
     * Get Detail Branch Office
     * @param $params
     * @return mixed
     */
    public function getBranchOfficeDetail($slug = '')
    {
        return $this->BranchOffice->getBranchOfficeDetail($slug);
    }

    /**
     * Get Detail Branch Office Seo
     * @param $params
     * @return mixed
     */
    public function getBranchOfficeSeo($slug = '')
    {
        return $this->BranchOffice->getBranchOfficeSeo($slug);
    }
}
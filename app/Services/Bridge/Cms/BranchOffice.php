<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\BranchOffice as BranchOfficeInterface;

class BranchOffice {

	protected $branchOffice;

    public function __construct(BranchOfficeInterface $branchOffice)
    {
        $this->branchOffice = $branchOffice;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params)
    {
        return $this->branchOffice->getData($params);
    }

    /**
     * Get Data Translation
     * @param $params
     * @return mixed
     */
    public function getDataTranslation($params)
    {
        return $this->branchOffice->getDataTranslation($params);
    }

    /**
     * Store Data
     * @param $params
     * @return mixed
     */
    public function store($params, $property_location_id)
    {
        return $this->branchOffice->store($params, $property_location_id);
    }

    /**
     * Change Status
     * @param $params
     * @return mixed
     */
    public function changeStatus($params)
    {
        return $this->branchOffice->changeStatus($params);
    }

}
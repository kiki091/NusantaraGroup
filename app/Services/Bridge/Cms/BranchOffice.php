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
     * Edit Data
     * @param $params
     * @return mixed
     */
    public function edit($params)
    {
        return $this->branchOffice->edit($params);
    }

    /**
     * Edit Image Slider
     * @param $params
     * @return mixed
     */
    public function editImageSlider($params)
    {
        return $this->branchOffice->editImageSlider($params);
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

    /**
     * Order Data
     * @param $params
     * @return mixed
     */
    public function order($params)
    {
        return $this->branchOffice->order($params);
    }

    /**
     * Delete Data
     * @param $params
     * @return mixed
     */
    public function delete($params)
    {
        return $this->branchOffice->delete($params);
    }

    /**
     * Delete Image Slider
     * @param $params
     * @return mixed
     */
    public function deleteImageSlider($params)
    {
        return $this->branchOffice->deleteImageSlider($params);
    }

    /**
     * Delete Office
     * @param $params
     * @return mixed
     */
    public function deleteOfficeDetail($params)
    {
        return $this->branchOffice->deleteOfficeDetail($params);
    }

}
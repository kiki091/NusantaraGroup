<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\Carier as CarierInterface;

class Carier {

	protected $carier;

    public function __construct(CarierInterface $carier)
    {
        $this->carier = $carier;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params)
    {
        return $this->carier->getData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params, $property_location_id)
    {
        return $this->carier->store($params, $property_location_id);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params)
    {
        return $this->carier->edit($params);
    }

    /**
     * Change Status Data 
     * @param $params
     * @return mixed
     */
    public function changeStatus($params)
    {
        return $this->carier->changeStatus($params);
    }

    /**
     * Order Data 
     * @param $params
     * @return mixed
     */
    public function order($params)
    {
        return $this->carier->order($params);
    }

    /**
     * Delete Data 
     * @param $params
     * @return mixed
     */
    public function delete($params)
    {
        return $this->carier->delete($params);
    }
}
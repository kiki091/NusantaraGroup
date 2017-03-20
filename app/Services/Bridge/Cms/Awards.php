<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\Awards as AwardsInterface;

class Awards {

	protected $awards;

    public function __construct(AwardsInterface $awards)
    {
        $this->awards = $awards;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params)
    {
        return $this->awards->getData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params, $property_id)
    {
        return $this->awards->store($params, $property_id);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params)
    {
        return $this->awards->edit($params);
    }

    /**
     * Get Change Status
     */
    public function changeStatus($params)
    {
        return $this->awards->changeStatus($params);
    }

    /**
     * Get Ordering
     */
    public function order($params)
    {
        return $this->awards->order($params);
    }

    /**
     * Delete Data
     */
    public function delete($params)
    {
        return $this->awards->delete($params);
    }

}
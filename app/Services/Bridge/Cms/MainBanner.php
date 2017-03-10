<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\MainBanner as MainBannerInterface;

class MainBanner {

	protected $mainBanner;

    public function __construct(MainBannerInterface $mainBanner)
    {
        $this->mainBanner = $mainBanner;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params, $key)
    {
        return $this->mainBanner->getData($params, $key);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params, $property_id, $key)
    {
        return $this->mainBanner->store($params, $property_id, $key);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params)
    {
        return $this->mainBanner->edit($params);
    }

    /**
     * Get Change Status
     */
    public function changeStatus($params)
    {
        return $this->mainBanner->changeStatus($params);
    }

    /**
     * Order Data
     */
    public function order($params)
    {
        return $this->mainBanner->order($params);
    }

    /**
     * Delete Data
     */
    public function delete($params)
    {
        return $this->mainBanner->delete($params);
    }

}
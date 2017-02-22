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
    public function getData($params = [])
    {
        return $this->mainBanner->getData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params, $key)
    {
        return $this->mainBanner->store($params, $key);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params, $key)
    {
        return $this->mainBanner->edit($params, $key);
    }

    /**
     * Get Change Status
     */
    public function changeStatus($params, $key)
    {
        return $this->mainBanner->changeStatus($params, $key);
    }

}
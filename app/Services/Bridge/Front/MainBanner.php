<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\MainBanner as MainBannerInterface;

class MainBanner {

	protected $MainBanner;

    public function __construct(MainBannerInterface $MainBanner)
    {
        $this->MainBanner = $MainBanner;
    }

    /**
     * Get Data Main Banner
     * @param $params
     * @return mixed
     */
    public function getMainBanner($params = [])
    {
        return $this->MainBanner->getMainBanner($params);
    }
}
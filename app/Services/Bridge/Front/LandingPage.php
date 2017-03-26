<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\LandingPage as LandingPageInterface;

class LandingPage {

	protected $LandingPage;

    public function __construct(LandingPageInterface $LandingPage)
    {
        $this->LandingPage = $LandingPage;
    }

    /**
     * Get Data Main Banner
     * @param $params
     * @return mixed
     */
    public function getlandingPage()
    {
        return $this->LandingPage->getlandingPage();
    }

    /**
     * Get Data Main Banner
     * @param $params
     * @return mixed
     */
    public function getlandingPageSeo()
    {
        return $this->LandingPage->getlandingPageSeo();
    }
}
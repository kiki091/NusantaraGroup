<?php

namespace App\Repositories\Contracts\Front;


interface LandingPage
{

    /**
     * Get Data Main Banner
     * @param $params
     * @return mixed
     */
    public function getlandingPage();

    public function getlandingPageSeo();
}
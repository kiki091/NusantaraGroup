<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\StaticPage as StaticPageInterface;

class StaticPage {

	protected $staticPage;

    public function __construct(StaticPageInterface $staticPage)
    {
        $this->staticPage = $staticPage;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->staticPage->getData($params);
    }

}
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

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->staticPage->store($params);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->staticPage->edit($params);
    }

    /**
     * Get Change Status
     */
    public function changeStatus($params = [])
    {
        return $this->staticPage->changeStatus($params);
    }

}
<?php

namespace App\Repositories\Contracts\Cms;


interface StaticPage
{

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params);
}
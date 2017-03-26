<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Subscribe as SubscribeInterface;

class Subscribe {

	protected $subscribe;

    public function __construct(SubscribeInterface $subscribe)
    {
        $this->subscribe = $subscribe;
    }

    /**
     * Get Data Branch Office
     * @param $params
     * @return mixed
     */
    public function store($params)
    {
        return $this->subscribe->store($params);
    }

}
<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Carier as CarierInterface;

class Carier {

	protected $carier;

    public function __construct(CarierInterface $carier)
    {
        $this->carier = $carier;
    }

    /**
     * Get Data Carier
     * @param $params
     * @return mixed
     */
    public function getCarier()
    {
        return $this->carier->getCarier();
    }

}
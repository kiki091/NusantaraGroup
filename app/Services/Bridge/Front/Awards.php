<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Awards as AwardsInterface;

class Awards {

	protected $award;

    public function __construct(AwardsInterface $award)
    {
        $this->award = $award;
    }

    /**
     * Get Data Branch Office
     * @param $params
     * @return mixed
     */
    public function getAwards()
    {
        return $this->award->getAwards();
    }

}
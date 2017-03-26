<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\Awards as AwardsInterface;
use App\Models\Front\AwardsModel as AwardsModels;
use App\Models\Front\AwardsModelTrans as AwardsModelsTrans;
use App\Services\Transformation\Front\Awards as AwardsTransformation;
use Cache;
use Session;
use DB;

class Awards implements AwardsInterface
{

    protected $awards;
    protected $awardsTrans;
    protected $awardsTransformation;

    function __construct(AwardsModels $awards, AwardsModelsTrans $awardsTrans, AwardsTransformation $awardsTransformation)
    {
        $this->awards = $awards;
        $this->awardsTrans = $awardsTrans;
        $this->awardsTransformation = $awardsTransformation;
    }

    public function getAwards()
    {
        $awardsData = $this->awards();
        //dd($mainBannerData);
        return $this->awardsTransformation->getAwardsFrontTransform($awardsData);
    }

    /**
     * Get All Branch Office
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function awards($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $awards = $this->awards
            ->with('translation')
            ->with('translations');

        if(isset($params['is_active'])) {
            $awards->isActive($params['is_active']);
        }


        if(!$awards->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $awards->get()->toArray();
                } 
                else 
                {
                    return $awards->first()->toArray();
                }

            break;
        }
    }

}
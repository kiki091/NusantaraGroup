<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\MainBanner as MainBannerInterface;
use App\Model\Front\MainBanner as MainBannerModel;
use App\Services\Transformation\Front\MainBanner as MainBannerTransformation;
use Cache;
use Session;
use DB;

class MainBanner implements MainBannerInterface
{

    protected $mainBanner;
    protected $mainBannerTransformation;

    function __construct(MainBannerModel $mainBanner, MainBannerTransformation $mainBannerTransformation)
    {
        $this->mainBanner = $mainBanner;
        $this->mainBannerTransformation = $mainBannerTransformation;
    }

    public function getMainBanner()
    {
        $mainBannerData = $this->mainBanner();
        //dd($mainBannerData);
        return $this->mainBannerTransformation->getMainBannerFrontTransform($mainBannerData);
    }

    /**
     * Get All Main Banner
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function mainBanner($returnType = 'array', $returnSingle = false)
    {

        $mainBanner = $this->mainBanner;
        
        //$mainBanner->orderBy('created_at', 'desc');

        if(!$mainBanner->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $mainBanner->get()->toArray();
                }
                else 
                {
                    return $mainBanner->first()->toArray();
                }
            break;
        }
    }

}
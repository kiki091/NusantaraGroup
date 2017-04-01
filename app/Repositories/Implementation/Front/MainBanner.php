<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\MainBanner as MainBannerInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\MainBanner as MainBannerModels;
use App\Services\Transformation\Front\MainBanner as MainBannerTransformation;
use Cache;
use Session;
use DB;

class MainBanner extends BaseImplementation implements MainBannerInterface
{

    protected $mainBanner;
    protected $mainBannerTransformation;

    function __construct(MainBannerModels $mainBanner, MainBannerTransformation $mainBannerTransformation)
    {
        $this->mainBanner = $mainBanner;
        $this->mainBannerTransformation = $mainBannerTransformation;
    }

    public function getMainBanner($param = array())
    {
        $data = [
            'is_active' => true,
        ];

        $mainBannerData = $this->mainBanner($data, 'asc', 'array', true);
        //dd($mainBannerData);
        return $this->mainBannerTransformation->getMainBannerFrontTransform($mainBannerData);
    }

    /**
     * Get All Main Banner
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function mainBanner($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $mainBanner = $this->mainBanner->with('property_location');
        
        if(isset($data['is_active'])) {
            $mainBanner->isActive($data['is_active']);
        }

        if(!$mainBanner->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) 
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
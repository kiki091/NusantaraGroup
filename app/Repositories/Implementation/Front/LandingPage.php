<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\LandingPage as LandingPageInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Landing as LandingModelServices;
use App\Services\Transformation\Front\LandingPage as LandingPageTransformation;
use Cache;
use Session;
use DB;

class LandingPage extends BaseImplementation implements LandingPageInterface
{

    protected $landingPage;
    protected $landingPageTransformation;

    function __construct(LandingModelServices $landingPage, LandingPageTransformation $landingPageTransformation)
    {
        $this->landingPage = $landingPage;
        $this->landingPageTransformation = $landingPageTransformation;
    }

    public function getlandingPage()
    {
        $landingPageData = $this->landingPage();
        //dd($mainBannerData);
        return $this->landingPageTransformation->getlandingPageFrontTransform($landingPageData);
    }

    public function getlandingPageSeo()
    {
        $landingPageData = $this->landingPage();
        //dd($mainBannerData);
        return $this->landingPageTransformation->getlandingPageSeoFrontTransform($landingPageData);
    }

    /**
     * Get All Main Banner
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function landingPage($returnType = 'array', $returnSingle = false)
    {

        $landingPage = $this->landingPage;
        
        //$landingPage->orderBy('created_at', 'desc');

        if(!$landingPage->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $landingPage->first()->toArray();
                }
            break;
        }
    }

}
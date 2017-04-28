<?php

namespace App\Http\Controllers\Nusantara\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Service as Service;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use Response;

class ServiceController extends FrontController
{
    protected $service;
    protected $landingPage;
    protected $footerContent;

    public function __construct(LandingPageServices $landingPage, Service $service, FooterContentServices $footerContent)
    {
        $this->service = $service;
        $this->landingPage = $landingPage;
        $this->footerContent = $footerContent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function category($slug)
    {

        $data['services_category'] = $this->service->getServicesByCategory($slug);

        if(!empty($data['services_category']) && $data['services_category'] != Null)
        {
            $blade = self::URL_BLADE_FRONT_SITE.'.service-category';

            if(view()->exists($blade))
            {
                return view($blade, $data);
            }
        }
        return abort(404);
    }

    public function detail($slug)
    {
        $data['service_detail'] = $this->service->getDetailService($slug);
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->service->getSeoService($slug);
        $data['count'] = count($data['service_detail']['slider']);
        
        if(!empty($data['service_detail']) && $data['service_detail'] != Null)
        {
            $blade = self::URL_BLADE_FRONT_SITE.'.service-detail';

            if(view()->exists($blade))
            {
                return view($blade, $data);
            }
        }

        return abort(404);

        
    }
}


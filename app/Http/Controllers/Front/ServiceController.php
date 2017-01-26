<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Front\Service as Service;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use Response;

class ServiceController extends Controller
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

    public function index(Request $request)
    {

    }

    public function category($slug)
    {

        $data['services_category'] = $this->service->getServicesByCategory($slug);

        if(!empty($data['services_category']) && $data['services_category'] != Null)
        {
            $blade = 'Front.Pages.service-category';

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

        if(!empty($data['service_detail']) && $data['service_detail'] != Null)
        {
            $blade = 'Front.Pages.service-detail';

            if(view()->exists($blade))
            {
                return view($blade, $data);
            }
        }

        return abort(404);

        
    }
}


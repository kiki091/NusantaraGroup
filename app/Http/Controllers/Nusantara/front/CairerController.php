<?php

namespace App\Http\Controllers\Nusantara\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Carier as CarierService;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use Response;

class CairerController extends FrontController
{
    protected $carier;
    protected $landingPage;
    protected $footerContent;

    public function __construct(LandingPageServices $landingPage, CarierService $carier, FooterContentServices $footerContent)
    {
        $this->carier = $carier;
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
        $data['carier'] = $this->carier->getCarier();
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->landingPage->getlandingPageSeo();

        if(!empty($data['carier']) && $data['carier'] != Null)
        {
            $blade = self::URL_BLADE_FRONT_SITE.'.carier';

            if(view()->exists($blade))
            {
                return view($blade, $data);
            }
        }
        else
        {
            return abort(404);
        }

        
    }
}


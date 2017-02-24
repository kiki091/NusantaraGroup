<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Front\Carier as CarierService;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use Response;

class CairerController extends Controller
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
            $blade = 'Front.Pages.carier';

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


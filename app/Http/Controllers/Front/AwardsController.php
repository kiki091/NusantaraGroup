<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Front\Awards as AwardsService;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use Response;

class AwardsController extends Controller
{
    protected $awards;
    protected $landingPage;
    protected $footerContent;

    public function __construct(LandingPageServices $landingPage, AwardsService $awards, FooterContentServices $footerContent)
    {
        $this->awards = $awards;
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
        $data['awards'] = $this->awards->getAwards();
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->landingPage->getlandingPageSeo();

        if(!empty($data['awards']) && $data['awards'] != Null)
        {
            $blade = 'Front.Pages.company-awards';

            if(view()->exists($blade))
            {
                return view($blade, $data);
            }
        }

        
    }
}


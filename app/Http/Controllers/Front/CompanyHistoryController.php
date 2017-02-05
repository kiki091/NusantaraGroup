<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Front\CompanyHistory as CompanyHistoryService;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use Response;

class CompanyHistoryController extends Controller
{
    protected $companyHistory;
    protected $landingPage;
    protected $footerContent;

    public function __construct(CompanyHistoryService $companyHistory, LandingPageServices $landingPage, FooterContentServices $footerContent)
    {
        $this->companyHistory = $companyHistory;
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
        $data['banner'] = $this->companyHistory->getCompanyHistoryImage();
        $data['company_history'] = $this->companyHistory->getCompanyHistory();
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->companyHistory->getCompanyHistorySeo();
dd($data);
        $blade = 'Front.Pages.company-history';

        if(view()->exists($blade))
        {
            return view($blade);
        }
    }

}


<?php

namespace App\Http\Controllers\Nusantara\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Awards as AwardsService;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\BranchOffice as BranchOfficeServices;
use App\Services\Bridge\Front\CompanyProfile as CompanyProfileServices;
use App\Services\Bridge\Front\CompanyHistory as CompanyHistoryService;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use Response;

class OfficeController extends FrontController
{
    protected $awards;
    protected $landingPage;
    protected $branchOffice;
    protected $companyProfile;
    protected $companyHistory;
    protected $footerContent;

    public function __construct(LandingPageServices $landingPage, AwardsService $awards, BranchOfficeServices $branchOffice, CompanyProfileServices $companyProfile, CompanyHistoryService $companyHistory, FooterContentServices $footerContent)
    {
        $this->awards = $awards;
        $this->landingPage = $landingPage;
        $this->branchOffice = $branchOffice;
        $this->companyProfile = $companyProfile;
        $this->companyHistory = $companyHistory;
        $this->footerContent = $footerContent;
    }

    /**
     * Display a Awards Function
     *
     * @return \Illuminate\Http\Response
     */

    public function awards(Request $request)
    {
        $data['awards'] = $this->awards->getAwards();
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->landingPage->getlandingPageSeo();

        if(!empty($data['awards']) && $data['awards'] != Null)
        {
            $blade = self::URL_BLADE_FRONT_SITE.'.company-awards';

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

    /**
     * Display a Branch Office Function
     *
     * @return \Illuminate\Http\Response
     */

    public function branchOffice($slug)
    {

        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['branch_office'] = $this->branchOffice->getBranchOfficeDetail($slug);
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->branchOffice->getBranchOfficeSeo($slug);

        if(!empty($data['branch_office']) && $data['branch_office'] != Null){

            $blade = self::URL_BLADE_FRONT_SITE.'.company-branch-office';

            if(view()->exists($blade)) {
                return view($blade, $data);
            }

        }
        else
        {

            return abort(404);

        }
    }

    /**
     * Display a Company Profile Function.
     *
     * @return \Illuminate\Http\Response
     */

    public function companyProfile(Request $request)
    {
        $data['company_profile'] = $this->companyProfile->getCompanyProfile();
        $data['seo'] = $this->companyProfile->getCompanyProfileSeo();
        $data['footer_content'] = $this->footerContent->getFooterContent();

        $blade = self::URL_BLADE_FRONT_SITE.'.company-profile';

        if(view()->exists($blade))
        {
            return view($blade,$data);
        }
        return abort(404);
    }

    /**
     * Display Company History
     *
     * @return \Illuminate\Http\Response
     */

    public function companyHistory(Request $request)
    {
        $data['banner'] = $this->companyHistory->getCompanyHistoryImage();
        $data['company_history'] = $this->companyHistory->getCompanyHistory();
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->companyHistory->getCompanyHistorySeo();
        dd($data);
        $blade = self::URL_BLADE_FRONT_SITE.'.company-history';

        if(view()->exists($blade))
        {
            return view($blade);
        }
    }
}


<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Front\MainBanner as MainBannerServices;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\BranchOffice as BranchOfficeServices;
use App\Services\Bridge\Front\CompanyProfile as CompanyProfileServices;
use App\Services\Bridge\Front\Service as Service;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use App\Services\Api\Response as ResponseService;

class LandingController extends Controller
{
    protected $landingPage;
    protected $mainBanner;
    protected $footerContent;
    protected $branchOffice;
    protected $companyProfile;
    protected $services;
    protected $response;
    protected $validationMessage = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(LandingPageServices $landingPage, MainBannerServices $mainBanner, FooterContentServices $footerContent, BranchOfficeServices $branchOffice,Service $services, CompanyProfileServices $companyProfile, ResponseService $response)
    {
        //parent::__construct(DataHelper::MAIN_BANNER_DIRECTORY);

        $this->landingPage = $landingPage;
        $this->mainBanner = $mainBanner;
        $this->footerContent = $footerContent;
        $this->branchOffice = $branchOffice;
        $this->companyProfile = $companyProfile;
        $this->services = $services;
        $this->response = $response;
    }

    public function index(Request $request)
    {
        $data['main_banners'] = $this->mainBanner->getMainBanner();
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['branch_office'] = $this->branchOffice->getBranchOffice();
        $data['company_profile'] = $this->companyProfile->getCompanyProfile();
        $data['services'] = $this->services->getServicesLanding();
        $data['services_category'] = $this->services->getServicesCategory();
        $data['seo'] = $this->landingPage->getlandingPageSeo();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        //dd($data['services_category']);
        $blade = 'Front.Pages.landing';
        
        if(view()->exists($blade))
        {
            return view($blade, $data);
        }
        return abort(404);
    }

}

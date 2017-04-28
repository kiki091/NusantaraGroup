<?php

namespace App\Http\Controllers\Nusantara\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\MainBanner as MainBannerServices;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\BranchOffice as BranchOfficeServices;
use App\Services\Bridge\Front\CompanyProfile as CompanyProfileServices;
use App\Services\Bridge\Front\Service as EventService;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use App\Services\Api\Response as ResponseService;

class LandingController extends FrontController
{
    protected $landingPage;
    protected $mainBanner;
    protected $footerContent;
    protected $branchOffice;
    protected $companyProfile;
    protected $services;
    protected $response;
    protected $validationMessage = '';

    const MAIN_BANNER_KEY = 'banner::landing';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(LandingPageServices $landingPage, MainBannerServices $mainBanner, FooterContentServices $footerContent, BranchOfficeServices $branchOffice, EventService $services, CompanyProfileServices $companyProfile, ResponseService $response)
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
        $data['main_banners'] = $this->mainBanner->getMainBanner(self::MAIN_BANNER_KEY);
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['branch_office'] = $this->branchOffice->getBranchOffice();
        $data['company_profile'] = $this->companyProfile->getCompanyProfile();
        $data['services'] = $this->services->getServicesLanding();
        $data['services_category'] = $this->services->getServicesCategory();
        $data['seo'] = $this->landingPage->getlandingPageSeo();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['count'] = count($data['main_banners']);
        //dd($c);
        $blade = self::URL_BLADE_FRONT_SITE.'.landing';
        
        if(view()->exists($blade))
        {
            return view($blade, $data);
        }
        return abort(404);
    }

}

<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\CompanyProfile as CompanyProfileServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use App\Services\Api\Response as ResponseService;

class CompanyProfileController extends Controller
{
    protected $landingPage;
    protected $companyProfile;
    protected $footerContent;
    protected $response;
    protected $validationMessage = '';

    public function __construct(LandingPageServices $landingPage, CompanyProfileServices $companyProfile, FooterContentServices $footerContent)
    {
        $this->landingPage = $landingPage;
        $this->companyProfile = $companyProfile;
        $this->footerContent = $footerContent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data['company_profile'] = $this->companyProfile->getCompanyProfile();
        $data['seo'] = $this->companyProfile->getCompanyProfileSeo();
        $data['footer_content'] = $this->footerContent->getFooterContent();

        $blade = 'Front.Pages.company-profile';

        if(view()->exists($blade))
        {
            return view($blade,$data);
        }
        return abort(404);
    }
}


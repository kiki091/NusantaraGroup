<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\BranchOffice as BranchOfficeServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use Response;

class CompanyBranchOfficeController extends Controller
{
    protected $landingPage;
    protected $branchOffice;
    protected $footerContent;

    public function __construct(LandingPageServices $landingPage, BranchOfficeServices $branchOffice, FooterContentServices $footerContent)
    {
        $this->landingPage = $landingPage;
        $this->branchOffice = $branchOffice;
        $this->footerContent = $footerContent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getDetail($slug)
    {

        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['branch_office'] = $this->branchOffice->getBranchOfficeDetail($slug);
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->branchOffice->getBranchOfficeSeo($slug);

        if(!empty($data['branch_office']) && $data['branch_office'] != Null){

            $blade = 'Front.Pages.company-branch-office';

            if(view()->exists($blade)) {
                return view($blade, $data);
            }

        }
        else
        {

            return abort(404);

        }
    }
}


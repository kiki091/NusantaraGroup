<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Front\CompanyProfileModel as CompanyProfileService;
use Response;

class CompanyProfileController extends Controller
{
    protected $companyProfile;

    public function __construct(CompanyProfileService $companyProfile)
    {
        $this->companyProfile = $companyProfile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $blade = 'Front.Pages.company-profile';

        if(view()->exists($blade))
        {
            return view($blade);
        }
    }

    public function getData(Request $request)
    {
        
        $profile_page = $this->companyProfile::all();
        $response = [
            'profile' => $profile_page
        ];
        return response()->json($response);
    }
}


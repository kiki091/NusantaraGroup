<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Front\CompanyVisiMisiModel as CompanyVisiMisiService;
use Response;

class CompanyVisiMisiController extends Controller
{
    protected $companyVisiMisi;

    public function __construct(CompanyVisiMisiService $companyVisiMisi)
    {
        $this->companyVisiMisi = $companyVisiMisi;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $blade = 'Front.Pages.visi-misi';

        if(view()->exists($blade))
        {
            return view($blade);
        }
    }

    public function getData(Request $request)
    {
        
        $visi_misi_page = $this->companyVisiMisi::all();
        $response = [
            'visi_misi' => $visi_misi_page
        ];
        return response()->json($response);
    }
}


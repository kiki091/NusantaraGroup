<?php

namespace App\Http\Controllers\Nusantara\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Models\Front\CompanyVisiMisiModel as CompanyVisiMisiService;
use Response;

class CompanyVisiMisiController extends FrontController
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

        $blade = self::URL_BLADE_FRONT_SITE.'.visi-misi';

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


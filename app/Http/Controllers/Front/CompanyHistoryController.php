<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Front\CompanyHistoryModel as CompanyHistoryService;
use Response;

class CompanyHistoryController extends Controller
{
    protected $companyHistory;

    public function __construct(CompanyHistoryService $companyHistory)
    {
        $this->companyHistory = $companyHistory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $blade = 'Front.Pages.company-history';

        if(view()->exists($blade))
        {
            return view($blade);
        }
    }

    public function getData(Request $request)
    {
        
        $history_page = $this->companyHistory::all();
        $response = [
            'history_page' => $history_page
        ];
        return response()->json($response);
    }
}


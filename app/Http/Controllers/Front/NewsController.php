<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Front\NewsModel as NewsModelsServices;
use Response;
use Storage;

class NewsController extends Controller
{
    protected $news;
    
    public function __construct(NewsModelsServices $news)
    {
        $this->news = $news;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $blade = 'Front.Pages.news';

        if(view()->exists($blade))
        {

            return view($blade);
        }
    }

    public function getData(Request $request)
    {
        $news = $this->news::all();
        $response = [
            'data' => $news
        ];
        return response()->json($response);
    }

}


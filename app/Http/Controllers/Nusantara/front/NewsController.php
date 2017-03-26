<?php

namespace App\Http\Controllers\Nusantara\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Models\Front\NewsModel as NewsModelsServices;
use Response;
use Storage;

class NewsController extends FrontController
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
        $blade = self::URL_BLADE_FRONT_SITE.'.news';

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


<?php

namespace App\Http\Controllers\Nusantara\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Models\Front\ContactUsModel as ContactUsModel;
use App\Models\Front\MessageContactUsModel as MessageContactUsService;
use Validator;
use ValidatesRequests;
use Response;
use Illuminate\Support\Facades\Input;

class ContactUsController extends FrontController
{
    protected $contactUs;
    protected $message;

    public function __construct(ContactUsModel $contactUs, MessageContactUsService $message)
    {
        $this->contactUs = $contactUs;
        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $blade = self::URL_BLADE_FRONT_SITE.'.contact-us';

        if(view()->exists($blade))
        {
            return view($blade);
        }
    }

    public function getData(Request $request)
    {
        
        $pageContactUs = $this->contactUs::all();
        $response = [
            'data' => $pageContactUs
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStoreContactUs($request));

        if ($validator->fails()) 
        {
            return response()->json([
                 'success' => false,
                 'errors' => $validator->errors()->toArray()
             ]);
        }
        else
        {
            
            $create = $this->message::create($request->all());
            return response()->json($create);
        }

    }

    /**
     * Validation Store Landing Offers
     * @return array
     */

    private function validationStoreContactUs($request = array())
    {
        $rules = [
            'firstname'        => 'required',
            'lastname'         => 'required',
            'email'            => 'required | email',
            'subject'          => 'required',
            'message'          => 'required'

        ];

        return $rules;
    }
}


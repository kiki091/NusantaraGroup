<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Front\SubscribeModel as SubscribeService;
use Validator;
use ValidatesRequests;
use Response;
use Illuminate\Support\Facades\Input;

class SubscribeMailController extends Controller
{
    protected $subscribeMail;

    public function __construct(SubscribeService $subscribeMail)
    {
        $this->subscribeMail = $subscribeMail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStoreSubscribe($request));

        if ($validator->fails()) 
        {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray()
             ]);
        }
        else
        {
            
            $create = $this->subscribeMail::create($request->all());
            return response()->json($create);
        }

    }

    /**
     * Validation Store Landing Offers
     * @return array
     */

    private function validationStoreSubscribe($request = array())
    {
        $rules = [
            'email'            => 'required | email',

        ];

        return $rules;
    }
}


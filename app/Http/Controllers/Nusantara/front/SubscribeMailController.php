<?php

namespace App\Http\Controllers\Nusantara\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Front\Subscribe as SubscribeServices;

use Validator;
use ValidatesRequests;

class SubscribeMailController extends FrontController
{
    protected $subscribe;
    protected $response;

    public function __construct(SubscribeServices $subscribe, ResponseService $response)
    {
        $this->subscribe = $subscribe;
        $this->response = $response;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStoreSubscribe($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->subscribe->store($request->except(['_token']));
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


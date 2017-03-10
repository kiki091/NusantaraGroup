<?php

namespace App\Http\Controllers\Nusantara\cms;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Bridge\Auth\User as UserServices;

use Auth;
use Session;
use Validator;

class DashboardController extends CmsController
{
	protected $user;

	public function __construct(UserServices $user)
    {
        $this->user = $user;
    }

	/**
     * Index Of Dashboard
     * @return string
     */
    public function index(Request $request)
    {
    	if (Auth::check() == null) {
           return redirect()->route('login');
        }
        
    	$data['user'] = $this->getUserData();
    	$data['location'] = $this->getUserLocation();
    	$data['page_title'] = 'Dashboard';
    	
        $blade = self::URL_BLADE_CMS.'.dashboard';

        if(view()->exists($blade)) 
        {
            return view($blade, $data);
        }
        return abort(404);
    }
}
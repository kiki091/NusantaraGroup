<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Auth\User as UserServices;

use Auth;
use Session;
use Validator;

class DashboardController extends Controller
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

    	$data['user'] = $this->user->setAuthSession();
    	
        $blade = 'Cms.pages.dashboard';

        if(view()->exists($blade)) 
        {
            return view($blade, $data);
        }
        return abort(404);
    }
}
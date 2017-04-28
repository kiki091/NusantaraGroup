<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use App\Services\Bridge\Auth\User as UserServices;

use URL;
use JavaScript;
use Auth;
use Session;

class CmsController extends Controller
{
	protected $user;

    const URL_BLADE_CMS = 'nusantara.cms.pages'; 

	public function __construct(UserServices $user)
    {
        $this->user = $user;
        $this->setJavascriptVariable();

        if (Auth::check() == null) {
           return redirect()->route('login');
        }
    }

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        JavaScript::put([
            'href_url' => URL::current(),
            'token' => csrf_token(),
            'app_domain' => env('DOMAIN_PREFIX') . env('APP_DOMAIN'),
        ]);
    }

    public function getUserData()
    {
    	$data['user'] = $this->user->setAuthSession();

    	foreach ($data as $value) {
    		$value;
    	}
    	return $value;
    }

    public function getUserLocation()
    {
    	$data['user_location'] = $this->user->setAuthSession();

    	foreach ($data['user_location'] as $value) {
    		$value;
    	}
    	return $value;
    }

    public function getLocationId()
    {
        $location = $this->getUserLocation();
        $property_location_id = $location['property_id'];
        return $property_location_id;
    }
}
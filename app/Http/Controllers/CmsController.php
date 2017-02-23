<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Auth\User as UserServices;

use Auth;
use Session;

class CmsController extends Controller
{
	protected $user;

	public function __construct(UserServices $user)
    {
        $this->user = $user;
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
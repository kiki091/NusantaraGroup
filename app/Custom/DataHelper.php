<?php
namespace App\Custom;

use App\Model\PropertyLocation;
use Session;
/**
 * TESTIMONIAL
 */
class DataHelper {

	/**
     * Get User Info
     */
    public function userInfo()
    {
        return Session::get('user_info');
    }

    /**
     * Get User Id
     */
    public function userId()
    {
        $userInfo = $this->userInfo();

        if (isset($userInfo['user_id'])) {
            return $userInfo['user_id'];
        }

        return false;
    }

    /**
     * Get User Location
     * @return bool
     */
    public function userLocation()
    {
        $userInfo = $this->userInfo();

        if (isset($userInfo['location'])) {
            return $userInfo['location'];
        }

        return false;
    }

    /**
     * Get User Email
     */
    public function userEmail()
    {
        $userInfo = $this->userInfo();

        if (isset($userInfo['email'])) {
            return $userInfo['email'];
        }

        return false;
    }
	
	/**
     * Get User System
     * @return bool
     */
    public function userSystem()
    {
        $userInfo = $this->userInfo();

        if (isset($userInfo['system'])) {
            return $userInfo['system'];
        }

        return false;
    }
}
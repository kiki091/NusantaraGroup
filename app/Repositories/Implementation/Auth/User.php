<?php

namespace App\Repositories\Implementation\Auth;

use App\Repositories\Contracts\Auth\User as UserInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Auth\User as UserModel;
use App\Custom\Facades\DataHelper;
use App\Services\Transformation\Auth\User as UserTransformation;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class User extends BaseImplementation implements UserInterface
{

    protected $user;
    protected $userTransformation;

    function __construct(UserModel $user, UserTransformation $userTransformation)
    {

        $this->user = $user;
        $this->userTransformation = $userTransformation;
    }

	/**
     * Set Ayana Auth Session
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function setAuthSession($params)
    {

        $userInfo = Auth::user();

        if (empty($userInfo)) {
           return false;
        }

        $userId = !empty($userInfo) && isset($userInfo['id']) ?  $userInfo['id'] : '';

        $params = [
            'id' => $userId,
            'is_active' => true,
        ];
        $userData = $this->user($params, 'asc', 'array', true);

        if(empty($userData))
            return false;

        $data = $this->userTransformation->getAuthSessionTransform($userData);

        Session::forget('user_info');
        Session::put('user_info', $data);

        return $data;
    }

    /**
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function user($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $user = $this->user
            ->with('location');

        if(isset($params['id'])) {
            $user->userId($params['id']);
        }

        if(isset($params['is_active'])) {
            $user->isActive($params['is_active']);
        }

        if(!$user->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $user->get()->toArray();
                } else {
                    return $user->first()->toArray();
                }
                break;
        }
    }

    /**
     * Change Password
     * @param $data
     */
    public function changePassword($data)
    {
    	
    }
}
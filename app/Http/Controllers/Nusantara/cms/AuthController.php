<?php

namespace App\Http\Controllers\Nusantara\cms;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CmsController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\Bridge\Auth\User as UserServices;
use Session;
use Auth;
use Validator;
use ValidatesRequests;
use Response;

class AuthController extends CmsController
{
	use AuthenticatesUsers, ThrottlesLogins;

    protected $validationMessage = '';
    protected $validationChangePasswordForm = '';
    protected $user;

    public function __construct(UserServices $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        if (Auth::check()) {
           return redirect()->route('CmsDashboard');
        }

        $data = array();

        $blade = self::URL_BLADE_CMS.'.login';

        if(view()->exists($blade)) {

            return view($blade, $data);

        }
        return abort(404);
    }

    public function authenticate(Request $request)
    {
    	if (!$this->validationAuth($request->input())) {
            return redirect(route('login'))->withInput($request->only($this->username(), 'remember'))->withErrors($this->validationMessage);
        }

        $credentials = $request->only($this->username(), 'password');
        $credentials['is_active'] = true;

        //TODO: Check Throttles
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {

            return $this->sendLockoutResponse($request);
        }


        if (Auth::attempt($credentials)) {
            //TODO: set session first

            if ($this->user->setAuthSession()) {
                //TODO : redirect to dashboard
               return redirect()->route('CmsDashboard');
            }
        }

        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }


        return redirect(route('login'))
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => $this->getFailedLoginMessage(),
            ]);

    }

    /*
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }
    */

    /**
     * Get the failed login message.
     *
     * @return string
     */
    /*protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }*/


    /**
     * Manage redirect after login
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function manageRedirectAfterLogin()
    {
        $userInfo = DataHelper::userInfo();

        if (isset($userInfo['location']) && !empty($userInfo['location'])) {
            foreach ($userInfo['location'] as $key => $value) {
            	
                return redirect()->route('CmsDashboard'.$value['property_location_slug']);
            }
        }

        return redirect(route('login'));
    }

    
    /**
     * Logout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect(route('login'));
    }

    /**
     * Validation for authenticate
     * @param $credentials
     * @return bool
     */
    private function validationAuth($credentials)
    {
        $validator = Validator::make($credentials, $this->getValidationRules());

        if ($validator->fails()) {
            $this->validationMessage = $validator->messages();
            return false;
        }
        return true;
    }

    /**
     * Validation Rules
     * @return array
     */
    private function getValidationRules()
    {
        return $rules = array(
            'email'            => 'required|email',
            'password'         => 'required',
        );
    }

}
<?php

namespace App\Http\Controllers\Nusantara\cms\pages\promotion;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\Promotion as PromotionServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class PromotionController extends CmsController
{
	protected $user;
	protected $response;
	protected $promotion;
    protected $validationMessage = '';


	public function __construct(PromotionServices $promotion, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->promotion = $promotion;
    }

    /**
     * Index Data Static Page
     */

    public function index(Request $request)
    {
    	if (Auth::check() == null) {
           return redirect()->route('login');
        }
        
    	$data['page_title'] = 'Promotions';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = self::URL_BLADE_CMS.'.promotion.promotion';

        if(view()->exists($blade)) 
        {
            return view($blade, $data);
        }
        return abort(404);
    }

    /**
     * Get Data Promotion
     */

    public function getData(Request $request)
    {
        $location = $this->getUserLocation('id');
        $property_location_id = $location['property_id'];

    	$data['promotion'] = $this->promotion->getData();

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Check is edit mode or no
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }

}
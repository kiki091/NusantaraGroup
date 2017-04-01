<?php

namespace App\Http\Controllers\Nusantara\cms\pages;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\Promotion as PromotionServices;
use App\Services\Bridge\Cms\MainBanner as MainBannerServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class PromotionController extends CmsController
{
	protected $user;
	protected $response;
	protected $promotion;
    protected $mainBanner;
    protected $validationMessage = '';

    const MAIN_BANNER_KEY  = 'banner::promotion';

	public function __construct(PromotionServices $promotion, MainBannerServices $mainBanner, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->promotion = $promotion;
        $this->mainBanner = $mainBanner;
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
     * Get Data Static Page
     */
    public function getData(Request $request)
    {
        $location = $this->getUserLocation('id');
        $property_location_id = $location['property_id'];

    	$data['promotion'] = $this->promotion->getData();
        $data['category_promotion'] = $this->promotion->getCategoryPromotion();
        $data['banner'] = $this->mainBanner->getData($property_location_id, self::MAIN_BANNER_KEY);

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

}
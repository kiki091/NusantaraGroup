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
     * Get Data Promotion
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

    /**
     * Store Banner Promotion
     */

    public function storeBanner(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStoreBanner($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->mainBanner->store($request->except(['_token', 'image_url']), $this->getLocationId(), self::MAIN_BANNER_KEY);
        }
    }

    /**
     * Store Categori Promotion
     */

    public function storeCategori(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStoreCategori($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->promotion->storeCategori($request->except(['_token', 'thumbnail_category_url']));
        }
    }

    /**
     * Edit Banner Promotion
     */
    public function editBanner(Request $request)
    {
        return $this->mainBanner->edit($request->except(['_token']));
    }

    /**
     * Change status banner Promotion
     * @param Request $request
     * @return mixed
     */
    public function changeStatusBanner(Request $request)
    {
        return $this->mainBanner->changeStatus($request->except(['_token']));
        
    }

    /**
     * Ordering banner Promotion
     * @param Request $request
     * @return mixed
     */

    public function orderBanner(Request $request)
    {
        return $this->mainBanner->order($request->input('list_order'));
    }

    /**
     * Delete Data banner Promotion
     * @param Request $request
     * @return mixed
     */
    public function deleteBanner(Request $request)
    {
        return $this->mainBanner->delete($request->except(['_token']));
        
    }

    /**
     * Validation Store Banner Promotion
     * @return array
     */
    private function validationStoreBanner($request = array())
    {
        $rules = [
            'title'               => 'required',
            'images'              => 'required|dimensions:width='.MAIN_BANNER_WIDTH.',height='.MAIN_BANNER_HEIGHT.'|max:'. MAIN_BANNER_SIZE .'|mimes:jpg,jpeg',
            
        ];

        if ($this->isEditMode($request->input()))
        {
            if (is_null($request->file('images'))) {
                unset($rules['images']);
            }
        }

        return $rules;
    }

    /**
     * Validation Store Categori Promotion
     * @return array
     */
    private function validationStoreCategori($request = array())
    {
        $rules = [
            'category_name'         => 'required',
            'category_slug'         => 'required',
            'thumbnail_category'    => 'required|dimensions:width='.PROMOTION_CATEGORI_WIDTH.',height='.PROMOTION_CATEGORI_HEIGHT.'|max:'. PROMOTION_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'introduction'          => 'required',
            'meta_title'            => 'required',
            'meta_keyword'          => 'required',
            'meta_description'      => 'required',
            
        ];

        if ($this->isEditMode($request->input()))
        {
            if (is_null($request->file('thumbnail_category'))) {
                unset($rules['thumbnail_category']);
            }
        }

        return $rules;
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
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

class PromotionCategoriController extends CmsController
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

        $blade = self::URL_BLADE_CMS.'.promotion.categori';

        if(view()->exists($blade)) 
        {
            return view($blade, $data);
        }
        return abort(404);
    }

    /**
     * Get Data Categori Promotion
     */

    public function getData(Request $request)
    {
        $location = $this->getUserLocation('id');
        $property_location_id = $location['property_id'];
        $data['category_promotion'] = $this->promotion->getCategoryPromotion();

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
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
     * Edit Categori Promotion
     */
    public function editCategori(Request $request)
    {
        return $this->promotion->editCategori($request->except(['_token']));
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
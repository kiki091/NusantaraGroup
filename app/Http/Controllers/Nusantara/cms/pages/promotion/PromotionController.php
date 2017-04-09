<?php

namespace App\Http\Controllers\Nusantara\cms\pages\promotion;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\Promotion as PromotionServices;
use App\Services\Bridge\Cms\PromotionCategory as PromotionCategoryServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class PromotionController extends CmsController
{
	protected $user;
	protected $response;
	protected $promotion;
    protected $promotionCategory;
    protected $validationMessage = '';


	public function __construct(PromotionCategoryServices $promotionCategory, PromotionServices $promotion, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->promotion = $promotion;
        $this->promotionCategory = $promotionCategory;
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
        $data['category_promotion'] = $this->promotionCategory->getCategoryPromotion();

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Promotion
     */

    public function store(Request $request)
    {
        /*$validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->promotion->storePromotion($request->except(['_token', 'thumbnail_url']));
        }*/

        return $this->promotion->storePromotion($request->except(['_token', 'thumbnail_url']));
    }

    /**
     * Edit Promotion
     * @param $request
     */

    public function edit(Request $request)
    {
        return $this->promotion->edit($request->except(['_token']));
    }

    /**
     * Validation Store Promotion
     * @return array
     */


    private function validationStore($request = array())
    {
        $rules = [

            'promotion_category_id'     => 'required',
            'title'                     => 'required',
            'slug'                      => 'required',
            'thumbnail'                 => 'required|dimensions:width='.PROMOTION_THUMBNAIL_WIDTH.',height='.PROMOTION_THUMBNAIL_HEIGHT.'|max:'. PROMOTION_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'equipment_interior'        => 'required',
            'equipment_exterior'        => 'required',
            'information'               => 'required',
            'filename'                  => 'required|dimensions:width='.PROMOTION_GALLERY_WIDTH.',height='.PROMOTION_GALLERY_HEIGHT.'|max:'. PROMOTION_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'banner_image'              => 'required|dimensions:width='.PROMOTION_BANNER_IMAGES_WIDTH.',height='.PROMOTION_BANNER_IMAGES_HEIGHT.'|max:'. PROMOTION_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'interior_image'            => 'required|dimensions:width='.PROMOTION_IMAGES_WIDTH.',height='.PROMOTION_IMAGES_HEIGHT.'|max:'. PROMOTION_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'exterior_image'            => 'required|dimensions:width='.PROMOTION_IMAGES_WIDTH.',height='.PROMOTION_IMAGES_HEIGHT.'|max:'. PROMOTION_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'safety_image'              => 'required|dimensions:width='.PROMOTION_IMAGES_WIDTH.',height='.PROMOTION_IMAGES_HEIGHT.'|max:'. PROMOTION_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'accesories_image'          => 'required|dimensions:width='.PROMOTION_IMAGES_WIDTH.',height='.PROMOTION_IMAGES_HEIGHT.'|max:'. PROMOTION_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'introduction'              => 'required',
            'side_description'          => 'required',
            'description'               => 'required',
            'interior_description'      => 'required',
            'exterior_description'      => 'required',
            'safety_description'        => 'required',
            'accesories_description'    => 'required',
            'meta_title'                => 'required',
            'meta_keyword'              => 'required',
            'meta_description'          => 'required',
        ];

        if ($this->isEditMode($request->input()))
        {
            if (is_null($request->file('thumbnail'))) {
                unset($rules['thumbnail']);
            }

            if (is_null($request->file('filename'))) {
                unset($rules['filename']);
            }

            if (is_null($request->file('banner_image'))) {
                unset($rules['banner_image']);
            }

            if (is_null($request->file('interior_image'))) {
                unset($rules['interior_image']);
            }

            if (is_null($request->file('exterior_image'))) {
                unset($rules['exterior_image']);
            }

            if (is_null($request->file('safety_image'))) {
                unset($rules['safety_image']);
            }

            if (is_null($request->file('accesories_image'))) {
                unset($rules['accesories_image']);
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
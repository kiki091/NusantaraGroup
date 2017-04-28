<?php

namespace App\Http\Controllers\Nusantara\cms\pages\carier;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\MainBanner as MainBannerServices;
use App\Services\Bridge\Cms\Carier as CarierServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class CarierController extends CmsController
{
	protected $user;
	protected $response;
	protected $carier;
    protected $mainBanner;
    protected $validationMessage = '';

    const MAIN_BANNER_KEY  = 'banner::carier';

	public function __construct(CarierServices $carier, MainBannerServices $mainBanner, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->mainBanner = $mainBanner;
        $this->carier = $carier;
    }

    /**
     * Index Data Carier Categori
     */

    public function index(Request $request)
    {
    	$data['page_title'] = 'Carier Categori';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = self::URL_BLADE_CMS.'.carier.main';

        if(view()->exists($blade)) 
        {
            return view($blade, $data);
        }
        return abort(404);
    }

    /**
     * Get Data Carier Pages
     */

    public function getData(Request $request)
    {
    	$location = $this->getUserLocation('id');
        $property_location_id = $location['property_id'];

    	$data['carier_categori'] = $this->carier->getData($property_location_id);
        $data['banner'] = $this->mainBanner->getData($property_location_id, self::MAIN_BANNER_KEY);

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data Banner Carier
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
     * Store Data Carier Detail
     */

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->carier->store($request->except(['_token', 'thumbnail_url']), $this->getLocationId());
        }

    }

    /**
     * Edit Banner Carier
     */
    public function editBanner(Request $request)
    {
        return $this->mainBanner->edit($request->except(['_token']));
    }

    /**
     * Edit  Carier
     */
    public function edit(Request $request)
    {
        return $this->carier->edit($request->except(['_token']));
    }

	/**
     * Change status banner Carier
     * @param Request $request
     * @return mixed
     */
    public function changeStatusBanner(Request $request)
    {
        return $this->mainBanner->changeStatus($request->except(['_token']));
        
    }

    /**
     * Change status  Carier
     * @param Request $request
     * @return mixed
     */
    public function changeStatus(Request $request)
    {
        return $this->carier->changeStatus($request->except(['_token']));
        
    }

    /**
     * Ordering banner Carier
     * @param Request $request
     * @return mixed
     */

    public function orderBanner(Request $request)
    {
        return $this->mainBanner->order($request->input('list_order'));
    }

    /**
     * Ordering  Carier
     * @param Request $request
     * @return mixed
     */

    public function order(Request $request)
    {
        return $this->carier->order($request->input('list_order'));
    }

    /**
     * Delete Data
     * @param Request $request
     * @return mixed
     */
    public function deleteBanner(Request $request)
    {
        return $this->mainBanner->delete($request->except(['_token']));
        
    }

    /**
     * Delete Data
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        return $this->carier->delete($request->except(['_token']));
        
    }

    /**
     * Validation Store Banner Carier
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
     * Validation Store Carier
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [
            'category_name'           => 'required',
            'thumbnail'               => 'required|dimensions:width='.MAIN_BANNER_WIDTH.',height='.MAIN_BANNER_HEIGHT.'|max:'. MAIN_BANNER_SIZE .'|mimes:jpg,jpeg',
            
        ];

        if ($this->isEditMode($request->input()))
        {
            if (is_null($request->file('thumbnail'))) {
                unset($rules['thumbnail']);
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
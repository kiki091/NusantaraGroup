<?php

namespace App\Http\Controllers\Cms\pages;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\MainBanner as MainBannerServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class MainBannerController extends CmsController
{
	protected $user;
	protected $response;
	protected $mainBanner;
    protected $validationMessage = '';

    const MAIN_BANNER_KEY  = 'banner::landing';

	public function __construct(MainBannerServices $mainBanner, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
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
        
    	$data['page_title'] = 'Main Banner';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = 'Cms.pages.main-banner.main-banner';

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

    	$data['banner'] = $this->mainBanner->getData($property_location_id, self::MAIN_BANNER_KEY);

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data Static Page
     */

    public function store(Request $request)
    {

    	/*$validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->mainBanner->store($request->except(['_token'], self::MAIN_BANNER_KEY  ));
        }*/

        return $this->mainBanner->store($request->except(['_token']), $this->getLocationId(), self::MAIN_BANNER_KEY);
    }

    /**
     * Edit 
     */
    public function edit(Request $request)
    {
        return $this->mainBanner->edit($request->except(['_token']));
    }

    /**
     * Change status
     * @param Request $request
     * @return mixed
     */
    public function changeStatus(Request $request)
    {
        return $this->mainBanner->changeStatus($request->except(['_token']));
        
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
    	$rules = [
    		'title'               => 'required',
    		'images'   		      => 'required|dimensions:width='.MAIN_BANNER_WIDTH.',height='.MAIN_BANNER_HEIGHT.'|max:'. MAIN_BANNER_SIZE .'|mimes:jpg,jpeg',
            
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
     * Check is edit mode or no
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }

}
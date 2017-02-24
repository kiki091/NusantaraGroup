<?php

namespace App\Http\Controllers\Cms\pages;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\StaticPage as StaticPageServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class StaticPageController extends CmsController
{
	protected $user;
	protected $response;
	protected $staticPage;
    protected $validationMessage = '';

	public function __construct(StaticPageServices $staticPage, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->staticPage = $staticPage;
    }

    /**
     * Index Data Static Page
     */

    public function index(Request $request)
    {
    	if (Auth::check() == null) {
           return redirect()->route('login');
        }
        
    	$data['page_title'] = 'Static Page';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = 'Cms.pages.static-page.static-page';

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
        $location = $this->getUserLocation();
        $property_location_id = $location['property_id'];

    	$data['static_page'] = $this->staticPage->getData($property_location_id);

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data Static Page
     */

    public function store(Request $request)
    {

    	$validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->staticPage->store($request->except(['_token', 'logo_url', 'favicon_url', 'og_url']));
        }
    }

    /**
     * Edit 
     */
    public function edit(Request $request)
    {
        return $this->staticPage->edit($request->except(['_token']));
    }

    /**
     * Change status
     * @param Request $request
     * @return mixed
     */
    public function changeStatus(Request $request)
    {
        return $this->staticPage->changeStatus($request->except(['_token']));
        
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
    	$rules = [
            'id'                    => 'required',
    		'site_title'            => 'required',
    		'logo_images'   		=> 'required|dimensions:width='.LOGO_WIDTH.',height='.LOGO_HEIGHT.'|max:'. MAX_IMAGE_SIZE .'|mimes:png',
            'favicon_images'        => 'required|dimensions:width='.FAVICON_WIDTH.',height='.FAVICON_HEIGHT.'|max:'. FAVICON_SIZE .'|mimes:png,ico',
            'og_images'             => 'required|dimensions:width='.OG_IMAGE_WIDTH.',height='.OG_IMAGE_HEIGHT.'|max:'. OG_IMAGE_SIZE .'|mimes:png,jpeg,jpg',
            'site_name'             => 'required',
            'og_title'              => 'required',
            'og_description'        => 'required',
            'box_wrapper_left'      => 'required',
            'box_wrapper_center'    => 'required',
            'box_wrapper_right'     => 'required',
            'meta_title'            => 'required',
            'meta_keyword'          => 'required',
            'meta_description'      => 'required',
    	];

        if ($this->isEditMode($request->input()))
        {
            if (is_null($request->file('logo_images'))) {
                unset($rules['logo_images']);
            }

            if (is_null($request->file('favicon_images'))) {
                unset($rules['favicon_images']);
            }

            if (is_null($request->file('og_images'))) {
                unset($rules['og_images']);
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
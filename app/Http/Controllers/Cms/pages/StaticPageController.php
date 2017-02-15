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
    	$data['static_page'] = $this->staticPage->getData();

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
            return $this->staticPage->store($request->except(['_token']));
        }
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStoreDiningVenue($request = array())
    {
    	$rules = [
    		'site_title'            => 'required',
    		'logo_images'   		=> 'required|dimensions:width='.LOGO_WIDTH.',height='.LOGO_HEIGHT.'|max:'. MAX_IMAGE_SIZE .'|mimes:png',
    	];	
    }
}
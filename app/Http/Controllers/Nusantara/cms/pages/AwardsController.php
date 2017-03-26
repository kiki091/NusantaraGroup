<?php

namespace App\Http\Controllers\Nusantara\cms\pages;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\Awards as AwardsServices;
use App\Services\Bridge\Cms\MainBanner as MainBannerServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class AwardsController extends CmsController
{
	protected $user;
	protected $response;
	protected $awards;
    protected $mainBanner;
    protected $validationMessage = '';

    const MAIN_BANNER_KEY  = 'banner::awards';

	public function __construct(AwardsServices $awards, MainBannerServices $mainBanner, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->awards = $awards;
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
        
    	$data['page_title'] = 'Awards';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = self::URL_BLADE_CMS.'.awards.awards';

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

    	$data['awards'] = $this->awards->getData($property_location_id);
        $data['banner'] = $this->mainBanner->getData($property_location_id, self::MAIN_BANNER_KEY);

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data Awards
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

        return $this->awards->store($request->except(['_token']), $this->getLocationId());
    }

    /**
     * Store Data Banner Awards
     */

    public function storeBanner(Request $request)
    {

        /*$validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->mainBanner->store($request->except(['_token'], self::MAIN_BANNER_KEY  ));
        }*/

        return $this->mainBanner->store($request->except(['_token', 'image_url']), $this->getLocationId(), self::MAIN_BANNER_KEY);
    }

    /**
     * Edit 
     */
    public function edit(Request $request)
    {
        return $this->awards->edit($request->except(['_token']));
    }

    /**
     * Edit Banner Awards
     */
    public function editBanner(Request $request)
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
        return $this->awards->changeStatus($request->except(['_token']));
        
    }

    /**
     * Change status banner Awards
     * @param Request $request
     * @return mixed
     */
    public function changeStatusBanner(Request $request)
    {
        return $this->mainBanner->changeStatus($request->except(['_token']));
        
    }

    /**
     * Ordering 
     * @param Request $request
     * @return mixed
     */

    public function order(Request $request)
    {
        return $this->awards->order($request->input('list_order'));
    }

    /**
     * Ordering banner Awards
     * @param Request $request
     * @return mixed
     */

    public function orderBanner(Request $request)
    {
        // return $this->mainBanner->order($request->input('list_order'));
    }

    /**
     * Delete Data
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        return $this->awards->delete($request->except(['_token']));
        
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
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
    	$rules = [

    		'office_name'           => 'required',
    		'thumbnail'   		    => 'required|dimensions:width='.AWARDS_THUMBNAIL_WIDTH.',height='.AWARDS_THUMBNAIL_HEIGHT.'|max:'. AWARDS_THUMBNAIL_SIZE .'|mimes:jpg,jpeg',
            'images'                => 'required|dimensions:width='.AWARDS_IMAGES_WIDTH.',height='.AWARDS_IMAGES_HEIGHT.'|max:'. AWARDS_THUMBNAIL_SIZE .'|mimes:jpg,jpeg',
            'description'           => 'required',
            'meta_title'            => 'required',
            'meta_keyword'          => 'required',
            'meta_description'      => 'required',
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
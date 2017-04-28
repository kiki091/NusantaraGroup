<?php

namespace App\Http\Controllers\Nusantara\cms\pages\event;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\EventCategory as EventCategoryServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class EventCategoriController extends CmsController
{

	protected $user;
	protected $response;
	protected $eventCategory;
    protected $validationMessage = '';

    public function __construct(EventCategoryServices $eventCategory, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->eventCategory = $eventCategory;
    }

    /**
     * Index Data Static Page
     */

    public function index(Request $request)
    {
    	if (Auth::check() == null) {
           return redirect()->route('login');
        }
        
    	$data['page_title'] = 'Event & Services';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = self::URL_BLADE_CMS.'.event.categori';

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

        $data['event_category'] = $this->eventCategory->getData($property_location_id);

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data
     * @param $request
     * @return array
     */

    public function store(Request $request)
    {
        /*$validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            
            return $this->eventCategory->store($request->except(['_token']), $this->getLocationId());
        }*/

        return $this->eventCategory->store($request->except(['_token']), $this->getLocationId());
    }

    /**
     * Edit 
     */
    public function edit(Request $request)
    {
        return $this->eventCategory->edit($request->except(['_token']));
    }

    /**
     * Change status
     * @param Request $request
     * @return mixed
     */
    public function changeStatus(Request $request)
    {
        return $this->eventCategory->changeStatus($request->except(['_token']));
        
    }

    /**
     * Ordering 
     * @param Request $request
     * @return mixed
     */

    public function order(Request $request)
    {
        return $this->eventCategory->order($request->input('list_order'));
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [

            'name'           => 'required',
            'thumbnail'      => 'required|dimensions:width='.AWARDS_THUMBNAIL_WIDTH.',height='.AWARDS_THUMBNAIL_HEIGHT.'|max:'. AWARDS_THUMBNAIL_SIZE .'|mimes:jpg,jpeg',
            'slug'           => 'required',
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
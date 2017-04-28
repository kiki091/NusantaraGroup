<?php

namespace App\Http\Controllers\Nusantara\cms\pages;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\MainBanner as MainBannerServices;
use App\Services\Bridge\Cms\BranchOffice as BranchOfficeServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class BranchOfficeController extends CmsController
{
	protected $user;
	protected $response;
    protected $mainBanner;
	protected $branchOffice;
    protected $validationMessage = '';

	public function __construct(BranchOfficeServices $branchOffice, MainBannerServices $mainBanner, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->mainBanner = $mainBanner;
        $this->branchOffice = $branchOffice;
    }

    /**
     * Index Data Static Page
     */

    public function index(Request $request)
    {
    	if (Auth::check() == null) {
           return redirect()->route('login');
        }
        
    	$data['page_title'] = 'Branch Office';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = self::URL_BLADE_CMS.'.branch-office.branch-office';

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

    	$data['branch_office'] = $this->branchOffice->getData($property_location_id);

    	return $this->response->setResponse(trans('message.success_get_data'), true, $data);
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
            return $this->branchOffice->store($request->except(['_token']), $this->getLocationId());
        }

    }

    /**
     * Edit 
     */
    public function edit(Request $request)
    {
        return $this->branchOffice->edit($request->except(['_token']));
    }

    /**
     * Edit Image Slider
     */

    public function editImageSlider(Request $request)
    {
        
        $validator = Validator::make($request->all(), $this->validateEditImageSlider($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->branchOffice->editImageSlider($request->except(['_token']));
        }
        
    }


    /**
     * Change status
     * @param Request $request
     * @return mixed
     */
    public function changeStatus(Request $request)
    {
        return $this->branchOffice->changeStatus($request->except(['_token']));
        
    }

    /**
     * Ordering 
     * @param Request $request
     * @return mixed
     */

    public function order(Request $request)
    {
        return $this->branchOffice->order($request->input('list_order'));
    }

    /**
     * Delete Data
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        return $this->branchOffice->delete($request->except(['_token']));
        
    }

    /**
     * Delete Image Slider
     * @param Request $request
     * @return mixed
     */
    public function deleteImageSlider(Request $request)
    {
        return $this->branchOffice->deleteImageSlider($request->except(['_token']));
        
    }

    /**
     * Delete Office
     * @param Request $request
     * @return mixed
     */
    public function deleteOfficeDetail(Request $request)
    {
        return $this->branchOffice->deleteOfficeDetail($request->except(['_token']));
        
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
    	$rules = [
    		'title'                             => 'required',
            'slug'                              => 'required',
            'side_description'                  => 'required',
            'description'                       => 'required',
            'thumbnail'                         => 'required|dimensions:width='.BRANCH_OFFICE_THUMBNAIL_WIDTH.',height='.BRANCH_OFFICE_THUMBNAIL_HEIGHT.'|max:'. BRANCH_OFFICE_THUMBNAIL_SIZE .'|mimes:jpg,jpeg',
            'address'                           => 'required',
            'office_name'                       => 'required',
            'meta_title'                        => 'required',
            'meta_keyword'                      => 'required',
            'meta_description'                  => 'required',
            'branch_office.title_description'   => 'required',
            'branch_office.address'             => 'required',
            'branch_office.latitude'            => 'required',
            'branch_office.longitude'           => 'required',
    		'images.*'   		                => 'required|dimensions:width='.BRANCH_OFFICE_IMAGES_WIDTH.',height='.BRANCH_OFFICE_IMAGES_HEIGHT.'|max:'. BRANCH_OFFICE_THUMBNAIL_SIZE .'|mimes:jpg,jpeg',
            
    	];

        if ($this->isEditMode($request->input()))
        {
            if (is_null($request->file('thumbnail'))) {
                unset($rules['thumbnail']);
            }

            if (is_null($request->file('title_description.address'))) {
                unset($rules['branch_office.title_description']);
            }
            
            if (is_null($request->file('branch_office.address'))) {
                unset($rules['branch_office.address']);
            }

            if (is_null($request->file('branch_office.latitude'))) {
                unset($rules['branch_office.latitude']);
            }

            if (is_null($request->file('branch_office.longitude'))) {
                unset($rules['branch_office.longitude']);
            }
        }

        return $rules;
    }

    private function validateEditImageSlider($request = array())
    {
        $rules = [
            'images.*'                => 'required|dimensions:width='.BRANCH_OFFICE_IMAGES_WIDTH.',height='.BRANCH_OFFICE_IMAGES_HEIGHT.'|max:'. BRANCH_OFFICE_THUMBNAIL_SIZE .'|mimes:jpeg,jpg',
        ];

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
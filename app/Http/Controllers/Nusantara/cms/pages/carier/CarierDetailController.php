<?php

namespace App\Http\Controllers\Nusantara\cms\pages\carier;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\MainBanner as MainBannerServices;
use App\Services\Bridge\Cms\Carier as CarierServices;
use App\Services\Bridge\Cms\CarierDetail as CarierDetailServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class CarierDetailController extends CmsController
{
	protected $user;
	protected $response;
	protected $carier;
    protected $carierDetail;
    protected $mainBanner;
    protected $validationMessage = '';

    const MAIN_BANNER_KEY  = 'banner::carier';

	public function __construct(CarierServices $carier, CarierDetailServices $carierDetail, MainBannerServices $mainBanner, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->mainBanner = $mainBanner;
        $this->carier = $carier;
        $this->carierDetail = $carierDetail;
    }

    /**
     * Index Data Carier Categori
     */

    public function index(Request $request)
    {
    	$data['page_title'] = 'Carier Detail';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = self::URL_BLADE_CMS.'.carier.detail';

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
        $data['carier_detail'] = $this->carierDetail->getData($property_location_id);

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
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
            return $this->carierDetail->store($request->except(['_token', 'thumbnail_url']), $this->getLocationId());
        }
    }

    /**
     * Edit  Carier
     */
    public function edit(Request $request)
    {
        return $this->carierDetail->edit($request->except(['_token']));
    }

    /**
     * Change status  Carier
     * @param Request $request
     * @return mixed
     */
    public function changeStatus(Request $request)
    {
        return $this->carierDetail->changeStatus($request->except(['_token']));
        
    }

    /**
     * Ordering  Carier
     * @param Request $request
     * @return mixed
     */

    public function order(Request $request)
    {
        return $this->carierDetail->order($request->input('list_order'));
    }

    /**
     * Delete Data
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        return $this->carierDetail->delete($request->except(['_token']));
        
    }

    /**
     * Validation Store Carier Detail
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [
            'carier_category_id'      => 'required',
            'job_title'               => 'required',
            'slug'                    => 'required',
            'job_description'         => 'required',
            'meta_title'              => 'required',
            'meta_keyword'            => 'required',
            'meta_description'        => 'required',
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
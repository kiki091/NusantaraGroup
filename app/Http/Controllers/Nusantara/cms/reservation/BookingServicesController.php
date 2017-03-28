<?php

namespace App\Http\Controllers\Nusantara\cms\reservation;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\BookingServices as BookingServicesData;
use App\Services\Bridge\Cms\BranchOffice as BranchOfficeServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class BookingServicesController extends CmsController
{
	protected $user;
	protected $response;
	protected $bookingServices;
    protected $branchOffice;
    protected $validationMessage = '';

	public function __construct(BookingServicesData $bookingServices, BranchOfficeServices $branchOffice, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->bookingServices = $bookingServices;
    }

    /**
     * Index Data Static Page
     */

    public function index(Request $request)
    {
    	if (Auth::check() == null) {
           return redirect()->route('login');
        }
        
    	$data['page_title'] = 'Booking Services';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = self::URL_BLADE_CMS.'.booking-services.booking-services';

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

    	$data['booking_services'] = $this->bookingServices->getData($property_location_id);

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data
     */

    public function store(Request $request)
    {
        return $this->bookingServices->store($request->except(['_token']));
    }

    /**
     * Show Data
     */

    public function showData(Request $request)
    {
        //$data['office'] = $this->$branchOffice->getDataTranslation();

        return $this->bookingServices->showData($request->except(['_token']));
    }

    /**
     * Search Data
     */

    public function searchData(Request $request)
    {
        $param = $request->get('param');
        $type = $request->get('type');
        $data = $this->function->searchData(array('name'=>$param), $type);
        return $data;
    }

    
}
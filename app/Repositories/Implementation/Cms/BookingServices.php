<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\BookingServices as BookingServicesInterface;
use App\Models\BookingServices as BookingServicesModels;
use App\Repositories\Implementation\Cms\BranchOffice as BranchOfficeTransData;
use App\Services\Transformation\Cms\BookingServices as BookingServicesTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class BookingServices extends BaseImplementation implements BookingServicesInterface
{
	protected $message;
    protected $bookingServices;
    protected $branchOfficeTrans;
    protected $bookingServicesformation;

    function __construct(BookingServicesModels $bookingServices, BranchOfficeTransData $branchOfficeTrans, BookingServicesTransformation $bookingServicesformation)
    {
        $this->bookingServices = $bookingServices;
        $this->branchOfficeTrans = $branchOfficeTrans;
        $this->bookingServicesformation = $bookingServicesformation;
    }

    public function getData($params)
    {
        $data = [
        	"property_location_id" => $params,
            "status" => false
        ];

        $bookingServicesData = $this->bookingServices($data, 'asc', 'array', true);
        
        return $this->bookingServicesformation->getBookingServicesCmsTransform($bookingServicesData);
    }

    public function showData($params)
    {
        $data = [
            "id" => $params
        ];

        
        $bookingServicesData = $this->bookingServices($data, 'asc', 'array', true);
        $branchOfficeTransData = $this->branchOfficeTrans->getDataTranslation($bookingServicesData['branch_office_id']);
        
        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->bookingServicesformation->getDataBookingServicesCmsTransform($bookingServicesData,$branchOfficeTransData));
    }

    public function searchData($params)
    {
        $data = [
            "property_location_id" => $params,
            "status" => false
        ];

        $bookingServicesData = $this->bookingServices($data, 'asc', 'array', true);
        
        return $this->bookingServicesformation->getBookingServicesCmsTransform($bookingServicesData);
    }

    public function store($params)
    {
        
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function bookingServices($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $bookingServices = $this->bookingServices
        	->with('property_location')
        	->with('branch_office');

        if(isset($data['status'])) {
            $bookingServices->isStatus($data['status']);
        }

        if(isset($data['id'])) {
            $bookingServices->id($data['id']);
        }

        if(isset($data['property_location_id'])) {
            $bookingServices->propertyId($data['property_location_id']);
        }


        if(!$bookingServices->count())
            return array();


        if(isset($data['id'])) {
            return $bookingServices->first()->toArray();
        }

        return $bookingServices->get()->toArray();
    }
}
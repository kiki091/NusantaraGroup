<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Front\LandingPage as LandingPageServices;
use App\Services\Bridge\Front\BranchOffice as BranchOfficeServices;
use App\Services\Bridge\Front\PromotionContent as PromotionServices;
use App\Services\Bridge\Front\FooterContent as FooterContentServices;
use App\Services\Api\Response as ResponseService;
use Validator;
use ValidatesRequests;
use Log;

class PromotionController extends Controller{

    protected $landingPage;
    protected $promotion;
    protected $branchOffice;
    protected $footerContent;
    protected $response;
    protected $validationMessage = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(LandingPageServices $landingPage, PromotionServices $promotion, BranchOfficeServices $branchOffice, FooterContentServices $footerContent, ResponseService $response)
    {
        $this->landingPage = $landingPage;
        $this->promotion = $promotion;
        $this->branchOffice = $branchOffice;
        $this->footerContent = $footerContent;
        $this->response = $response;
    }

    /*
    * Promotion Car Function 
    */

    public function promotionCar(Request $request)
    {

    }

    /*
    * Promotion Detail Function
    */

    public function promotionCarDetail(Request $request)
    {
    	
    }

    /*
    * Booking Service Function
    */

    public function bookingServices(Request $request)
    {
        $data['landing_page'] = $this->landingPage->getlandingPage();
        $data['footer_content'] = $this->footerContent->getFooterContent();
        $data['seo'] = $this->landingPage->getlandingPageSeo();
    	$blade = 'Front.Pages.booking-services';
        
        if(view()->exists($blade))
        {
            return view($blade, $data);
        }
        return abort(404);
    }

    /*
    * GEt Data Location Booking Service Function
    */

    public function getDataLocation(Request $request)
    {
        $data['branch_office'] = $this->branchOffice->getBranchOfficeForBookingService();
    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /*
    * Store Booking Services
    */

    public function storeBookingServices(Request $request)
    {
    	$validator = Validator::make($request->all(), $this->validationStoreBookingServices($request));

        if ($validator->fails()) 
        {
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);
        }
        else
        {
            return $this->promotion->storeBookingServices($request->except(['_token']));
        }
    }

    /*
    * Test Drive Function
    */

    public function testDrive(Request $request)
    {
    	
    }

    /*
    * Validation Form Booking Services
    */

    protected function validationStoreBookingServices($request = array())
    {
    	$rules = [
    		'no_kendaraan' 		=> 'required',
    		'jenis_kendaraan' 	=> 'required',
    		'nama_lengkap'		=> 'required',
    		'no_telpon'			=> 'required',
    		'email'				=> 'required|email',
    		'tanggal_booking'	=> 'required',
    		'keterangan'		=> 'required',
    		'branch_office_id'	=> 'required'
    	];

    	return $rules;
    }
}
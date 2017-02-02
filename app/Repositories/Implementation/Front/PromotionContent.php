<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\PromotionContent as PromotionContentInterface;
use App\Model\Front\BookingServicesModel as BookingServicesModel;
use App\Model\Front\BookingTestDriveModel as BookingTestDriveModel;
use App\Model\Front\PromotionModel as PromotionModel;
use App\Model\Front\PromotionImageModel as PromotionImageModel;
use App\Model\Front\PromotionTransModel as PromotionTransModel;
use App\Model\Front\PromotionCategoryModel as PromotionCategoryModel;
use App\Services\Transformation\Front\Promotion as PromotionTransformation;
use Cache;
use Session;
use DB;

class PromotionContent extends BaseImplementation implements PromotionContentInterface
{

	protected $bookingServices;
    protected $bookingTestDrive;
    protected $promotionService;
    protected $promotionImageService;
    protected $promotionTransService;
    protected $promotionCategoryService;
    protected $promotionTransformation;
    protected $message;
    protected $lastInsertId;

    function __construct(BookingServicesModel $bookingServices, BookingTestDriveModel $bookingTestDrive, PromotionModel $promotionService, PromotionImageModel $promotionImageService, PromotionTransModel $promotionTransService, PromotionCategoryModel $promotionCategoryService, PromotionTransformation $promotionTransformation)
    {
        $this->bookingServices = $bookingServices;
        $this->bookingTestDrive = $bookingTestDrive;
        $this->promotionService = $promotionService;
        $this->promotionImageService = $promotionImageService;
        $this->promotionTransService = $promotionTransService;
        $this->promotionCategoryService = $promotionCategoryService;
        $this->promotionTransformation = $promotionTransformation;
    }

    /*
    * Get Data Promotion
    */

    public function getPromotion($params = array())
    {
        $params = [
            'is_active' => true
        ];

        $promotionServiceData = $this->promotionService($params, 'asc', 'array', true);

        return $this->promotionTransformation->getPromotionServiceTransform($promotionServiceData);
    }

    /**
     * Store Booking Services
     * @param $data
     */
    public function storeBookingServices($data)
    {
    	try{

    		DB::beginTransaction();

    		if ($this->storeDataBookingServices($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('Booking Service Berhasil'), true);
    	}
    	catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Booking Test Drive
     * @param $data
     */
    public function storeBookingTestDrive($data)
    {
        try{

            DB::beginTransaction();

            if ($this->storeDataBookingTestDrive($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('Booking Berhasil'), true);
        }
        catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /* Store Booking Services
     * @param $data
     * @return mixed
     */
    protected function storeDataBookingServices($data)
    {
    	try{

    		$store = $this->bookingServices;

            $store->no_booking              = $this->getBookingNumber();
    		$store->no_kendaraan 			= $data['no_kendaraan'];
    		$store->jenis_kendaraan 		= $data['jenis_kendaraan'];
    		$store->nama_lengkap 			= $data['nama_lengkap'];
    		$store->no_telpon 				= $data['no_telpon'];
    		$store->email 					= $data['email'];
    		$store->tanggal_booking 		= $data['tanggal_booking'];
    		$store->keterangan 				= $data['keterangan'];
    		$store->branch_office_id 		= $data['branch_office_id'];

    		if($save = $store->save()) {
                $this->lastInsertId = $store->id;
            }

            return $save;

    	}
    	catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /* Store Booking Test Drive
     * @param $data
     * @return mixed
     */
    protected function storeDataBookingTestDrive($data)
    {
        try{

            $store = $this->bookingTestDrive;

            $store->no_booking              = $this->getBookingNumber();
            $store->jenis_kendaraan         = $data['jenis_kendaraan'];
            $store->nama_lengkap            = $data['nama_lengkap'];
            $store->no_telpon               = $data['no_telpon'];
            $store->email                   = $data['email'];
            $store->tanggal_booking         = $data['tanggal_booking'];
            $store->keterangan              = $data['keterangan'];

            if($save = $store->save()) {
                $this->lastInsertId = $store->id;
            }

            return $save;

        }
        catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Get Promotion
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function promotionService($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $promotionService = $this->promotionService
            ->with('category')
            ->with('translation');

        if(isset($params['is_active'])) {
            $promotionService->isActive($params['is_active']);
        }


        if(!$promotionService->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $promotionService->first()->toArray();
                } 
                else 
                {
                    return $promotionService->get()->toArray();
                }

            break;
        }
    }

}
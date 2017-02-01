<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\PromotionContent as PromotionContentInterface;
use App\Model\Front\BookingServicesModel as BookingServicesModel;
use Request;
use Cache;
use Session;
use DB;

class PromotionContent implements PromotionContentInterface
{

	protected $bookingServices;
    protected $promotionTransformation;
    protected $message;

    function __construct(BookingServicesModel $bookingServices)
    {
        $this->bookingServices = $bookingServices;
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
                //return $this->setResponse(trans('Booking Service Gagal'), false);
            }

            DB::commit();
            //return $this->setResponse(trans('Booking Service Berhasil, Tunggu Email Pemberitahuan Dari Kami'), true);
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

    		$store->no_kendaraan 			= $data['no_kendaraan'];
    		$store->jenis_kendaraan 		= $data['jenis_kendaraan'];
    		$store->nama_lengkap 			= $data['nama_lengkap'];
    		$store->no_telpon 				= $data['no_telpon'];
    		$store->email 					= $data['email'];
    		$store->tanggal_booking 		= $data['tanggal_booking'];
    		$store->keterangan 				= $data['keterangan'];
    		$store->branch_office_id 		= $data['branch_office_id'];

    		$save = $store->create();

            return $save;

    	}
    	catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Get Booking Services
     * @return array
     */
    protected function bookingServices($params = [], $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $bookingServices = $this->bookingServices;

        if(!$bookingServices->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $bookingServices->get()->toArray();
                } else {
                    return $bookingServices->first()->toArray();
                }
                break;
        }
    }

}
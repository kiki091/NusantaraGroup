<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\BookingServices as BookingServicesInterface;

class BookingServices {

	protected $bookingServices;

    public function __construct(BookingServicesInterface $bookingServices)
    {
        $this->bookingServices = $bookingServices;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params)
    {
        return $this->bookingServices->getData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params)
    {
        return $this->bookingServices->store($params);
    }

    /**
     * Show Data 
     * @param $params
     * @return mixed
     */
    public function showData($params)
    {
        return $this->bookingServices->showData($params);
    }

    /**
     * Search Data 
     * @param $params
     * @return mixed
     */
    public function searchData($params)
    {
        return $this->bookingServices->searchData($params);
    }

    
}
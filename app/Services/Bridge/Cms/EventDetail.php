<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\EventDetail as EventDetailInterface;

class EventDetail
{
	protected $eventDetail;

    public function __construct(EventDetailInterface $eventDetail)
    {
        $this->eventDetail = $eventDetail;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->eventDetail->getData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params, $property_id)
    {
        return $this->eventDetail->store($params, $property_id);
    }

    /**
     * Store Image Slider 
     * @param $params
     * @return mixed
     */
    public function editImageSlider($params)
    {
        return $this->eventDetail->editImageSlider($params);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params)
    {
        return $this->eventDetail->edit($params);
    }

    /**
     * Change status Data 
     * @param $params
     * @return mixed
     */
    public function changeStatus($params)
    {
        return $this->eventDetail->changeStatus($params);
    }

    /**
     * Ordering Data 
     * @param $params
     * @return mixed
     */
    public function order($params)
    {
        return $this->eventDetail->order($params);
    }

    /**
     * Delete Data 
     * @param $params
     * @return mixed
     */
    public function delete($params)
    {
        return $this->eventDetail->delete($params);
    }

    /**
     * Delete Image Slider 
     * @param $params
     * @return mixed
     */
    public function deleteImageSlider($params)
    {
        return $this->eventDetail->deleteImageSlider($params);
    }
}
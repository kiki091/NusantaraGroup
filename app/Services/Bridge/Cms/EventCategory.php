<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\EventCategory as EventCategoryInterface;

class EventCategory
{
	protected $eventCategory;

    public function __construct(EventCategoryInterface $eventCategory)
    {
        $this->eventCategory = $eventCategory;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->eventCategory->getData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params, $property_id)
    {
        return $this->eventCategory->store($params, $property_id);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params)
    {
        return $this->eventCategory->edit($params);
    }

    /**
     * Change status Data 
     * @param $params
     * @return mixed
     */
    public function changeStatus($params)
    {
        return $this->eventCategory->changeStatus($params);
    }

    /**
     * Ordering Data 
     * @param $params
     * @return mixed
     */
    public function order($params)
    {
        return $this->eventCategory->order($params);
    }
}
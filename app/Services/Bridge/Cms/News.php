<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\News as NewsInterface;

class News
{
    protected $news;

    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->news->getData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params, $property_id)
    {
        return $this->news->store($params, $property_id);
    }

    /**
     * Store Image Slider 
     * @param $params
     * @return mixed
     */
    public function editImageSlider($params)
    {
        return $this->news->editImageSlider($params);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params)
    {
        return $this->news->edit($params);
    }

    /**
     * Change status Data 
     * @param $params
     * @return mixed
     */
    public function changeStatus($params)
    {
        return $this->news->changeStatus($params);
    }

    /**
     * Ordering Data 
     * @param $params
     * @return mixed
     */
    public function order($params)
    {
        return $this->news->order($params);
    }

    /**
     * Delete Data 
     * @param $params
     * @return mixed
     */
    public function delete($params)
    {
        return $this->news->delete($params);
    }

    /**
     * Delete Image Slider 
     * @param $params
     * @return mixed
     */
    public function deleteImageSlider($params)
    {
        return $this->news->deleteImageSlider($params);
    }
}
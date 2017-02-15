<?php

namespace App\Services\Transformation\Auth;

class User
{
	/**
     * Get Ayana Auth Session Transformation
     * @param $data
     * @return array
     */
    public function getAuthSessionTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setAuthSessionTransform($data);
    }

    /**
     * Set Ayana Auth Session Transformation
     * @param $data
     * @return array
     */
    protected function setAuthSessionTransform($data)
    {

        return [
            'user_id' => isset($data['id']) ? $data['id'] : '',
            'name' => isset($data['name']) ? $data['name'] : '',
            'email' => isset($data['email']) ? $data['email'] : '',
            'location' => $this->locationBuilder($data),
        ];
    }

    /**
     * Location Builder Transformation
     * @param $data
     * @return array
     */
    private function locationBuilder($data)
    {
        if (empty($data) && !isset($data['location']))
            return array();

        $location = $data['location'];

        $dataLocation['location_name'] = $location['name'];
        $dataLocation['property_slug'] = $location['property_location_slug'];

        return $dataLocation;
    }

}
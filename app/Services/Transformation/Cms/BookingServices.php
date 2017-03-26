<?php

namespace App\Services\Transformation\Cms;


class BookingServices
{
	/**
     * get Data Static Page Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getBookingServicesCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setBookingServicesCmsTransform($data);
    }

    public function getDataBookingServicesCmsTransform($data, $office)
    {
        if(!is_array($data) || empty($data) || !is_array($office) || empty($office))
            return array();

        return $this->setDataBookingServicesCmsTransform($data, $office);
    }

    protected function setBookingServicesCmsTransform($data)
    {
    	$dataTranform = array_map(function($data)
        {
            return [
                'id'             => isset($data['id']) ? $data['id'] : '',
                'no_booking'          => isset($data['no_booking']) ? $data['no_booking'] : '',
                'nama_lengkap'      => isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '',
                'office_name'      => isset($data['branch_office']['title']) ? $data['branch_office']['title'] : '',
                'office_thumbnail'      => isset($data['branch_office']['thumbnail']) ? asset(THUMBNAIL_BRANCH_OFFICE_IMAGES_DIRECTORY.rawurlencode($data['branch_office']['thumbnail'])) : '',
                
            ];
        }, $data);

        $finalData = [];
        foreach ($dataTranform as $item) {
            $finalData[$item['office_name']][] = $item;

        }
        
        return $finalData;
    }

    protected function setDataBookingServicesCmsTransform($data, $office)
    {
        $dataTranform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTranform['no_booking'] = isset($data['no_booking']) ? $data['no_booking'] : '';
        $dataTranform['no_kendaraan'] = isset($data['no_kendaraan']) ? $data['no_kendaraan'] : '';
        $dataTranform['nama_lengkap'] = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '';
        $dataTranform['no_telpon'] = isset($data['no_telpon']) ? $data['no_telpon'] : '';
        $dataTranform['email'] = isset($data['email']) ? $data['email'] : '';
        $dataTranform['tanggal_booking'] = isset($data['tanggal_booking']) ? $data['tanggal_booking'] : '';
        $dataTranform['keterangan'] = isset($data['keterangan']) ? $data['keterangan'] : '';

        $dataTranform['office'] = $this->getOfficeTranslation($office);

        return $dataTranform;
    }

    protected function getOfficeTranslation($office)
    {
        $dataTranform = array_map(function($office)
        {
            return [
                'id'             => isset($office['id']) ? $office['id'] : '',
                'title_description'          => isset($office['title_description']) ? $office['title_description'] : '',
                
            ];
        }, $office);

        return $dataTranform;
    
    }

}
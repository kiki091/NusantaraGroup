<?php

namespace App\Services\Transformation\Front;


class FooterContent
{

    /**
     * get Data For Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    public function getFooterContentFrontTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setFooterContentFrontTransform($data);
    }

    protected function setFooterContentFrontTransform($data)
    {
        $data['footer_box_center'] = isset($data['footer_box_center']) ? $data['footer_box_center'] : '';
        $data['footer_box_right'] = isset($data['footer_box_right']) ? $data['footer_box_right'] : '';
        $data['facebook_link'] = isset($data['facebook_link']) ? $data['facebook_link'] : '';
        $data['instagram_link'] = isset($data['instagram_link']) ? $data['instagram_link'] : '';
        $data['tweeter_link'] = isset($data['tweeter_link']) ? $data['tweeter_link'] : '';
        $data['google_link'] = isset($data['google_link']) ? $data['google_link'] : '';
        $data['mail_link'] = isset($data['mail_link']) ? $data['mail_link'] : '';
        $data['subscribe_content'] = isset($data['subscribe_content']) ? $data['subscribe_content'] : '';
        return $data;
    }

}

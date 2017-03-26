<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\FooterContent as FooterContentInterface;

class FooterContent {

	protected $FooterContent;

    public function __construct(FooterContentInterface $FooterContent)
    {
        $this->FooterContent = $FooterContent;
    }

    /**
     * Get Data Main Banner
     * @param $params
     * @return mixed
     */
    public function getFooterContent()
    {
        return $this->FooterContent->getfooterContent();
    }
}
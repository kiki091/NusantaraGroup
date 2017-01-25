<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\FooterContent as FooterContentInterface;
use App\Model\Front\FooterContent as FooterContentServices;
use App\Services\Transformation\Front\FooterContent as FooterContentTransformation;
use Cache;
use Session;
use DB;

class FooterContent implements FooterContentInterface
{

    protected $footerContent;
    protected $footerContentTransformation;

    function __construct(FooterContentServices $footerContent, FooterContentTransformation $footerContentTransformation)
    {
        $this->footerContent = $footerContent;
        $this->footerContentTransformation = $footerContentTransformation;
    }

    public function getfooterContent()
    {
        $footerContentData = $this->footerContent();
        //dd($mainBannerData);
        return $this->footerContentTransformation->getFooterContentFrontTransform($footerContentData);
    }

    /**
     * Get All Main Banner
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function footerContent($returnType = 'array', $returnSingle = false)
    {

        $footerContent = $this->footerContent;
        
        //$footerContent->orderBy('created_at', 'desc');

        if(!$footerContent->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $footerContent->first()->toArray();
                }
            break;
        }
    }

}
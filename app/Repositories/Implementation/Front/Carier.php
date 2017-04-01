<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\Carier as CarierInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Carier as CarierModel;
use App\Models\CarierCategory as CarierCategoryModel;
use App\Models\CarierContent as CarierContentModel;
use App\Services\Transformation\Front\Carier as CarierTransformation;
use Cache;
use Session;
use DB;

class Carier extends BaseImplementation implements CarierInterface
{

    protected $carier;
    protected $carierCategory;
    protected $carierContent;
    protected $carierTransform;

    function __construct(CarierModel $carier, CarierCategoryModel $carierCategory, CarierContentModel $carierContent, CarierTransformation $carierTransform)
    {
        $this->carier = $carier;
        $this->carierCategory = $carierCategory;
        $this->carierContent = $carierContent;
        $this->carierTransform = $carierTransform;
    }

    public function getCarier($params = array())
    {
        $params = [
            'is_active' => true,
        ];
        $carierData = $this->carier($params, 'asc', 'array', true);
        
        return $this->carierTransform->getCarierFrontTransform($carierData);
    }

    /**
     * Get All Carier Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function carier($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $carier = $this->carier
            ->with('category');

        if(isset($params['is_active'])) {
            $carier->isActive($params['is_active']);
        }


        if(!$carier->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) 
                {
                    return $carier->get()->toArray();
                } 
                else 
                {
                    return $carier->first()->toArray();
                }

            break;
        }
    }

}
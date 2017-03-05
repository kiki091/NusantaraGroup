<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Awards as AwardsInterface;
use App\Model\Cms\AwardsModel as AwardsModels;
use App\Model\Cms\AwardsTransModel as AwardsTransModels;
use App\Services\Transformation\Cms\Awards as AwardsTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class Awards extends BaseImplementation implements AwardsInterface
{
	protected $message;
    protected $awards;
    protected $awardsTrans;
    protected $lastInsertId;
    protected $awardsTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(AwardsModels $awards, AwardsTransModels $awardsTrans, AwardsTransformation $awardsTransformation)
    {
        $this->awards = $awards;
        $this->awardsTrans = $awardsTrans;
        $this->awardsTransformation = $awardsTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params
        ];

        $awardsData = $this->awards($data, 'asc', 'array', true);
       
        return $this->awardsTransformation->getAwardsCmsTransform($awardsData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function awards($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $awards = $this->awards
            ->with('property_location')
            ->with('translation');

        if(isset($data['is_active'])) {
            $awards->isActive($data['is_active']);
        }

        if(isset($params['order_by'])) {
            $awards->orderBy($params['order_by'], $orderType);
        } else {
            $awards->orderBy('order', $orderType);
            $awards->orderBy('created_at', 'desc');
        }

        if(isset($data['id'])) {
            $awards->id($data['id']);
        }

        if(isset($data['property_location_id'])) {
            $awards->propertyId($data['property_location_id']);
        }


        if(!$awards->count())
            return array();

        if(isset($data['id'])) 
        {
            return $awards->first()->toArray();
        }
        
        return $awards->get()->toArray();
    }

    public function store($params, $property_id)
    {

    }

    public function edit($params)
    {
        
    }

    public function changeStatus($params)
    {
        
    }

    public function delete($params)
    {
        
    }

    public function order($params)
    {
        
    }
}
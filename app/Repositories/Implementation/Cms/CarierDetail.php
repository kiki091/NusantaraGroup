<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\CarierDetail as CarierDetailInterface;
use App\Models\Carier as CarierModels;
use App\Models\CarierDetail as CarierDetailModels;
use App\Services\Transformation\Cms\CarierDetail as CarierDetailTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class CarierDetail extends BaseImplementation implements CarierDetailInterface
{
	protected $message;
    protected $carier;
    protected $carierDetail;
    protected $lastInsertId;
    protected $carierDetailTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(CarierModels $carier, CarierDetailModels $carierDetail, CarierDetailTransformation $carierDetailTransformation)
    {
        $this->carier = $carier;
        $this->carierDetail = $carierDetail;
        $this->carierDetailTransformation = $carierDetailTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    /**
     * Get Data Carier Pages
     */

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params
        ];

        $carierData = $this->carierDetail($data, 'asc', 'array', true);
       
        return $this->carierDetailTransformation->getCarierDetailCmsTransform($carierData);
    }


    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function carierDetail($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $carierDetail = $this->carierDetail
            ->with('category');

        if(isset($data['is_active'])) {
            $carierDetail->isActive($data['is_active']);
        }

        if(isset($data['order_by'])) {
            $carierDetail->orderBy($data['order_by'], $orderType);
        } else {
            $carierDetail->orderBy('order', $orderType);
        }

        if(isset($data['id'])) {
            $carierDetail->id($data['id']);
        }

        if(!$carierDetail->count())
            return array();

        if(isset($data['id'])) 
        {
            return $carierDetail->first()->toArray();
        }
        
        return $carierDetail->get()->toArray();
    }

    /**
     * Store Carier
     * @param $data
     */

    public function store($data, $property_location_id)
    {
        try {

            DB::beginTransaction();

            //TODO: StoreData
            if ($this->storeData($data, $property_location_id) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_data_general'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Carier data
     * @param $data
     * @return mixed
     */

    protected function storeData($data, $property_location_id)
    {
        try {

            $store                               = $this->carierDetail;

            if ($this->isEditMode($data)) {
                $store                           = $this->carierDetail->find($data['id']);
            }

            $store->carier_category_id           = isset($data['carier_category_id']) ? $data['carier_category_id'] : "";
            $store->job_title                    = isset($data['job_title']) ? $data['job_title'] : "";
            $store->job_description              = isset($data['job_description']) ? $data['job_description'] : "";
            $store->meta_title                   = isset($data['meta_title']) ? $data['meta_title'] : "";
            $store->meta_keyword                 = isset($data['meta_keyword']) ? $data['meta_keyword'] : "";
            $store->meta_description             = isset($data['meta_description']) ? $data['meta_description'] : "";

            if (!$this->isEditMode($data))
            {
                $store->is_active               = true;
                $store->updated_at              = $this->mysqlDateTimeFormat();
                $store->created_at              = $this->mysqlDateTimeFormat();

            }

            if($save = $store->save()) {
                $this->lastInsertId = $store->id;
            }

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Get Data For Edit Carier Detail
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $singleCarierData = $this->carierDetail($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->carierDetailTransformation->getSingleCarierDetailCmsTransform($singleCarierData));
    }

    /**
     * Change Status Data Carier
     * @param $data
     */

    public function changeStatus($data)
    {
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->carierDetail->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->carierDetail->id($data['id'])->update($updatedData);

            if($changeStatus) {
                DB::commit();
                return $this->setResponse(trans('message.cms_success_update_status_general'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_update_status_general'), false);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get Single Carier
     * @param $params
     */
    public function getSingleCarierDetail($params) {

        $primaryData = $this->carierDetail($params, 'asc', 'array', true);

        return $this->carierDetailTransformation->getSingleCarierDetailCmsTransform($primaryData);
    }

    /**
     * Delete Data Carier
     * @param $data
     */

    public function delete($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $params = [
                "id" => $data['id']
            ];

            $carierData = $this->getSingleCarierDetail($params);
            
            if (!$this->removeCarierDetail($params)) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_delete_data_general'), true);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Remove Carier From Database
     * @param $data
     * @return bool
     */
    protected function removeCarierDetail($data)
    {
        try {

            $delete = $this->carierDetail
                ->id($data['id'])
                ->forceDelete();

            if ($delete)
                return true;

            $this->message = trans('message.cms_failed_delete_data_general');
            return false;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Order Data Carier
     * @param $data
     */

    public function order($data)
    {
        try {
            DB::beginTransaction();

            if ($this->orderData($data)) {
                DB::commit();
                return $this->setResponse(trans('message.cms_success_ordering'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_ordering'), false);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Order List Data
     * @param $data
     */
    protected function orderData($data)
    {
        try {
            $i = 1 ;
            foreach ($data as $key => $val) {
                $orderValue = $i++;

                $carierDetail           = $this->carierDetail->find($val);

                $carierDetail->order    = $orderValue;

                $carierDetail->save();
            }

            return true;

        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}
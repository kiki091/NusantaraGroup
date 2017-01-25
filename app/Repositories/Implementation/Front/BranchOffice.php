<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Contracts\Front\BranchOffice as BranchOfficeInterface;
use App\Model\Front\CompanyBranchOfficeModel as BranchOfficeModel;
use App\Model\Front\CompanyBranchOfficeModelTrans as BranchOfficeModelTrans;
use App\Services\Transformation\Front\BranchOffice as BranchOfficeTransformation;
use Cache;
use Session;
use DB;

class BranchOffice implements BranchOfficeInterface
{

    protected $branchOffice;
    protected $branchOfficeTrans;
    protected $branchOfficeTransformation;

    function __construct(BranchOfficeModel $branchOffice, BranchOfficeModelTrans $branchOfficeTrans, BranchOfficeTransformation $branchOfficeTransformation)
    {
        $this->branchOffice = $branchOffice;
        $this->branchOfficeTrans = $branchOfficeTrans;
        $this->branchOfficeTransformation = $branchOfficeTransformation;
    }

    public function getBranchOffice()
    {
        $branchOfficeData = $this->branchOffice();
        //dd($mainBannerData);
        return $this->branchOfficeTransformation->getBranchOfficeFrontTransform($branchOfficeData);
    }

    public function getBranchOfficeDetail($slug)
    {
            $params = [
                'slug' => $slug,
                'is_active' => true,
            ];
            $branchOfficeData = $this->branchOfficeDetail($params, 'asc', 'array', true);

            return $this->branchOfficeTransformation->getBranchOfficeDetailFrontTransform($branchOfficeData);
    }

    public function getBranchOfficeSeo($slug)
    {
        $params = [
            'slug' => $slug,
            'is_active' => true,
        ];
        $branchOfficeData = $this->branchOfficeDetail($params, 'asc', 'array', true);

        return $this->branchOfficeTransformation->getBranchOfficeSeoDetailFrontTransform($branchOfficeData);
    }

    /**
     * Get All Branch Office
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function branchOffice($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $branchOffice = $this->branchOffice
            ->with('translation')
            ->with('translations');

        if(isset($params['is_active'])) {
            $branchOffice->isActive($params['is_active']);
        }


        if(!$branchOffice->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $branchOffice->get()->toArray();
                } 
                else 
                {
                    return $branchOffice->first()->toArray();
                }

            break;
        }
    }

    /**
     * Get All Award Detail
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function branchOfficeDetail($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $branchOffice = $this->branchOffice
            ->with('translations')
            ->with('slider');

        if(isset($params['slug'])) {
            $branchOffice->slug($params['slug']);
        }

        if(isset($params['is_active'])) {
            $branchOffice->isActive($params['is_active']);
        }

        if(!$branchOffice
            ->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $branchOffice
                    ->get()->toArray();
                } else {
                    return $branchOffice
                    ->first()->toArray();
                }
                break;
        }

    }

}
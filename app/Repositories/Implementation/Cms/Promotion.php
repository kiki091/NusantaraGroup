<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Promotion as PromotionInterface;
use App\Models\Cms\PromotionModel as PromotionModel;
use App\Models\Cms\PromotionCategoryModel as PromotionCategoryModels;
use App\Models\Cms\PromotionDatailModel as PromotionDatailModels;
use App\Models\Cms\PromotionGalleryModel as PromotionGalleryModels;
use App\Models\Cms\PromotionImagesModel as PromotionImagesModels;
use App\Models\Cms\PromotionTransModel as PromotionTransModels;
use App\Services\Transformation\Cms\Promotion as PromotionTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class Promotion extends BaseImplementation implements PromotionInterface
{
	protected $message;
    protected $promotion;
    protected $promotionCategory;
    protected $promotionDatail;
    protected $promotionGallery;
    protected $promotionImages;
    protected $promotionTrans;
    protected $lastInsertId;
    protected $promotionTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(PromotionModel $promotion, PromotionCategoryModel $promotionCategory, PromotionDatailModels $promotionDatail, PromotionGalleryModels $promotionGallery, PromotionImagesModels $promotionImages, PromotionTransModels $promotionTrans, PromotionTransformation $promotionTransformation)
    {
        $this->promotion = $promotion;
        $this->promotionCategory = $promotionCategory;
        $this->promotionDatail = $promotionDatail;
        $this->promotionGallery = $promotionGallery;
        $this->promotionImages = $promotionImages;
        $this->promotionTrans = $promotionTrans;
        $this->promotionTransformation = $promotionTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    public function getData($params)
    {
        $data = [
            "is_active" => true
        ];

        $promotionData = $this->awards($data, 'asc', 'array', true);
       
        return $this->promotionTransformation->getPromotionCmsTransform($awardsData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function promotion($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $promotion = $this->promotion
            ->with(['translation', 'images', 'gallery', 'detail']);

        if(isset($data['is_active'])) {
            $promotion->isActive($data['is_active']);
        }

        if(isset($data['order_by'])) {
            $promotion->orderBy('order', $orderType);
        } 

        if(isset($data['id'])) {
            $promotion->id($data['id']);
        }


        if(!$promotion->count())
            return array();

        if(isset($data['id'])) 
        {
            return $promotion->first()->toArray();
        }
        
        return $promotion->get()->toArray();
    }

}
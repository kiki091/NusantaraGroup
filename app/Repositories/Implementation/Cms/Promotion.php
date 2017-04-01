<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Promotion as PromotionInterface;
use App\Models\Promotion as PromotionModel;
use App\Models\PromotionCategory as PromotionCategoryModels;
use App\Models\PromotionDetail as PromotionDatailModels;
use App\Models\PromotionGallery as PromotionGalleryModels;
use App\Models\PromotionImage as PromotionImagesModels;
use App\Models\PromotionTrans as PromotionTransModels;
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

    function __construct(PromotionModel $promotion, PromotionCategoryModels $promotionCategory, PromotionDatailModels $promotionDatail, PromotionGalleryModels $promotionGallery, PromotionImagesModels $promotionImages, PromotionTransModels $promotionTrans, PromotionTransformation $promotionTransformation)
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

    public function getData()
    {
        $data = [
            "is_active" => true
        ];

        $promotionData = $this->promotion($data, 'asc', 'array', true);
       
        return $this->promotionTransformation->getPromotionCmsTransform($promotionData);
    }

    public function getCategoryPromotion()
    {
        $data = [
            "is_active" => true
        ];

        $promotionCategory = $this->promotionCategory($data, 'asc', 'array', true);
       
        return $this->promotionTransformation->getPromotionCategoryCmsTransform($promotionCategory);
    }

    /**
     * Get All Data Promotions
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

    /**
     * Get All Data Category Promotions
     * Warning: this function doesn't redis cache
     * @param array $data
     * @return array
     */
    protected function promotionCategory($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $promotionCategory = $this->promotionCategory
            ->with(['translations']);

        if(isset($data['is_active'])) {
            $promotionCategory->isActive($data['is_active']);
        }

        if(isset($data['order_by'])) {
            $promotionCategory->orderBy('order', $orderType);
        } 

        if(isset($data['slug'])) {
            $promotionCategory->slug($data['slug']);
        }

        if(isset($data['id'])) {
            $promotionCategory->id($data['id']);
        }


        if(!$promotionCategory->count())
            return array();

        if(isset($data['id'])) 
        {
            return $promotionCategory->first()->toArray();
        }
        
        return $promotionCategory->get()->toArray();
    }

    /*
    * Store Categori Promotion
    */

    public function storeCategori($data)
    {
        try {

            DB::beginTransaction();

            if ($this->storeDataCategori($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->uploadImageCategori($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_upload_image_success'), true);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Data Categori Promotion
     * @param $data
     * @return mixed
     */
    protected function storeDataCategori($data)
    {
        try {

            $store                      = $this->promotionCategory;

            if ($this->isEditMode($data)) {
                
                $store                  = $this->promotionCategory->find($data['id']);
            }

            $store->category_name               = $data['category_name'];
            $store->category_slug               = $data['category_slug'];
            $store->introduction                = $data['introduction'];
            $store->meta_title                  = $data['meta_title'];
            $store->meta_keyword                = $data['meta_keyword'];
            $store->meta_description            = $data['meta_description'];

            if (!$this->isEditMode($data))
            {
                $store->is_active            = true;
                $store->created_at           = $this->mysqlDateTimeFormat();
                $store->thumbnail_category   = $this->uniqueIdImagePrefix . '_' .$data['thumbnail_category']->getClientOriginalName();
            }
            else {
                if (!empty($data['thumbnail_category'])) {
                    
                    $store->thumbnail_category      = isset($data['thumbnail_category']) ? $this->uniqueIdImagePrefix . '_' . $data['thumbnail_category']->getClientOriginalName() : '';
                }
            }

            if($save = $store->save()) {
                $this->lastInsertId = $store->id;
            }

            return $save;

        }
        catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload Thumbnail Categori Promotion
     * @param $data
     * @return bool
     */
    protected function uploadImageCategori($data)
    {
        try {

            if (!$this->isEditMode($data)){

                if (!$this->detailImageCategoriUploader($data)){
                    return false;
                }
            }
            else{

                if (!empty($data['thumbnail_category'])) {
                    if (!$this->detailImageCategoriUploader($data)) {
                        return false;
                    }
                }
            }

            return true;
        }
        catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Detail Image Uploader Categori Promotion
     * @param $file
     * @return bool
     */
    protected function detailImageCategoriUploader($data)
    {
        if($data['thumbnail_category']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' . $data['thumbnail_category']->getClientOriginalName();

            if (! $data['thumbnail_category']->move('./' . PROMOTION_IMAGES_CATEGORY_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['thumbnail_category']->getErrorMessage();
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
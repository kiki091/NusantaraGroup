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
            'order_by' => 'order'
        ];

        $promotionData = $this->promotion($data, 'asc', 'array', true);
       
        return $this->promotionTransformation->getPromotionCmsTransform($promotionData);
    }

    public function getCategoryPromotion()
    {
        $data = [
            'order_by' => 'order'
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
            $promotion->orderBy($data['order_by'], $orderType);
        }else {
            $promotion->orderBy('order', 'asc');
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
            $promotionCategory->orderBy($data['order_by'], $orderType);
        }else {
            $promotionCategory->orderBy('order', 'asc');
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
     * Edit Data Categori Promotion
     * @param $data
     * @return bool
     */

    public function editCategori($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $singleCategoriPromotionData = $this->promotionCategory($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->promotionTransformation->getSingleCategoriPromotionCmsTransform($singleCategoriPromotionData));
    }

    /**
     * Change status Categori Promotion
     * @param $data
     * @return bool
     */

    public function changeStatusCategori($data)
    {
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->promotionCategory->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->promotionCategory->id($data['id'])->update($updatedData);

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
     * Get Single Categori Promotion
     * @param $params
     */
    public function getSingleCategoriPromotion($params) {

        $primaryData = $this->promotionCategory($params, 'asc', 'array', true);

        return $this->promotionTransformation->getSingleCategoriPromotionCmsTransform($primaryData);
    }

    /**
     * Delete Data Categori Promotion
     * @param $params
     * @return mixed
     */
    public function deleteCategori($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $params = [
                "id" => $data['id']
            ];
            $categoriPromotionrData = $this->getSingleCategoriPromotion($params);

            if (!$this->removeThumbnailCategoriFiles($categoriPromotionrData['thumbnail_category'])) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }

            if (!$this->removeThumbnailCategori($params)) {
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
     * Remove Thumbnail Categori Promotion Files
     * @param $data
     */
    protected function removeThumbnailCategoriFiles($data)
    {
        try {

            $filename        = isset($data['thumbnail_category']) && !empty($data['thumbnail_category']) ? $data['thumbnail_category'] : uniqid();

            if (file_exists('./' . PROMOTION_IMAGES_CATEGORY_DIRECTORY . $filename)) {
                unlink('./' . PROMOTION_IMAGES_CATEGORY_DIRECTORY . $filename);
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Remove Categori Promotion Data From Database
     * @param $data
     * @return bool
     */
    protected function removeThumbnailCategori($data)
    {
        try {

            $delete = $this->promotionCategory
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
     * Order Data Categori Promotion
     * @param $data
     */
    public function orderCategori($data)
    {
        try {
            DB::beginTransaction();

            if ($this->orderDataCategori($data)) {
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
     * Order List Data Categori Promotion
     * @param $data
     */
    protected function orderDataCategori($data)
    {
        try {
            $i = 1 ;
            foreach ($data as $key => $val) {
                $orderValue = $i++;

                $promotionCategory         = $this->promotionCategory->find($val);

                $promotionCategory->order  = $orderValue;

                $promotionCategory->save();
            }

            return true;

        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /*
    * Store Data Promotion
    */

    public function storePromotion($data)
    {
        try {

            DB::beginTransaction();

            if ($this->storeDataPromotion($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->storePromotionDetail($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->isEditMode($data))
            {
                if ($this->storePromotionGallery($data) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            if ($this->storePromotionImages($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->storePromotionTranslation($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: THUMBNAIL UPLOAD Promotion
            if ($this->uploadThumbnailPromotion($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: IMAGE PROMOTION UPLOAD
            if ($this->uploadImagePromotionDetail($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: IMAGE SLIDER UPLOAD
            if (!$this->isEditMode($data)) {
                if ($this->uploadImageGallery($data) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_upload_image_success'), true);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store  Promotion
     * @param $data
     * @return mixed
     */

    protected function storeDataPromotion($data)
    {
        try {

            $order = 1;
            $store              = $this->promotion;

            if ($this->isEditMode($data)) {
                $store          = $this->promotion->find($data['id']);
            }

            $store->promotion_category_id   = isset($data['promotion_category_id']) ? $data['promotion_category_id'] : "";
            $store->title   = isset($data['title']) ? $data['title'] : "";
            $store->slug   = isset($data['slug']) ? $data['slug'] : "";

            if (!$this->isEditMode($data)) 
            {
                $store->thumbnail           = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
                $store->is_active           = true;
                $store->order               = $order;
                $store->created_at          = $this->mysqlDateTimeFormat();

            } else {
                //TODO: Edit Mode Thumbnail Checker
                if (!empty($data['thumbnail'])) {
                    $store->thumbnail       = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
                }
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
     * Store  Promotion Detail
     * @param $data
     * @return mixed
     */

    protected function storePromotionDetail($data)
    {
        try {

            $order = 1;
            $store              = $this->promotionDatail;

            if ($this->isEditMode($data)) {
                $store          = $this->promotionDatail->find($data['id']);
            }

            $store->equipment_interior   = isset($data['equipment_interior']) ? $data['equipment_interior'] : "";
            $store->equipment_exterior   = isset($data['equipment_exterior']) ? $data['equipment_exterior'] : "";
            $store->information   = isset($data['information']) ? $data['information'] : "";

            if (!$this->isEditMode($data)) 
            {
                $store->promotion_id   = $this->lastInsertId;
                $store->created_at     = $this->mysqlDateTimeFormat();

            }

            $save = $store->save();

            return $save;
            
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Store Promotion Galleri
     * @param $data
     * @return mixed
     */
    protected function storePromotionGallery($data)
    {
        try {

            $finalData = [];

            foreach ($data['filename'] as $key => $item) 
            {
                $finalData[] = [
                    "promotion_id"  => $this->lastInsertId,
                    "filename"     => $this->uniqueIdImagePrefix . '_' .$item->getClientOriginalName(),
                    "created_at" => $this->mysqlDateTimeFormat()
                ];
            }

            if ($this->promotionGallery->insert($finalData) != true) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
    * Store Promotion Images
    * @param $data
    */

    protected function storePromotionImages($data)
    {
        try {

            $store                          = $this->promotionImages;

            if (!$this->isEditMode($data))
            {
                $store->banner_image     = $this->uniqueIdImagePrefix . '_' .$data['banner_image']->getClientOriginalName();
                $store->interior_image   = $this->uniqueIdImagePrefix . '_' .$data['interior_image']->getClientOriginalName();
                $store->exterior_image   = $this->uniqueIdImagePrefix . '_' .$data['exterior_image']->getClientOriginalName();
                $store->safety_image     = $this->uniqueIdImagePrefix . '_' .$data['safety_image']->getClientOriginalName();
                $store->accesories_image = $this->uniqueIdImagePrefix . '_' .$data['accesories_image']->getClientOriginalName();
                $store->promotion_id     = $this->lastInsertId;
                $store->created_at       = $this->mysqlDateTimeFormat();
                $store->updated_at       = $this->mysqlDateTimeFormat();

            } else{

                if (!empty($data['banner_image'])) {
                    $store->banner_image       = $this->uniqueIdImagePrefix . '_' .$data['banner_image']->getClientOriginalName();
                }

                if (!empty($data['interior_image'])) {
                    $store->interior_image       = $this->uniqueIdImagePrefix . '_' .$data['interior_image']->getClientOriginalName();
                }

                if (!empty($data['exterior_image'])) {
                    $store->exterior_image       = $this->uniqueIdImagePrefix . '_' .$data['exterior_image']->getClientOriginalName();
                }

                if (!empty($data['safety_image'])) {
                    $store->safety_image       = $this->uniqueIdImagePrefix . '_' .$data['safety_image']->getClientOriginalName();
                }

                if (!empty($data['accesories_image'])) {
                    $store->accesories_image       = $this->uniqueIdImagePrefix . '_' .$data['accesories_image']->getClientOriginalName();
                }
            }

            if($save = $store->save() != true) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Image Detail Promotion Uploader
     * @param $data
     */

    protected function uploadImagePromotionDetail($data)
    {
        try {

            if (!$this->isEditMode($data)) {

                if ( !$this->imagePromotionBannerUploader($data)) {
                    return false;
                }

                if ( !$this->imagePromotionInteriorUploader($data)) {
                    return false;
                }

                if ( !$this->imagePromotionExteriorUploader($data)) {
                    return false;
                }

                if ( !$this->imagePromotionSafetyUploader($data)) {
                    return false;
                }

                if ( !$this->imagePromotionAccesoriesUploader($data)) {
                    return false;
                }

            } else {
                //TODO: Edit Mode
                if (!empty($data['banner_image'])) {
                    if (!$this->imagePromotionBannerUploader($data)) {
                        return false;
                    }
                }

                 //TODO: Edit Mode
                if (!empty($data['interior_image'])) {
                    if (!$this->imagePromotionInteriorUploader($data)) {
                        return false;
                    }
                }

                 //TODO: Edit Mode
                if (!empty($data['exterior_image'])) {
                    if (!$this->imagePromotionExteriorUploader($data)) {
                        return false;
                    }
                }

                 //TODO: Edit Mode
                if (!empty($data['safety_image'])) {
                    if (!$this->imagePromotionSafetyUploader($data)) {
                        return false;
                    }
                }

                 //TODO: Edit Mode
                if (!empty($data['accesories_image'])) {
                    if (!$this->imagePromotionAccesoriesUploader($data)) {
                        return false;
                    }
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Detail Banner Image Promotion Uploader
     * @param $file
     * @return bool
     */
    protected function imagePromotionBannerUploader($data)
    {
        if ($data['banner_image']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['banner_image']->getClientOriginalName();

            if (! $data['banner_image']->move('./' . PROMOTION_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['banner_image']->getErrorMessage();
            return false;
        }
    }

    /**
     * Detail Interior Image Promotion Uploader
     * @param $file
     * @return bool
     */
    protected function imagePromotionInteriorUploader($data)
    {
        if ($data['interior_image']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['interior_image']->getClientOriginalName();

            if (! $data['interior_image']->move('./' . PROMOTION_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['interior_image']->getErrorMessage();
            return false;
        }
    }

    /**
     * Detail Exterior Image Promotion Uploader
     * @param $file
     * @return bool
     */
    protected function imagePromotionExteriorUploader($data)
    {
        if ($data['exterior_image']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['exterior_image']->getClientOriginalName();

            if (! $data['exterior_image']->move('./' . PROMOTION_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['exterior_image']->getErrorMessage();
            return false;
        }
    }

    /**
     * Detail Safety Image Promotion Uploader
     * @param $file
     * @return bool
     */
    protected function imagePromotionSafetyUploader($data)
    {
        if ($data['safety_image']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['safety_image']->getClientOriginalName();

            if (! $data['safety_image']->move('./' . PROMOTION_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['safety_image']->getErrorMessage();
            return false;
        }
    }

    /**
     * Detail Accesories Image Promotion Uploader
     * @param $file
     * @return bool
     */
    protected function imagePromotionAccesoriesUploader($data)
    {
        if ($data['accesories_image']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['accesories_image']->getClientOriginalName();

            if (! $data['accesories_image']->move('./' . PROMOTION_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['accesories_image']->getErrorMessage();
            return false;
        }
    }

    /**
     * Image Gallery Uploader
     * @param $data
     */
    protected function uploadImageGallery($data)
    {
        try {

            foreach ($data['filename'] as $key => $item) {

                if (!$this->detailImageGalleryUploader($item))
                    return false;
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Detail Image Gallery Uploader
     * @param $file
     * @return bool
     */
    protected function detailImageGalleryUploader($file)
    {
        if ($file->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$file->getClientOriginalName();

            if (! $file->move('./' . PROMOTION_IMAGES_GALLERY_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $file->getErrorMessage();
            return false;
        }
    }

    /**
     * Storing Promotion Translation to database
     * @param $data
     * @param $key
     * @return bool
     */
    protected function storePromotionTranslation($data)
    {
        if ($this->isEditMode($data)) {
            $this->removePromotionTranslation($data['id']);
        }

        $finalData = $this->promotionTransformation->getDataForPromotionTranslation($data, $this->lastInsertId, $this->isEditMode($data));
        return $this->promotionTrans->insert($finalData);
    }

    /**
     * Remove Promotion Translation by ID
     * @param $mainBannerId
     * @return bool
     */
    protected function removePromotionTranslation($dataId)
    {
        if (empty($dataId))
            return false;

        return $this->promotionTrans->where('promotion_id', $dataId)->delete();
    }

    

    /**
     * Upload Thumbnail Promotion
     * @param $data
     * @return bool
     */
    protected function uploadThumbnailPromotion($data)
    {
        try {
            if (!$this->isEditMode($data)) {

                if ( !$this->thumbnailPromotionUploader($data)) {
                    return false;
                }

            } else {
                //TODO: Edit Mode
                if (!empty($data['thumbnail'])) {
                    if (!$this->thumbnailPromotionUploader($data)) {
                        return false;
                    }
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    /**
     * Thumbnail Promotion Uploader
     * @param $data
     * @return bool
     */
    protected function thumbnailPromotionUploader($data)
    {
        if ($data['thumbnail']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();

            if (! $data['thumbnail']->move('./' . PROMOTION_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['thumbnail']->getErrorMessage();
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
<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\PromotionCategory as PromotionCategoryInterface;
use App\Models\PromotionCategory as PromotionCategoryModels;
use App\Services\Transformation\Cms\Promotion as PromotionTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class PromotionCategory extends BaseImplementation implements PromotionCategoryInterface
{

	protected $message;
    protected $promotionCategory;
    protected $promotionTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(PromotionCategoryModels $promotionCategory, PromotionTransformation $promotionTransformation)
    {

        $this->promotionCategory = $promotionCategory;
        $this->promotionTransformation = $promotionTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    /**
     * Get All Data Category Promotions
     * Warning: this function doesn't redis cache
     * @param array $data
     * @return array
     */

    public function getCategoryPromotion()
    {
        $data = [
            'order_by' => 'order'
        ];
        
        $promotionCategory = $this->promotionCategory($data, 'asc', 'array', true);
       
        return $this->promotionTransformation->getPromotionCategoryCmsTransform($promotionCategory);
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
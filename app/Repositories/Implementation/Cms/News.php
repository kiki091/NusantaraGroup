<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\News as NewsInterface;
use App\Models\News as NewsModels;
use App\Models\NewsImages as NewsImagesModels;
use App\Services\Transformation\Cms\News as NewsTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;
use DataHelper;

class News extends BaseImplementation implements NewsInterface
{
	protected $message;
    protected $news;
    protected $newsImages;
    protected $lastInsertId;
    protected $newsTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(NewsModels $news, NewsImagesModels $newsImages, NewsTransformation $newsTransformation)
    {
        $this->news = $news;
        $this->newsImages = $newsImages;
        $this->newsTransformation = $newsTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_NUSANTARA_IMAGE);
    }

    /**
     * Get Data 
     */

    public function getData($params)
    {
        $data = [
            "property_location_id" => $params,
            "order_by"			   => "order"
        ];

        $newsData = $this->news($data, 'asc', 'array', true);
       
        return $this->newsTransformation->getNewsCmsTransform($newsData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function news($data = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        $news = $this->news->with(['images_detail', 'property_location']);

        if(isset($data['id'])) {

            $news->id($data['id']);
        }

        if(isset($data['order_by'])) {
            $news->orderBy($data['order_by'], $orderType);
        } else {
            $news->orderBy('order', $orderType);
        }

        if(!$news->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) 
                {
                    return $news->get()->toArray();
                }
                else 
                {
                    return $news->first()->toArray();
                }
            break;
        }
    }

    /**
     * Store Data
     * @param $data
     * @return bool
     */

    public function store($params, $property_id)
    {
    	try {

            DB::beginTransaction();

            if ($this->storeData($params, $property_id) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->isEditMode($params)) {
                if ($this->storeNewsImages($params) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            if ($this->uploadImage($params) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: IMAGE SLIDER UPLOAD
            if (!$this->isEditMode($params)) {
                if ($this->uploadNewsImages($params) != true) {
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
     * Store Data
     * @param $data
     * @return mixed
     */
    protected function storeData($data, $property_id)
    {
        try {

            $store                              = $this->news;

            if ($this->isEditMode($data)) {
                
                $store                          = $this->news->find($data['id']);
            }

            $store->title                       = isset($data['title']) ? $data['title'] : '';
            $store->slug                        = isset($data['slug']) ? $data['slug'] : '';
            $store->side_description            = isset($data['side_description']) ? $data['side_description'] : '';
            $store->quote_description           = isset($data['quote_description']) ? $data['quote_description'] : '';
            $store->description                 = isset($data['description']) ? $data['description'] : '';
            $store->meta_title                  = isset($data['meta_title']) ? $data['meta_title'] : '';
            $store->meta_keyword                = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
            $store->meta_description            = isset($data['meta_description']) ? $data['meta_description'] : '';

            if (!$this->isEditMode($data))
            {
                $store->property_location_id = $property_id;
                $store->is_active            = true;
                $store->created_by           = $this->getUserId();
                $store->created_at           = $this->mysqlDateTimeFormat();
                $store->updated_at           = $this->mysqlDateTimeFormat();
                $store->thumbnail            = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
            }
            else {
                if (!empty($data['thumbnail'])) {
                    
                    $store->thumbnail 		 = isset($data['thumbnail']) ? $this->uniqueIdImagePrefix . '_' . $data['thumbnail']->getClientOriginalName() : '';
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
     * Store Images Slider
     * @param $data
     * @return mixed
     */
    protected function storeNewsImages($data)
    {
        try {

            $finalData = [];

            foreach ($data['filename'] as $key => $item) 
            {
                $finalData[] = [
                    "news_id"  => $this->lastInsertId,
                    "filename"     => $this->uniqueIdImagePrefix . '_' .$item->getClientOriginalName(),
                    "created_at" => $this->mysqlDateTimeFormat(),
                    "updated_at" => $this->mysqlDateTimeFormat(),
                ];
            }

            if ($this->newsImages->insert($finalData) != true) {
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
     * Image Detail Uploader
     * @param $data
     */
    protected function uploadNewsImages($data)
    {
        try {

            foreach ($data['filename'] as $key => $item) {

                if (!$this->detailNewsImageUploader($item))
                    return false;
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Detail Image Uploader
     * @param $file
     * @return bool
     */
    protected function detailNewsImageUploader($file)
    {
        if ($file->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$file->getClientOriginalName();

            if (! $file->move('./' . NEWS_IMAGES_DIRECTORY, $filename)) {
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
     * Upload Logo Image
     * @param $data
     * @return bool
     */
    protected function uploadImage($data)
    {
        try {

            if (!$this->isEditMode($data)){

                if (!$this->detailImageUploader($data)){
                    return false;
                }
            }
            else{

                if (!empty($data['thumbnail'])) {
                    if (!$this->detailImageUploader($data)) {
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
     * Detail Image Uploader
     * @param $file
     * @return bool
     */
    protected function detailImageUploader($data)
    {
        if($data['thumbnail']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' . $data['thumbnail']->getClientOriginalName();

            if (! $data['thumbnail']->move('./' . NEWS_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_image_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['thumbnail']->getErrorMessage();
            return false;
        }
    }

    /**
     * Edit Data
     * @param $data
     * @return array
     */

    public function edit($params)
    {
        $data = [
            'id' => $params['id']
        ];

        $singleData = $this->news($data, 'asc', 'array', false);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->newsTransformation->getSingleNewsTransform($singleData));
    }

    /**
     * Change Status Data
     * @param $data
     * @return array
     */

    public function changeStatus($data)
    {
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->news->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->news->id($data['id'])->update($updatedData);

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
     * Order Data
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

                $news         = $this->news->find($val);

                $news->order  = $orderValue;

                $news->save();
            }

            return true;

        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Delete List Data
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

            $getData = $this->getSingleNewsDetail($params);

            if (!$this->removeNewsFiles($getData['thumbnail'])) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }
            
            if (!$this->removeNews($params)) {
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
     * Remove Data From Database
     * @param $data
     * @return bool
     */
    protected function removeNews($data)
    {
        try {

            $delete = $this->news
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
     * Get Single Data
     * @param $params
     */
    public function getSingleNewsDetail($params) {

        $primaryData = $this->news($params, 'asc', 'array', true);

        return $this->newsTransformation->getSingleNewsTransform($primaryData);
    }

    /**
     * remove Files
     * @param $data
     */
    protected function removeNewsFiles($data)
    {
        try {

            $filename        = isset($data) && !empty($data) ? $data : uniqid();

            if (file_exists('./' . NEWS_IMAGES_DIRECTORY . $filename)) {
                unlink('./' . NEWS_IMAGES_DIRECTORY . $filename);
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }


    /**
     * Delete Image Slider
     * @param $data
     */

    public function deleteImageSlider($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->newsImages->find($data['id']);

            if($this->newsImages->where('id', $data['id'])->delete()) {

                unlink('./'.NEWS_IMAGES_DIRECTORY . $oldData->filename);

                DB::commit();
                
                return $this->setResponse(trans('message.cms_success_delete_data_general'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_delete_data_general'), false);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Edit Image Slider
     * @param $data
     */
    public function editImageSlider($data)
    {
        try {

            DB::beginTransaction();

            $this->lastInsertId = $data['id'];

            if ($this->storeNewsImages($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if ($this->uploadNewsImages($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_update_image_slider_success'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
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
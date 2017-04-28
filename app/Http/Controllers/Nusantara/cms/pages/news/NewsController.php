<?php

namespace App\Http\Controllers\Nusantara\cms\pages\news;

use Illuminate\Http\Request;
use App\Custom\Facades\DataHelper;
use App\Http\Controllers\CmsController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\News as NewsServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class NewsController extends CmsController
{

	protected $user;
    protected $news;
	protected $response;
    protected $validationMessage = '';

    public function __construct(NewsServices $news, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->news = $news;
        $this->response = $response;
    }

    /**
     * Index Data Static Page
     */

    public function index(Request $request)
    {
    	if (Auth::check() == null) {
           return redirect()->route('login');
        }
        
    	$data['page_title'] = 'News';
    	$data['user'] = $this->user->setAuthSession();
    	$data['location'] = $this->getUserLocation();

        $blade = self::URL_BLADE_CMS.'.news.pages';

        if(view()->exists($blade)) 
        {
            return view($blade, $data);
        }
        return abort(404);
    }

    /**
     * Get Data Static Page
     */
    public function getData(Request $request)
    {

        $data['news'] = $this->news->getData($this->getLocationId());

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data
     * @param $request
     * @return array
     */

    public function store(Request $request)
    {
        /*$validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            
            return $this->eventDetail->store($request->except(['_token']), $this->getLocationId());
        }*/

        return $this->news->store($request->except(['_token']), $this->getLocationId());
    }

    /**
     * Edit 
     */
    public function edit(Request $request)
    {
        return $this->news->edit($request->except(['_token']));
    }

    /**
     * Edit Image Slider
     */

    public function editImageSlider(Request $request)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), $this->validateEditImageSlider($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->news->editImageSlider($request->except(['_token']));
        }
        
    }

    /**
     * Change status
     * @param Request $request
     * @return mixed
     */
    public function changeStatus(Request $request)
    {
        return $this->news->changeStatus($request->except(['_token']));
        
    }

    /**
     * Ordering 
     * @param Request $request
     * @return mixed
     */

    public function order(Request $request)
    {
        return $this->news->order($request->input('list_order'));
    }

    /**
     * Delete Image Slider
     * @param Request $request
     * @return mixed
     */
    public function deleteImageSlider(Request $request)
    {
        return $this->news->deleteImageSlider($request->except(['_token']));
        
    }

    /**
     * Delete Data
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        return $this->news->delete($request->except(['_token']));
        
    }

    /**
     * Validation Store Image Slider
     * @return array
     */

    private function validateEditImageSlider($request = array())
    {
        $rules = [
            'filename.*'                => 'required|dimensions:width='.NEWS_IMAGES_DETAIL_WIDTH.',height='.NEWS_IMAGES_DETAIL_HEIGHT.'|max:'. MAX_IMAGE_SIZE .'|mimes:jpeg,jpg',
        ];

        return $rules;
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [

            'title'                 => 'required',
            'slug'                  => 'required',
            'thumbnail'             => 'required|dimensions:width='.NEWS_THUMBNAIL_WIDTH.',height='.NEWS_THUMBNAIL_HEIGHT.'|max:'. MAX_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'filename.*'            => 'required|dimensions:width='.NEWS_IMAGES_DETAIL_WIDTH.',height='.NEWS_IMAGES_DETAIL_HEIGHT.'|max:'. MAX_IMAGE_SIZE .'|mimes:jpg,jpeg',
            'side_description'      => 'required',
            'quote_description'     => 'required',
            'description'           => 'required',
            'meta_title'            => 'required',
            'meta_keyword'          => 'required',
            'meta_description'      => 'required',
        ];

        if ($this->isEditMode($request->input()))
        {
            if (is_null($request->file('thumbnail'))) {
                unset($rules['thumbnail']);
            }

            if (is_null($request->file('filename.*'))) {
                unset($rules['filename.*']);
            }
        }

        return $rules;
    }

    /**
     * Check is edit mode or no
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}
<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Subscribe as SubscribeInterface;
use App\Models\Subscribe as SubscribeService;
use Cache;
use Session;
use DB;

class Subscribe extends BaseImplementation implements  SubscribeInterface
{

    protected $subscribe;
    protected $subscribeTransformation;

    function __construct(SubscribeService $subscribe)
    {
        $this->subscribe = $subscribe;
    }

    public function store($data)
    {
        try {

            DB::beginTransaction();

            if ($this->storeData($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_subscribe'), true);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Subscribe
     * @param $data
     * @return mixed
     */
    protected function storeData($data)
    {
        try {

            $store                          = $this->subscribe;
            $store->email                   = isset($data['email']) ? $data['email'] : "";

            $save = $store->save();
            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

}
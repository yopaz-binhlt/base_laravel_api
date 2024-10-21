<?php

namespace App\Services\External\NavitimeGateway;


class NavitimeBaseGateway
{

    protected $url;

    protected $apiTimeout;

    protected $apiParam;


    public function __construct()
    {
        $this->url = config('external.navitime_setting.api.url').'/'.config('external.navitime_setting.api.client_id').'/'.config('external.navitime_setting.api.api_version');
        $this->apiTimeout = config('navitime_setting.api_timeout');
        $this->apiParam = [
            'request_code' => config('navitime_setting.request_code'),
            'signature'    => config('navitime_setting.signature'),
        ];

    }//end __construct()


}//end class

<?php

namespace App\Services\External\NavitimeGateway;


use App\Services\External\ExternalService;

class NavitimeBaseGateway extends ExternalService
{


    protected function setUrl()
    {
        $this->url = config('external.navitime_setting.api.url').'/'.config('external.navitime_setting.api.client_id').'/'.config('external.navitime_setting.api.api_version');

    }//end setUrl()


    protected function setApiTimeout()
    {
        $this->apiTimeout = config('external.navitime_setting.api.timeout');

    }//end setApiTimeout()


    protected function setApiParam()
    {
        $this->apiParam = [
            'request_code' => config('external.navitime_setting.api.request_code'),
            'signature'    => config('external.navitime_setting.api.signature'),
        ];

    }//end setApiParam()


}//end class

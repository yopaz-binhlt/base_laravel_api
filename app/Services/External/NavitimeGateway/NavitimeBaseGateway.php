<?php

namespace App\Services\External\NavitimeGateway;


use App\Services\External\ExternalService;

class NavitimeBaseGateway extends ExternalService
{


    protected function configure(): void
    {
        $this->url = config('external.navitime_setting.api.url').'/'.config('external.navitime_setting.api.client_id').'/'.config('external.navitime_setting.api.api_version');

        $this->apiTimeout = config('external.navitime_setting.api.timeout');

        $this->apiParam = [
            'request_code' => config('external.navitime_setting.api.request_code'),
            'signature'    => config('external.navitime_setting.api.signature'),
        ];

    }//end configure()


}//end class

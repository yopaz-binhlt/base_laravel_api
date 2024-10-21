<?php

namespace App\Services\External\NavitimeGateway;

use Illuminate\Support\Facades\Http;

class AddressGatewayService extends NavitimeBaseGateway
{


    public function getAddressFromWord(string $word, int $limit=null): array
    {
        try {
            $endpoint = config('external.navitime_setting.api.address_search.endpoint');
            $params = $this->getApiParam();
            $params['word'] = $word;
            if ($limit === null) {
                $params['limit'] = $limit;
            }

            $response = Http::timeout($this->getApiTimeout())->get($this->getUrl().$endpoint, $params);
            $responseData = $response->json();

            if (!$response->ok()) {
                $errorMessage = isset($responseData['message']) ? $responseData['message'] : '';
                throw new \Exception(
                    'NAVITIME_API_HTTP_ERROR',
                    'status_code:'.$response->getStatusCode().' message:'.$errorMessage
                );
            }
        } catch (\Exception $e) {
            throw $e;
        }//end try

        return $responseData;

    }//end getAddressFromWord()


}//end class

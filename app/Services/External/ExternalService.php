<?php

namespace App\Services\External;

abstract class ExternalService
{

    protected string $url;

    protected int $apiTimeout;

    protected array $apiParam;


    abstract protected function setUrl();


    abstract protected function setApiTimeout();


    abstract protected function setApiParam();


    public function __construct()
    {
        $this->setUrl();
        $this->setApiTimeout();
        $this->setApiParam();

    }//end __construct()


    public function getUrl(): string
    {
        return $this->url;

    }//end getUrl()


    public function getApiTimeout(): int
    {
        return $this->apiTimeout;

    }//end getApiTimeout()


    public function getApiParam(): array
    {
        return $this->apiParam;

    }//end getApiParam()


}//end class

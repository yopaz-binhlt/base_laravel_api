<?php

namespace App\Services\External;

abstract class ExternalService
{

    protected string $url;

    protected int $apiTimeout;

    protected array $apiParam;


    /**
     * Abstract function to configure settings, to be implemented by subclasses
     */
    abstract protected function configure(): void;


    public function __construct()
    {
        $this->configure();

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

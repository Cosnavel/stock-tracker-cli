<?php

namespace App\Services;

class HttpClientService
{
    use Logoable;

    protected $url;

    public function __construct()
    {
        $this->url = env("IEX_CLOUD_URL");
    }


    public function execute()
    {
    }
}

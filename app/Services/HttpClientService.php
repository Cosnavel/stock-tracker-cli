<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpClientService
{
    use Logoable;

    protected $url;
    protected $token;

    public function __construct()
    {
        $this->url = env("IEX_CLOUD_URL");
        $this->token = "?token=".env("IEX_CLOUD_KEY");
    }


    public function fetchCompany($symbol)
    {
        return json_decode(Http::get("{$this->url}stock/{$symbol}/company{$this->token}"));
    }

    # stock/$symbol/book
# stock/$symbol/price
# stock/$symbol/company
# stock/$symbol/ohlc
# stock/$symbol/logo
# status
}

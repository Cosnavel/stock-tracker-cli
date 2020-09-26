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
        $this->url = env('IEX_CLOUD_URL');
        $this->token = '?token='.env('IEX_CLOUD_KEY');
    }

    public function fetchCompany($symbol)
    {
        return json_decode(Http::get("{$this->url}stock/{$symbol}/company{$this->token}"));
    }

    public function fetchPrice($symbol)
    {
        return json_decode(Http::get("{$this->url}stock/{$symbol}/quote/latestPrice{$this->token}"));
    }

    public function fetchQuote($symbol)
    {
        return json_decode(Http::get("{$this->url}stock/{$symbol}/quote{$this->token}"));
    }

    public function fetchStatus()
    {
        return json_decode(Http::get("{$this->url}status{$this->token}"));
    }
}

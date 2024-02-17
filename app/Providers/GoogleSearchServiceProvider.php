<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class GoogleSearchServiceProvider extends ServiceProvider
{
    protected $client;
    protected $apiKey;
    protected $searchEngineId;

    public function __construct()
    {
        $this->client = new Http();
        $this->apiKey = env('GOOGLE_API_KEY');
        $this->searchEngineId = env('GOOGLE_SEARCH_ENGINE_ID');
    }

    public function search($query, $suffix)
    {

        $response = Http::get('https://www.googleapis.com/customsearch/v1', [
            'key' => $this->apiKey,
            'cx' => $this->searchEngineId,
            'q' => $query . $suffix,
            'searchType' => 'image',
        ]);

        return $response->collect()->get('items');
    }
}

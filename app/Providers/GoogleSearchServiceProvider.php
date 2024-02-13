<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class GoogleSearchServiceProvider extends ServiceProvider
{
    protected $client;
    protected $apiKey;
    protected $searchEngineId;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('GOOGLE_API_KEY');
        $this->searchEngineId = env('GOOGLE_SEARCH_ENGINE_ID');
    }

    public function search($query, $suffix)
    {
        $response = $this->client->request('GET', 'https://www.googleapis.com/customsearch/v1', [
            'query' => [
                'key' => $this->apiKey,
                'cx' => $this->searchEngineId,
                'q' => $query . $suffix,
                'searchType' => 'image'
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}

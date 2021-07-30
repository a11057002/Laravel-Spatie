<?php

namespace App\Services;

use GuzzleHttp\Client;

class ShortUrlService
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function makeShortUrl($url)
    {
        $token = "20f07f91f3303b2f66ab6f61698d977d69b83d64";
        $data = [
            'url' => $url,
        ];
        $res = $this->client->request(
            'POST',
            "https://api.pics.ee/v1/links?access_token=$token",
            [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode($data)
            ]
        );

        return json_decode(($res->getBody()->getContents()))->data->picseeUrl;
    }
}

<?php

namespace Jra\Http;

class Client {

    /** @var \GuzzleHttp\Client */
    private $client;

    public function __construct() {
        $url = 'http://www.jra.go.jp';
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $url,
        ]);
    }

    public function get($cname) {
        return $this->client->post('/JRADB/accessS.html', [
            'form_params' => [
                'cname' => $cname,
            ],
        ]);
    }
}

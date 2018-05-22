<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://www.jra.go.jp',
]);
$response = $client->get('/');

$document = new \DOMDocument();
@$document->loadHTML($response->getBody()->getContents());
$xpath = new \DOMXPath($document);
$nodes = $xpath->query('//div[@class="race"]//a');

foreach($nodes as $node) {
    echo $node->nodeValue . "\t" . $node->getAttribute('href') . PHP_EOL;
}

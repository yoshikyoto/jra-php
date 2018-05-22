<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Jra\Http\Client;
use Jra\Html\Parser;

// error_reporting(E_ERROR);

$cname = isset($_GET['cname']) ? $_GET['cname'] : 'pw01sli00/AF';

$client = new Client();
$response = $client->get($cname);
$html = $response->getBody()->getContents();

$parser = new Parser();
$parser->parse($html);
var_dump($parser->getResult());

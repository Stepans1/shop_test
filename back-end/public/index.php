<?php



header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
//header('Content-Type: json/application');

require_once('../vendor/autoload.php');

$API = new \App\API();

$API->start();

<?php


use App\Application;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
require_once __DIR__ . '/../vendor/autoload.php';

const ROUTE = "/sand_box/public";


$app=new Application();
$app->run();



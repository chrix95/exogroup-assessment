<?php
require "../bootstrap.php";
use Src\Controller\ABTestController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// everything else results in a 404 Not Found
if ($uri[1] !== 'ab_test') {
    header("HTTP/1.1 404 Not Found");
    echo "Entry URL is '/ab_test'";
    exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$queries = array();
if (isset($_SERVER["QUERY_STRING"])) {
    parse_str($_SERVER['QUERY_STRING'], $queries);
}

// pass the request method and user ID to the PersonController and process the HTTP request:
$controller = new ABTestController($requestMethod, $queries);
$controller->processRequest();

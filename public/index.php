<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Url;
use Phalcon\Http\Request;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
const APP_PATH = BASE_PATH . '/app';

// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/config/',
        APP_PATH . '/exceptions/',
        APP_PATH . '/controllers/'
    ]
);

$loader->registerNamespaces(
    [
        'robledocampos\api_request\services' => BASE_PATH . '/vendor/robledocampos/api-request/app/services/',
        'robledocampos\api_response\services' => BASE_PATH . '/vendor/robledocampos/api-response/app/services/',
    ]
);

$loader->register();

$container = new FactoryDefault();

$container->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

$container->set('view', function () {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');
    return $view;
});

$application = new Application($container);

$container->set('router', function() {
    $routesBuilder = new RoutesBuilder();

    return $routesBuilder->getRoutes();
});

try {
    // Handle the request
    $uri = $_SERVER['QUERY_STRING'] ? explode("=", $_SERVER['QUERY_STRING'])[1] : "/";
    $response = $application->handle($uri);
    $response->send();
} catch (Exception $e) {
    echo $e->getMessage();
}

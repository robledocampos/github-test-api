<?php

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group as RouterGroup;


class RoutesBuilder
{

    function initialize()
    {
    }

    function getRoutes()
    {
        $router = new Router(false);

        $github = new RouterGroup(['controller' => 'github']);
        $github->add('/users/{username}(/)?', ['action' => "getUser"])->via(["GET"]);
        $github->add('/users-opt/{username}(/)?', ['action' => "optUser"])->via(["GET"]);
        $router->mount($github);

        return $router;
    }
}
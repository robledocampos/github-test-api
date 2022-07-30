<?php

use Phalcon\Mvc\Controller;
use robledocampos\api_request\services\RequestService;
use robledocampos\api_response\services\ResponseService;

class BaseController extends Controller
{

    protected RequestService $request;
    protected ResponseService $response;

    public function build(string $basePath)
    {
        $this->request = new RequestService($basePath);
        $this->response = new ResponseService();
    }
}

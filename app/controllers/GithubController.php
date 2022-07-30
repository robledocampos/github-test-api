<?php

use Phalcon\Mvc\Controller;


class GithubController extends BaseController
{

    public function initialize()
    {
        parent::build("https://api.github.com");
        $this->request->setHeaders(["User-Agent: testing"]);
    }

    public function getUserAction(string $userName)
    {
        $this->request->setEndpoint("/users/".$userName."/repos");
        $this->request->setQueryString(["per_page" => 5]);
        $apiResponse = $this->request->make();

        return $this->response->buildWithJson($apiResponse['body'], $apiResponse['status_code']);
    }
}

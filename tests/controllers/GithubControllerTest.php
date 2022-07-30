<?php

use PHPUnit\Framework\TestCase;

class GithubControllerTest extends TestCase
{
    private GuzzleHttp\Client $http;

    function setUp() : void
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost']);
    }

    function testGetUser()
    {
        $response = $this->http->request("GET", "/playground/github/users/defunkt");
        $this->assertEquals(200, $response->getStatusCode());
        $payload = json_decode($response->getBody()->getContents());
        print_r($payload);
        //$this->assertEquals("defunkt", $payload->login);
    }
}

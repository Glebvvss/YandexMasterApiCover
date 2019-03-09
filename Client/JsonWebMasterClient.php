<?php 

namespace ApiYandexWebmaster\Client;

use ApiYandexWebmaster\Request\RequestBuilder;
use ApiYandexWebmaster\Response\Response;

class JsonWebMasterClient extends AbstractWebMasterClient
{
    public function __construct($token, $baseUrl = null) 
    {
        parent::__construct($token, $baseUrl = null);
    }

    public function turnTo($resourseName) 
    {
        return $this->request
                    ->resourse($this->baseUrl.$this->substituteUserIdToResourseName($resourseName))
                    ->header('Authorization: OAuth '.$this->token);
    }

    public function prepare($response)
    {
        $response = json_decode($response);
        return new Response($response);
    }
}
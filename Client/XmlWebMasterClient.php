<?php 

namespace ApiYandexWebmaster\Client;

use ApiYandexWebmaster\Request\RequestBuilder;

class XmlWebMasterClient extends AbstractWebMasterClient
{
    public function __construct($token, $baseUrl = null) 
    {
        parent::__construct($token, $baseUrl = null);
    }

    public function turnTo($resourseName) 
    {
        return $this->request
                    ->resourse($this->baseUrl.$this->substituteUserIdToResourseName($resourseName))
                    ->header('Authorization: OAuth '.$this->token)
                    ->header('Accept: application/xml');
    }
}
<?php 

namespace YandexWebmasterCover\Api;

use YandexWebmasterCover\Request\RequestBuilder;

class JsonWebMasterApi extends AbstractWebMasterApi
{
    public function __construct($token, $baseUrl = null) 
    {
        parent::__construct($token, $baseUrl = null);
    }

    public function turnTo($resourseName, $routeParams = []) 
    {
        return $this->request
                    ->resourse($this->baseUrl.$this->substituteUserIdToResourseName($resourseName))
                    ->header('Authorization: OAuth '.$this->token);
    }
}
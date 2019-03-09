<?php

namespace ApiYandexWebmaster;

use ApiYandexWebmaster\Client\JsonWebMasterClient;
use ApiYandexWebmaster\Client\XmlWebMasterClient;

class WebMasterFactory
{
    const JSON_API = 'JSON';
    const XML_API  = 'XML';

    public function fetch($token, $type = 'JSON')
    {
        $type = strtoupper($type);

        if ($type === static::JSON_API) {
            return new JsonWebMasterClient($token);
        }

        if ($type === static::XML_API) {
            return new XmlWebMasterClient($token);
        }

        throw new \Exception('Incorrect type of Web Master Api Format');
    }
}
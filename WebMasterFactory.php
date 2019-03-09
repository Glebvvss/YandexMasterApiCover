<?php

namespace YandexWebmasterCover;

use YandexWebmasterCover\Api\JsonWebMasterApi;
use YandexWebmasterCover\Api\XmlWebMasterApi;

class WebMasterFactory
{
    const JSON_API = 'JSON';
    const XML_API  = 'XML';

    public function fetch($token, $type = 'JSON')
    {
        $type = strtoupper($type);

        if ($type === static::JSON_API) {
            return new JsonWebMasterApi($token);
        }

        if ($type === static::XML_API) {
            return new XmlWebMasterApi($token);
        }

        throw new \Exception('Incorrect type of Web Master Api Format');
    }
}
<?php 

namespace ApiYandexWebmaster\Request;

class RequestBuilder implements IRequestBuilder
{
    const GET    = 'GET';
    const POST   = 'POST';
    const PUT    = 'PUT';
    const DELETE = 'DELETE';

    public $resourse;
    public $replacements = [];
    public $headers = [];
    public $method;
    public $body;

    public function resourse($resourse)
    {
        $this->resourse = $resourse;
        return $this;
    }

    public function replacement($pattern, $value)
    {
        $this->replacements[$pattern] = $value;
        return $this;
    }

    public function replacements($replacements)
    {
        foreach($replacements as $pattern => $replacement) {
            $this->headers[$pattern] = $replacement;
        }
        return $this;
    }

    public function method($method)
    {
        $this->method = $method;
        return $this;
    }

    public function header($header)
    {
        $this->headers[] = $header;
        return $this;
    }

    public function headers($headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function body($body)
    {
        $this->body = $body;
        return $this;
    }

    public function build()
    {
        return new Request($this);
    }

    public function __call($classMethod, $params)
    {
        $request = $this->build();
        return $request->$classMethod();
    }
}
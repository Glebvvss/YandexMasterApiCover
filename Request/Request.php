<?php 

namespace YandexWebmasterCover\Request;

class Request implements IRequest
{
	private $resourse;
	private $method;
	private $headers;
	private $body;


	public function __construct($requestBuilder)
	{
		$this->resourse  =  $this->generateResourseNameWithReplacements(
								$requestBuilder->resourse, 
								$requestBuilder->replacements
							);

		$this->method = strtoupper(trim($requestBuilder->method));

		if (! empty($requestBuilder->headers)) {
			$this->headers = $requestBuilder->headers;
		}

		if (is_array($requestBuilder->body) || is_object($requestBuilder->body)) {
			$this->body = $this->parseBodyToQueryString($requestBuilder->body);
		} else {
			$this->body = $requestBuilder->body;
		}
	}


	public function send()
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->resourse);

		if (! empty($this->headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		}

		if ($this->method === 'POST') {
			curl_setopt($ch, CURLOPT_POST, 1);
		}
		elseif ($this->method !== NULL) {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);	
		}

		if (! empty($this->body)) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		curl_close ($ch);

		return $response;
	}

	private function parseBodyToQueryString($body)
	{
		$parsedBody = '';

		foreach($body as $paramName => $paramValue) {
			$parsedBody .= $paramName.'='.$paramValue.'&';
		}

		return substr($parsedBody, 0, -1);
	}

	private function generateResourseNameWithReplacements($resourseName, $replacements)
	{
		if (empty($replacements)) {
			return $resourseName;
		}

		foreach($replacements as $pattern => $replacement) {
			$resourseName = preg_replace('/\{'.addslashes($pattern).'\}/', $replacement, $resourseName);
		}

		return $resourseName;
	}
}
<?php 

namespace ApiYandexWebmaster\Response;

class Response implements IResponse
{
	private const NO_ERRORS       = 'No Errors!'
	private const INVALID_REQUEST = 'Request is invalid!';

	private $data;
	private $errorCode;
	private $errorMessage;

	public function __construct($objectResponse)
	{
		if (! is_object($objectResponse)) {
			$objectResponse = (object) $objectResponse;
		}

		if (! empty($objectResponse->error_code)) {
			$this->errorCode = $objectResponse->error_code;
		}

		if (! empty($objectResponse->error_message)) {
			$this->errorMessage = $objectResponse->error_message;
		}
	}

	public function getData()
	{
		if ($this->checkErrors()) {
			return static::INVALID_REQUEST;
		}

		return $this->data;
	}

	public function checkErrors()
	{
		if (isset($this->error_code)) {
			return true;
		}

		return false;
	}

	public function getErrorMessage()
	{
		if (! $this->checkErrors()) {
			return static::NO_ERRORS;
		}

		return $this->errorMessage;
	}

	public function getErrorCode()
	{
		if (! $this->checkErrors()) {
			return static::NO_ERRORS;
		}

		return $this->errorCode;
	}
}
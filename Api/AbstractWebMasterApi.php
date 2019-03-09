<?php 

namespace YandexWebmasterCover\Api;

use YandexWebmasterCover\Request\RequestBuilder;

abstract class AbstractWebMasterApi
{
	protected $baseUrl = 'https://api.webmaster.yandex.net/v4';
	protected $userId;
	protected $token;

	public  $request;

	public function __construct($token, $baseUrl = null) 
	{
		if ($baseUrl != null) {
			$this->baseUrl = $baseUrl;
		}

		$this->token   = $token;
		$this->request = new RequestBuilder();
		$this->userId  = $this->getUserId();
	}

	private function getUserId() 
	{
		$response = $this->request
						 ->resourse($this->baseUrl.'/user/')
				   		 ->header('Authorization: OAuth '.$this->token)
				   		 ->method('GET')
				   		 ->send();

		$result = json_decode($response);
		return $result->user_id;
	}

	protected function substituteUserIdToResourseName($resourseName)
	{
		return preg_replace('/\{user-id\}/', $this->userId, $resourseName);
	}

	/**
	 * Обращаемся к необходимому ресурсу API:
	 * https://tech.yandex.ru/webmaster/doc/dg/concepts/getting-started-docpage/
	 *
	 * В качестве аргумента {$resourseName} указываем текст URI из таблицы по ссылке выше
	 * Например: /user/{user-id}/hosts/{host-id}/
	 *
	 * Важное замечание! Подставлять значение id пользовалеля полученного на основе токена 
	 * вместо {user-id} нет нужды, оно автоматически заменится при обращении к ресурсу.
	 *
	 * @param string
	 * 
	 * @return \WebmasterAPI\Request\RequestBuilder
	 */
	abstract public function turnTo($resourseName, $routeParams = []);
}
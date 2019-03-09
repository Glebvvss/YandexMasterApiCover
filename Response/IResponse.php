<?php 

namespace ApiYandexWebmaster\Response;

interface IResponse
{
	/**
	 * Получить тело ответа запроса в виде объекта.
	 *
	 * В случае неудачного запроса возвращается строка с оповещение, 
	 * что запрос прошел неудачно.
	 *
	 * @return object|string
	 */
	public function getData()

	/**
	 * Проверить успешен ли был запрос.
	 *
	 * @return bool
	 */
	public function checkErrors();

	/**
	 * Получить сообщение об ошибке в запросе или оповещение, что ошибок нет.
	 *
	 * @return string
	 */
	public function getErrorMessage();

	/**
	 * Получить код ошибки в запросе или оповещение, что ошибок нет.
	 *
	 * @return string
	 */
	public function getErrorCode();
}
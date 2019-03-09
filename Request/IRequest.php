<?php 

namespace YandexWebmasterCover\Request;

interface IRequest
{
	/**
	 * Метод нициализации запроса и получения ответа
	 *
	 * @return string
	 */
	public function send();
}
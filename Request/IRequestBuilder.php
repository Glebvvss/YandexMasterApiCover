<?php 

namespace YandexWebmasterCover\Request;

interface IRequestBuilder
{
    /**
     * Указываем имя ресурса к которому обращаемся.
     * Допустимо использовать заменяемые параметры следующего синтаксиса:
     * {variable} - заменится на значение переданное в методax replacement или replacements
     *
     * @param string
     *
     * @return void
     */
    public function resourse($resourse);

    /**
     * Задаем единичный параметр для подмены в имени ресурса
     *
     * Важное замечание! Указывать имя подменяемого параметра необходимо без фигурных скобов.
     *
     * @param string
     * @param mixed
     *
     * @return void
     */
    public function replacement($pattern, $value);

    /**
     * Задаем группу параметров для подмены в имени ресурса
     *
     * Важное замечание! Указывать имя подменяемого параметра необходимо без фигурных скобок
     * и в качестве ключа асоциативного массива.
     *
     * @param array
     *
     * @return void
     */
    public function replacements($replacements);

    /**
     * Указываем метод запроса
     *
     * @param string
     *
     * @return void
     */
    public function method($method);

    /**
     * Задание единичного заголовка запроса и добавление его к уже существующим
     *
     * @param string
     *
     * @return void
     */
    public function header($header);

    /**
     * Задание группы заголовков запроса и добавление к уже существующим
     *
     * @param array
     *
     * @return void
     */
    public function headers($headers);

    /**
     * Заполнение тела запроса
     *
     * @param mixed
     *
     * @return void
     */
    public function body($body);

    /**
     * Создание и возвращение экземпляра класса запроса
     *
     * @return \YandexWebmasterCover\Request\Request
     */
    public function build();

    /**
     * Инициализация экземпляра класса запроса при необходимости и вызов указанного метода
     *
     * @param string
     * @param array
     * 
     * @return mixed
     */
    public function __call($classMethod, $params);
}
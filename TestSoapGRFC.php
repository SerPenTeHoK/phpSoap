<?php

/**
 * Created by PhpStorm.
 * User: Sergey Gusarov
 * Date: 20.04.2016
 * Time: 23:50
 */
class RequestIdentifier

{
    var $request_id;
    var $request_type;
    var $request_description;
}


class getRequestState
{
    var $requestIdentifier;
}

echo 'openssl: ', extension_loaded('openssl') ? 'openssl подключен.' : 'Включите расширение openssl.', "\n";

// Регистрационные данные
$username = "";
$password = "";

$options = array(
    'login' => $username,
    'password' => $password,
    'trace' => true,
    'exceptions' => 0,
    'cache_wsdl' => WSDL_CACHE_NONE, //WSDL_CACHE_MEMORY, //, WSDL_CACHE_NONE, WSDL_CACHE_DISK or WSDL_CACHE_BOTH
    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
    'soap_version' => SOAP_1_1,
    "encoding" => "utf-8"
);

try {
    $wsdl = "https://test.grfc.ru/services/InputRequestService?wsdl";
    $client = new SoapClient($wsdl, $options);

    // Вывод всех типов
    var_dump($client->__getTypes());
    // Вывод всех функций
    var_dump($client->__getFunctions());

    // Заполнение объектов
    $objRequestIdentifier = new RequestIdentifier;
    $objRequestIdentifier->request_id = 124; // если посмотреть в xsd-схему, то другие поля обозначены minOccurs="0"
    $objgetRequestState = new getRequestState;
    $objgetRequestState->requestIdentifier = $objRequestIdentifier;

    // Запрос
    $results = $client->getRequestState($objgetRequestState);

    // Результат запроса
    var_dump($results);

} catch (SoapFault $e) {
    echo 'Ошибка подключения или внутренняя ошибка сервера.: [' . $e->faultcode . '] - ' . $e->faultstring;
}

?>
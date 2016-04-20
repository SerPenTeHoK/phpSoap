<?php
/**
 * Created by PhpStorm.
 * User: SerP
 * Date: 20.04.2016
 * Time: 21:27
 */
echo 'openssl: ',  extension_loaded  ('openssl') ? 'yes':'no', "\n";
/*
echo 'http wrapper: ', in_array('http', $w) ? 'yes':'no', "\n";
echo 'https wrapper: ', in_array('https', $w) ? 'yes':'no', "\n";
echo 'wrappers: ', var_dump($w);
*/
/*
$functions = get_extension_funcs('soap');
echo "Functions available in the test extension:<br>\n";
foreach($functions as $func) {
    echo $func . "\n";
}
*/

$username = "";
$password = "";

$options = array(
    'login' => $username,
    'password' => $password,
    'trace' => true,
    'exceptions' => 0,
    'cache_wsdl'     => WSDL_CACHE_NONE, //WSDL_CACHE_MEMORY, //, WSDL_CACHE_NONE, WSDL_CACHE_DISK or WSDL_CACHE_BOTH
    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
    //'soap_version'   => SOAP_1_2
    "encoding" => "utf-8"
);

try {
    $wsdl = "https://test.grfc.ru/services/InputRequestService?wsdl";

    $client = new SoapClient($wsdl, $options);

    /*
    var_dump($client);
    $methods = get_class_methods($client);
    var_dump($methods);
*/

    $req_params1 = array( 'request_id' => 123);
    //$req_params2 = array('RequestIdentifier' => array('request_id' => 1234, 'request_type' => '', 'request_description'=>'' ));
    $req_params2 = array('RequestIdentifier' => array('request_id' => 1234 ));
    $req_params2 = array('RequestIdentifier' => array('request_id' => array("_" => "123")));
    $rp0 = array('request_id' => 1);
    $rp1 = array('RequestIdentifier' => $rp0);
    $rp2 = array('<RequestIdentifier><request_id>1</request_id></RequestIdentifier>');
    $rp2 = array('<RequestIdentifier><request_id>1</request_id></RequestIdentifier>');

    $par  = array
    (
        'RequestIdentifier' => array(
            'request_id' =>
                "1234"

        )
    );

    //var_dump($par);

    //$par = array('parameters' => $par);

    //$result = $client->__soapCall('getRequestState', $req_params);
    //$result = $client->getRequestState(array('request_id'=> 123456));
    //$result = $client->getRequestState(array('request_id'=> 123456));
    //$result = $client->__doRequest();

    //$result = $client->getRequestState( $req_params2 );
    //$result = $client->__soapCall('getRequestState', $req_params2);
    //$result = $client->__soapCall('getRequestState', $rp1);
    //$result = $client->__soapCall('getRequestState', $par);


    // Вывод всех
    //var_dump($client->__getTypes());
    //var_dump($client->__getFunctions());
    /*
        $query=" <soap:Envelope xmlns:soap=\"http://www.w3.org/2003/05/soap-envelope\" xmlns:req=\"http://request.services\">
           <soap:Header/>
           <soap:Body>
              <req:getRequestState>
                 <RequestIdentifier>
                    <request_id>1</request_id>
                 </RequestIdentifier>
              </req:getRequestState>
           </soap:Body>
         </soap:Envelope>
        ";
    */
    //$par5['RequestIdentifier'] = array('request_id' => 123);
    $par6 = array(
        'RequestIdentifier' => array(
            'request_id' => 123
        )
    );
    if ($client->_soap_version == 1) {
        $par6 = array($par6);
    }

    $result = $client->__soapCall('getRequestState',$par6);

    //var_dump($result);

    echo $result;

    //echo $client->__soapCall('getRequestState', array('RequestIdentifier' => array('request_id' => 1234)));

}
catch (SoapFault $e) {
    echo 'Ошибка подключения или внутренняя ошибка сервера.: [' . $e->faultcode . '] - ' . $e->faultstring;
}


?>
<?php
//Create the client object
$soapclient = new SoapClient('http://www.webservicex.net/globalweather.asmx?WSDL');

//Use the functions of the client, the params of the function are in 
//the associative array
$params = array('CountryName' => 'Spain', 'CityName' => 'Alicante');
var_dump($soapclient->__getFunctions()); 
echo 'Get Types<br />';
var_dump($soapclient->__getTypes());
//echo 'Get Functions<br />';
$response = $soapclient->getWeather($params);
 
echo '<br />Call Service<br />';


var_dump($response);
echo '<br /><br />';

$trace = true;
$exceptions = true;

$client = new SoapClient("http://www.webservicex.net/stockquote.asmx?WSDL",array('trace' => $trace, 'exceptions' => $exceptions));
echo 'Get Functions<br />';
var_dump($client->__getFunctions()); 
echo 'Get Types<br />';
var_dump($client->__getTypes()); 
echo '<br />Call Service<br />';
$parameters=array('symbol' => 'WDAY');


$response=$client->GetQuote($parameters);
if (is_soap_fault($response)) {
    
    trigger_error("SOAP Fault: (faultcode: {$response->faultcode}, faultstring: {$response  ->faultstring})", E_USER_ERROR);
}
//echo '<br /><br />Last response: '. $client->__getLastResponse();

echo 'Response<br />';

//echo 'Last Amount - '.$response['GetQuoteResult']->Stock->Last.'<br /><br />';
//$response= get_object_vars($response);
//echo 'Last - '.$response['GetQuoteResult'].'<br />';

$xml=simplexml_load_string($response->GetQuoteResult);
print_r($xml);
echo '<br /><br />';
echo $xml->Stock->Symbol.'<br />';
echo $xml->Stock->Last;
?>
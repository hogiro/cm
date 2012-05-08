<?php
/**
 * Configuration file for Openx library 
 * author => alex michaud (alex.michaud@gmail.com)
 * 
*/
/*
if (!@include('XML/RPC.php')) {
	die ('Error: cannot load the PEAR XML_RPC class');
}
//include_once('openx-api-v2-xmlrpc.inc.php');

$host = "ads.notfix.de";
$basepath = "/www/api/v1/xmlrpc";
$username = "admin";
$password = "deneme123";

 $xmlTest = new OA_Api_Xmlrpc($host, $basepath, $username, $password, $port = 0, $ssl = false, $timeout = 15);


function returnXmlRpcResponseData($oResponse){
	
	if (!$oResponse->faultCode()){
		$oVal = $oResponse->value();
		$data = XML_RPC_decode($oVal);
		return $data;
	} else {
		die ('Fault Code: '. $oResponse->faultCode()."\n".
				'Fault Reason: '. $oResponse->faultString() . "\n");
	}
}

$aParams = array(
					new XML_RPC_Value ($username, 'string'),
					new XML_RPC_Value ($password, 'string')
				);
$oMessage = new XML_RPC_Message('logon', $aParams);
$oClient = new XML_RPC_Client($logonXmlRpcWebServiceUrl, $xmlRpcHost);
$oResponse = $oClient->send($oMessage);
if (!$oResponse) {
	die('Communication error: ' . $oClient->errstr);
}
$sessionId = returnXmlRpcResponseData ($oResponse);
echo 'User logged on with session Id: '. $sessionId . '<br \>';


$aParams   = array(new XML_RPC_Value($sessionId, 'string'));
$oMessage  = new XML_RPC_Message('logoff', $aParams);
$oClient   = new XML_RPC_Client($logonXmlRpcWebServiceUrl, $xmlRpcHost);
$oResponse = $oClient->send($oMessage);
echo 'User with session Id : ' . $sessionId . ' logged off<br>';


*/

require_once 'XML/RPC2/Client.php';
$oxLogin = array("username"=>"admin","password"=>"deneme123");
$opts = array('prefix' => 'ox.');
$advertiserId = 13;
 
$client = XML_RPC2_Client::create('http://ads.notfix.de/www/api/v2/xmlrpc/', $opts);

try {
 
    $sessionId = $client->logon($oxLogin['username'],$oxLogin['password']);
 	echo $sessionId;
    $result = $client->getAdvertiser($sessionId,$advertiserId);
    print_r($result);
 	
    $result = $client->advertiserDailyStatistics($sessionId,$advertiserId);
    print_r($result);
 
 
 
    $client->logoff($sessionId);
 
} catch (XML_RPC2_FaultException $e) {
 
    // The XMLRPC server returns a XMLRPC error
    die('Exception #' . $e->getFaultCode() . ' : ' . $e->getFaultString());
 
} catch (Exception $e) {
 
    // Other errors (HTTP or networking problems...)
    die('Exception : ' . $e->getMessage());
 
}
?>
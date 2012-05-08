<?php
if (!@include('XML/RPC.php')) {
    die('Error: cannot load the PEAR XML_RPC class');
}
$xmlRpcHost = 'http://ads.notfix.de';
$webXmlRpcDir = '/www/api/v2/xmlrpc/';
$serviceUrl = $webXmlRpcDir;
$username = 'admin';
$password = 'deneme123';

$debug = true;

$advertiserId = 25;
$agencyId = 1;
$accountId = 29;
$campaignId = 97;


function returnXmlRpcResponseData($oResponse)
{
    if (!$oResponse->faultCode()) {
        $oVal = $oResponse->value();
        $data = XML_RPC_decode($oVal);
        return $data;
    } else {
        die('Fault Code: ' . $oResponse->faultCode() . "\n" .
         'Fault Reason: ' . $oResponse->faultString() . "\n");
    }
}

$oClient = new XML_RPC_Client($serviceUrl, $xmlRpcHost);
$oClient->setdebug($debug);


// Logon
$aParams = array(
    new XML_RPC_Value($username, 'string'),
    new XML_RPC_Value($password, 'string')
);
$oMessage  = new XML_RPC_Message('ox.logon', $aParams);
$oResponse = $oClient->send($oMessage);
if (!$oResponse) {
    die('Communication error: ' . $oClient->errstr);
}
$sessionId = returnXmlRpcResponseData($oResponse);
echo '*** User logged on with session Id : ' . $sessionId . "<br>\n";


// Get an advertiser
/*
$aParams = array(
    new XML_RPC_Value($sessionId, 'string'),
    new XML_RPC_Value($advertiserId, 'int')
);

print_r ($aParams);
$oMessage = New XML_RPC_Message('ox.getAdvertiser', $aParams);
$oResponse = $oClient->send($oMessage);
print_r(returnXmlRpcResponseData($oResponse));
*/
$campaignParams = array (
new XML_RPC_Value($sessionId, 'string'),
				(new XML_RPC_Value( array(
                        "advertiserId"=> new XML_RPC_Value($advertiserId, 'int'),
					//	"campaignId"=> new XML_RPC_Value($campaignId, 'int'),
                        "campaignName"=>new XML_RPC_Value("#DEVRIM".time(), 'string'),
						"revenueType"=> new XML_RPC_Value('CPM', 'string'),
                        "impressions"=> new XML_RPC_Value(500, 'int'),
						"priority"=> new XML_RPC_Value(10, 'int'),
						"weight"=> new XML_RPC_Value(0, 'int'),
						"startDate"=> new XML_RPC_Value("20120501T00:00:00", 'dateTime.iso8601'),
						"endDate"=> new XML_RPC_Value("20120531T00:00:00", 'dateTime.iso8601')
					), 'struct'))
					
					
);
print_r ($campaignParams);
echo "<br/>\n";

$oMessage = New XML_RPC_Message('ox.addCampaign', $campaignParams);
$oResponse = $oClient->send($oMessage);
print_r(returnXmlRpcResponseData($oResponse));

echo "<br/>\n";

// Logoff
$aParams = array(new XML_RPC_Value($sessionId, 'string'));
$oMessage = New XML_RPC_Message('ox.logoff', $aParams);
$oResponse = $oClient->send($oMessage);
echo "*** User with session Id : $sessionId logged off<br>\n";

?>
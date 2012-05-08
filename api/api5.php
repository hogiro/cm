<?php

echo 'test1';

include ('openx-api-v2-xmlrpc.inc.php');

$xmlRpcHost = 'http://ads.notfix.de';
$webXmlRpcDir = '/www/api/v2/xmlrpc/';
$serviceUrl = $webXmlRpcDir;
$username = 'admin';
$password = 'deneme123';

$advertiserId = 25;
$agencyId = 1;
$accountId = 29;
$campaignId = 97;

echo 'test2';

$openx = new OA_Api_Xmlrpc($xmlRpcHost, $webXmlRpcDir, $username, $password);

echo ($openx->sessionId);

$campaignParams = new XML_RPC_Value( array(
                        "advertiserId"=> new XML_RPC_Value($advertiserId, 'int'),
					//	"campaignId"=> new XML_RPC_Value($campaignId, 'int'),
                        "campaignName"=>new XML_RPC_Value("#DEVRIM".time(), 'string'),
                        "impressions"=> new XML_RPC_Value(500, 'int'),
						"priority"=> new XML_RPC_Value(10, 'int'),
						"weight"=> new XML_RPC_Value(0, 'int'),
						"startDate"=> new XML_RPC_Value("20120501T00:00:00", 'dateTime.iso8601'),
						"endDate"=> new XML_RPC_Value("20120531T00:00:00", 'dateTime.iso8601')
					), 'struct'	
					
);

print_r ($openx->getAdvertiser($advertiserId));

print_r ($openx->addCampaign($campaignData));



echo 'test3';


?>
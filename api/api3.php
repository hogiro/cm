<?php
/* Include the XML_RPC2 library */
require_once 'XML/RPC2/Client.php';
 
/* Some basic presets */
$oxLogin = array("username"=>"admin","password"=>"deneme123");
$opts = array('prefix' => 'ox.');
 
$advertiserId = 25;
$agencyId = 1;
$accountId = 29;
$campaignId = 99;


/* Connect to the OpenX API*/ 
$client = XML_RPC2_Client::create('http://ads.notfix.de/www/api/v2/xmlrpc/', $opts);
try {
 
    /* Authenticate with the OpenX API and retrieve the sessionId required 
       for all other function calls */
    $sessionId = $client->logon($oxLogin['username'],$oxLogin['password']);
 
    /* Get advertiser info for $advertiserId */
    //$result = $client->getAdvertiser($sessionId,$advertiserId);
    //print_r($result);
 
 
    /* Create new advertiser for $accountId and $agencyId */
    $advertiserData = array(
                        "accountId"=> (int) $accountId,
                        "agencyId"=> (int) $agencyId,
                        "advertiserName"=>"Henry Fonda",
                        "contactName"=>"Mr. Fonda",
                        "emailAddress"=>"hfonda@hfondafoundation.com",
                        "comments"=>"VIP Client");
 
  //  $result = $client->addAdvertiser($sessionId,$advertiserData);
   // print_r($result);
 
    /* Delete advertiser $advertiserId */
   // $result = $client->deleteAdvertiser($sessionId,$advertiserId);
  //  print_r($result);
 
    /* Get advertiser daily stats for $advertiserId */
   // $result = $client->advertiserDailyStatistics($sessionId,$advertiserId);
    //print_r($result);
 	//echo "<br /><br />";
	// $json = json_encode($result);
	//echo $json;
	
	//$result = $client->campaignDailyStatistics($sessionId,$campaignId);
	//$json = json_encode($result);
	//echo $json;
//$startDate = new XML_RPC_Value(strtotime('01 05 2012'), 'dateTime.iso8601');
//$endDate = new XML_RPC_Value(strtotime('30 05 2012'), 'dateTime.iso8601');
//$startDate = new XML_RPC_Value("20111201T00:00:00", 'dateTime.iso8601');
//$endDate = new XML_RPC_Value("20120120T01:00:00", 'dateTime.iso8601');

//$startDate = XML_RPC2_Value::createFromNative("20120501T00:00:00", 'datetime');
//echo $startDate;

//print_r ($startDate);

 
$campaignData = XML_RPC2_Value::createFromNative( array(
                        "advertiserId"=> XML_RPC2_Value::createFromNative($advertiserId, 'int'),
					//	"campaignId"=> XML_RPC2_Value::createFromNative($campaignId, 'int'),
                        "campaignName"=>XML_RPC2_Value::createFromNative('#DEVRIM'.time(), 'string'),
                        "impressions"=> XML_RPC2_Value::createFromNative(500, 'int'),
						"priority"=> XML_RPC2_Value::createFromNative(10, 'int'),
						"weight"=> XML_RPC2_Value::createFromNative(0, 'int'),
						"revenueType"=> XML_RPC2_Value::createFromNative(1, 'int'),
						"startDate"=>XML_RPC2_Value::createFromNative("20120501T00:00:00", 'datetime'),
						"endDate"=> XML_RPC2_Value::createFromNative("20120531T00:00:00", 'datetime')
					), 'struct'	);
			
	 $result = $client->addCampaign($sessionId,$campaignData);
    print_r($result);
	


	//$startDate=new XML_RPC_Value("20111201T00:00:00", 'dateTime.iso8601');
	//$endDate=new XML_RPC_Value("20120120T01:00:00", 'dateTime.iso8601');
	
 	//$result=$client->advertiserCampaignStatistics($sessionId,$advertiserId,$startDate,$endDate);
 	//$print_r($result);
 
    $client->logoff($sessionId);
 
} catch (XML_RPC2_FaultException $e) {
 
    // The XMLRPC server returns a XMLRPC error
    die('Exception #' . $e->getFaultCode() . ' : ' . $e->getFaultString());
 
} catch (Exception $e) {
 
    // Other errors (HTTP or networking problems...)
    die('Exception : ' . $e->getMessage());
}
?>
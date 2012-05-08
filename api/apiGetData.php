<?php

//ob_start();

//require_once('lib/firephp/DirePHPCore/fb.php');



$advertiserId = intval($_REQUEST['advertiserId']);
//$campaignId = $_REQUEST['campaignId'];
//$bannerId = $_REQUEST['bannerId'];





/* Include the XML_RPC2 library */
require_once 'XML/RPC2/Client.php';
 
/* Some basic presets */
$oxLogin = array("username"=>"admin","password"=>"deneme123");
$opts = array('prefix' => 'ox.');
 
//$advertiserId = 20;
$agencyId = 1;
$accountId = 29;
 
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
    $result = $client->advertiserDailyStatistics($sessionId,$advertiserId);
    //print_r($result);
 	//echo "<br /><br />";
 	$objs = count($result);
	$impressions=0;
 	for($i=1;$i<=$objs;$i++){
 		$impressions +=$result[$i-1][impressions];
		
 	}
 
 	//$json = json_encode($result);
 	$json ='{"impressions":"'.$impressions.'"}';
	echo $json;

 
//	$startDate=new XML_RPC_Value("20111201T00:00:00", 'dateTime.iso8601');
//	$endDate=new XML_RPC_Value("20120120T01:00:00", 'dateTime.iso8601');
	
 	//$result=$client->advertiserCampaignStatistics($sessionId,$advertiserId,$startDate,$endDate);


 
    $client->logoff($sessionId);
 
} catch (XML_RPC2_FaultException $e) {
 
    // The XMLRPC server returns a XMLRPC error
    die('Exception #' . $e->getFaultCode() . ' : ' . $e->getFaultString());
 
} catch (Exception $e) {
 
    // Other errors (HTTP or networking problems...)
    die('Exception : ' . $e->getMessage());
}

?>
<?php 
//include the information needed for the connection to MySQL data base server. 
// we store here username, database and password 
include("dbconfig.php");

// to the url parameter are added 4 parameters as described in colModel
// we should get these parameters to construct the needed query
// Since we specify in the options of the grid that we will use a GET method 
// we should use the appropriate command to obtain the parameters. 
// In our case this is $_GET. If we specify that we want to use post 
// we should use $_POST. Maybe the better way is to use $_REQUEST, which
// contain both the GET and POST variables. For more information refer to php documentation.
// Get the requested page. By default grid sets this to 1. 
$page = $_GET['page']; 
 
// get how many rows we want to have into the grid - rowNum parameter in the grid 
$limit = $_GET['rows']; 
 
// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel 
$sidx = $_GET['sidx']; 
 
// sorting order - at first time sortorder 
$sord = $_GET['sord']; 



// if we not pass at first time index use the first column for the index or what you want
if(!$sidx) $sidx =1; 

/*
include 'source/class.writefile.php';
$wf = new writefile();

$filters=json_decode($_GET['filters']);

$wf->write($filters->groupOp);
$wf->write(" | ");
$wf->write($filters->rules[0]->);
*/
$wh = "WHERE 1=1";
/*
$searchOn = Strip($_REQUEST['_search']);

if($searchOn=='true') {
	$sarr = Strip($_REQUEST);
	foreach( $sarr as $k=>$v) {
		switch ($k) {
			case 'name':
				$wh .= " AND ".$k." LIKE '".$v."%'";
				break;
		}
	}
}
//echo $wh;
*/
/*
 if($searchOn=='true') {
$searchstr = Strip($_REQUEST['filters']);
$wf->write($searchstr);
//$where= constructWhere($searchstr);
//$wf->write($where);
}

function constructWhere($s){
$qwery = "";
//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
$qopers = array(
'eq'=>" = ",
'ne'=>" <> ",
'lt'=>" < ",
'le'=>" <= ",
'gt'=>" > ",
'ge'=>" >= ",
'bw'=>" LIKE ",
'bn'=>" NOT LIKE ",
'in'=>" IN ",
'ni'=>" NOT IN ",
'ew'=>" LIKE ",
'en'=>" NOT LIKE ",
'cn'=>" LIKE " ,
'nc'=>" NOT LIKE " );
if ($s) {
$jsona = json_decode($s,true);
if(is_array($jsona)){
$gopr = $jsona['groupOp'];
$rules = $jsona['rules'];
$i =0;
foreach($rules as $key=>$val) {
$field = $val['field'];
$op = $val['op'];
$v = $val['data'];
if($v && $op) {
$i++;
// ToSql in this case is absolutley needed
$v = ToSql($field,$op,$v);
if ($i == 1) $qwery = " AND ";
else $qwery .= " " .$gopr." ";
switch ($op) {
// in need other thing
case 'in' :
case 'ni' :
$qwery .= $field.$qopers[$op]." (".$v.")";
break;
default:
$qwery .= $field.$qopers[$op].$v;
}
}
}
}
}
return $qwery;
}
*/


$totalrows = isset($_REQUEST['totalrows']) ? $_REQUEST['totalrows']: false;
if($totalrows) {
	$limit = $totalrows;
}
 
// connect to the MySQL database server 
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); 
 
// select the database 
mysql_select_db($database) or die("Error connecting to db."); 
 
// calculate the number of rows for the query. We need this for paging the result 
$result = mysql_query("SELECT COUNT(*) AS count FROM campaign"); 
$row = mysql_fetch_array($result,MYSQL_ASSOC); 
$count = $row['count']; 
 
// calculate the total pages for the query 
if( $count > 0 && $limit > 0) { 
              $total_pages = ceil($count/$limit); 
} else { 
              $total_pages = 0; 
} 
 
// if for some reasons the requested page is greater than the total 
// set the requested page to total page 
if ($page > $total_pages) $page=$total_pages;
 
// calculate the starting position of the rows 
$start = $limit*$page - $limit;
 
// if for some reasons start position is negative set it to 0 
// typical case is that the user type 0 for the requested page 
if($start <0) $start = 0; 
 
// the actual query for the grid data 
$SQL = "SELECT campaign_id, case when CURDATE() < startDate then 1 when CURDATE()>endDate then 2 else 0 end AS state, name, startDate, endDate  FROM campaign ".$wh." ORDER BY $sidx $sord LIMIT $start , $limit"; 
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 
 
// we should set the appropriate header information. Do not forget this.

/*
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row['campaign_id'];
	$responce->rows[$i]['cell']=array($row['campaign_id'],$row['name']);
	$i++;
}
echo json_encode($responce);
*/


$json = '';
$json .= '{';
$json .= '"success": "true",';
$json .= '"total": "'.$total_pages.'",';
$json .= '"rows": [';
$rc = false;
while ($row = mysql_fetch_array($result)) {
	if ($rc) $json .= ",";
	$json .= '{';
	$json .= '"id": "'.$row['campaign_id'].'",';
	$json .= '"cell":["'.checkState($row['state']).'"';
	$json  .=',"'.$row['name'].'"';
//	$json  .=',"'.date("d.m.Y", strtotime($row['startDate'])).'"';
//	$json  .=',"'.date("d.m.Y", strtotime($row['endDate'])).'"';
	$json.=']';
	$json .= '}';
	$rc = true;
}
$json .= "]";
$json .= "}";
echo ($json);

function checkStatus($startDate, $endDate, $userDate)
{
	// Convert to timestamp
	$start_ts = strtotime($startDate);
	$end_ts = strtotime($endDate);
	$user_ts = strtotime($userDate);

	// Check that user date is between start & end
	if (($user_ts >= $start_ts) && ($user_ts <= $end_ts)) {
	 return 'aktiv';
	}  else if (($user_ts < $start_ts)){
	 return 'erwartet';
	} else {
	 return 'beendet';
	}
}

function checkState($val)
{

	// compare $val
	if ($val==0) {
	 return 'aktiv';
	}  else if ($val==1){
	 return 'erwartet';
	} else {
	 return 'beendet';
	}
}


/*
foreach($_REQUEST as $key => $value) {

	$wf->write($key);
	$wf->write(": " . $value);
	$wf->write(" ; ");
}

*/

function Strip($value)
{
	if(get_magic_quotes_gpc() != 0)
	{
		if(is_array($value))
		if ( array_is_associative($value) )
		{
			foreach( $value as $k=>$v)
			$tmp_val[$k] = stripslashes($v);
			$value = $tmp_val;
		}
		else
		for($j = 0; $j < sizeof($value); $j++)
		$value[$j] = stripslashes($value[$j]);
		else
		$value = stripslashes($value);
	}
		return $value;
}
function array_is_associative ($array)
{
	if ( is_array($array) && ! empty($array) )
	{
		for ( $iterator = count($array) - 1; $iterator; $iterator-- )
		{
			if ( ! array_key_exists($iterator, $array) ) {
				return true;
			}
		}
		return ! array_key_exists(0, $array);
	}
	return false;
}

?>

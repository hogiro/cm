<?php
echo $_SERVER[DOCUMENT_ROOT];

include_once ('source/class.db.php');

$db = new db();

//print_r($db);
//$result = $db->query(file_get_contents('/home/cmedia/public_html/admanager.commonmedia.de/cmdb.sql'));

//echo file_get_contents('cmdb.sql');


$datetime1 = new DateTime('2009-10-11');
$datetime2 = new DateTime('2009-10-13');
$interval = $datetime1->diff($datetime2);
echo ($interval->format('%R%a days'));

echo (date('Y-m-d'));
?>
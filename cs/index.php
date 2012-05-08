<?php
    /*
	 *  Read a web site completely
	 */
	/*
    $filestream = fopen("http://cm/cs/test.php", "r");
	while (!feof($filestream)){
		$buffer = fgets($filestream, 4096);
		echo $buffer;
	}
	fclose($filestream);
	 * /

	 
	
	/*
	 *   Read a part of a website
	 */
	
	/*
	$host = "http://cm/cs/test.php";
	$filestring = file_get_contents($host);
	$startpos = 0;
	while ($pos = strpos($filestring, "<a href", $startpos)) {
		$string = substr ($filestring, $pos, strpos($filestring, "</a>", $pos+1)-$pos);
		echo $string."<br />";
		$startpos = $pos +1;
	}
	 * /
	
	
	/*
	 *  Read just some known parts.
	 */
	
	$host = "http://ads20.wwe-media.de/www/admin/stats.php?clientid=326&statsBreakdown=day&listorder=key&orderdirection=up&day=&setPerPage=15&entity=advertiser&breakdown=history&period_preset=specific&period_start=16+January+2012&period_end=16+January+2012"; 
	$filestring = file_get_contents($host); 
	$startpos = 0; 
	echo $filestring;
	while($pos = strpos($filestring, '<td class="aright last">', $startpos)) 
	{ 
    	$string = substr($filestring, $pos, strpos($filestring, "</td>", $pos + 1) - $pos); 
    	// Wenn 'id="thread_title_' in $string ist, gib den Link aus 
	//f(stristr($string, 'id="titel_')) { 
        	echo $string."</br>"; 
			echo $pos."</br>"; 
    // }
    	$startpos = $pos + 1; 
	}


?>
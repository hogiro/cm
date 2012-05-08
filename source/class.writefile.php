<?php


// Sichergehen, dass die Datei existiert und beschreibbar ist

class writefile {
	
	var $filename = 'X:\\test.txt';
	var $somecontent = "Fuege dies Datei hinzu\n";
	
	    function __construct($filename=""){
                if (!empty($filename)){ $this->filename = $filenamee; }
				
        }
	
	function write($text) {
		
if (is_writable($this->filename)) {

    // Wir öffnen $filename im "Anhänge" - Modus.
    // Der Dateizeiger befindet sich am Ende der Datei, und
    // dort wird $somecontent später mit fwrite() geschrieben.
    if (!$handle = fopen($this->filename, "ab")) {
         print "Kann die Datei $filename nicht öffnen";
         exit;
    }

    // Schreibe $somecontent in die geöffnete Datei.
    if (!fwrite($handle, $text)) {
        print "Kann in die Datei $filename nicht schreiben";
        exit;
    }

 //   print "Fertig, in Datei $filename wurde $somecontent geschrieben";

    fclose($handle);

} else {
    print "Die Datei $filename ist nicht schreibbar";
}
	}
}

?>
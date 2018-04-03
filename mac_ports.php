<?php

 $a = snmpwalk("10.XX.X.XXX", "public", "1.3.6.1.2.1.17.4.3");
 
	// on coupe le tableau en deux tableaux : macs et ports
	
	$tab2 = array();

foreach ($a as $key => $value) {
	
	
    if (strpos($value, "INTEGER") !== false) {
        $tab2[] = substr(strtoupper($value),9);
		
		
        unset($a[$key]);
	}	

}

$macs  = $a;

$l = count($macs);

//var_dump($macs);


$ports = $tab2;
//var_dump($ports);

$final_tab = [];
		for ($i = 0; $i < $l; $i++) {
		
		//Trim les espaces au début et à la fin
		$g[$i] = trim($macs[$i]);
		
		//Explode les espaces 
		$o[$i] = explode(" ",substr(strtoupper($g[$i]),12));
		
		
		$b[$i] = implode(":", $o[$i]);
		
		
		$final_tab[] = ['MAC' => $b[$i], 'PORT' => $ports[$i]];
		
		}

var_dump($final_tab);
echo "<br>";	
?>
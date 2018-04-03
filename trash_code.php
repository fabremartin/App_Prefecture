<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">

</head>
<body>

<?php
 
//get all mac address : .1.3.6.1.2.1.17.4.3.1.1
// recupere port et mac address
 
 $a = snmpwalk("10.81.1.126", "public", "1.3.6.1.2.1.17.4.3");
 

 
 foreach ($a as $val) {
    //var_dump($val);		
 
	var_dump($val);
 
 
	echo "<br>";
	}
/*	
 $a = snmpwalk("10.81.1.126", "public", "1.3.6.1.2.1.17.4.3");
 
	// on coupe le tableau en deux tableaux : macs et ports
	$l = count($a)/2;
	list($macs, $ports) = array_chunk($a, $l);
 
	// on réassemble les deux tableaux en un seul
	$final_tab = [];
 
		for ($i = 0; $i < $l; $i++) {
		$final_tab[] = ['MAC' => $macs[$i], 'PORT' => $ports[$i]];
		}
	
var_dump($final_tab);
echo "<br>";	
*/


// SNMP SUR ROUTEUR POUR RECUPERER LA TABLE ARP
	snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
 
	$OID = '.1.3.6.1.2.1.4.22.1.2';
	$X = snmprealwalk('10.81.1.126', 'public', $OID);
	foreach($X as $key => $value) {
		$IP = substr($key, strlen($OID)+2);
		$Y[$IP]=$value;
		
		//$Y[$IP]=substr($value,8);	
		
		//$explode=explode(":",$Y[$IP]);
		
		//var_dump($X);
		//echo "<br>";
			
		
	}
	unset($X);
	asort($Y);
	 
/*	$copy_tab1=$Y;
	//var_dump($value);
	foreach ($Y as $k => $line) {
	//on élimine "STRING: "
	//var_dump($line);
	echo "<br>";
	$line2 =  substr($line,8);
		
	//var_dump($line2);
	$modif1 = $line2;
	
	
	//on bouche les manques avec des zéros
	$parts=explode(":",$modif1);
	//var_dump($parts);
	$copy_tab1[$k]=vsprintf('%02s:%02s:%02s:%02s:%02s:%02s', $parts); 
	
	var_dump($copy_tab1[$k]);
	}*/

 
	echo '<table border="1"> 
			<th> PORT </th>
			<th> IP </th>
			<th> MAC </th>';
			
	$copy_tab1=$Y;
 
	foreach($Y as $key => $value) {
		
		$value1 = substr(strtoupper($value),8);
		
		$modif1 = $value1;
	
	
	//on bouche les manques avec des zéros
	$parts=explode(":",$modif1);
	//var_dump($parts);
	$copy_tab1[$key]=vsprintf('%02s:%02s:%02s:%02s:%02s:%02s', $parts); 
		
		
		echo '<tr> 
				<td> </td>
				<td> ' . substr($key, 5) . ' </td> 
				<td> ' .$copy_tab1[$key] . ' </td> 
			  </tr>';
	}
	

	
?>
	
</body>
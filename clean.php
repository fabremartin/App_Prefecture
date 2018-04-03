<?php
 
//Script PHP ** Récupere les adresses MAC et PORTS associés
 
 $a = snmpwalk("10.81.1.126", "public", "1.3.6.1.2.1.17.4.3");
 

 
 foreach ($a as $val) {
    //var_dump($val);		
 
	var_dump($val);
 
 
	echo "<br>";
	}
	
	

//SCRIPT PHP ** Récupere les adresses MAC et les adresses IP

	snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
 
	$OID = '.1.3.6.1.2.1.4.22.1.2';
	$X = snmprealwalk('10.81.1.126', 'public', $OID);
	foreach($X as $key => $value) {
		
		$IP = substr($key, strlen($OID)+2);
		$Y[$IP]=$value;			
		
	}
	unset($X);
	asort($Y);
	
		echo '<table border="1"> 
			<th> PORT </th>
			<th> IP </th>
			<th> MAC </th>';
			
	$copy_tab1=$Y;
 
	foreach($Y as $key => $value) {
		
		//On coupe pour n'avoir que l'adresse MAC en Uppercase
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
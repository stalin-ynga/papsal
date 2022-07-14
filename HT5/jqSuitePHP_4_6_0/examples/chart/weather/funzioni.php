<?php 
//funzione per calcolare max e min di una data
function max_min_date($date){
	//date è un array di date nel formato unixtime in msec
	$max_min[]  = array();
	//init array
	$max_min[0]=$date[0];
	$max_min[1]=$date[0];
	for ($i=0;$i<sizeof($date);$i++){
		//controllo min
		if ($max_min[0]>$date[$i]){
			$max_min[0]=$date[$i];
		}
		//controllo max
		if ($max_min[1]<$date[$i]){
			$max_min[1]=$date[$i];
		}
	}
	return $max_min;
}
?>

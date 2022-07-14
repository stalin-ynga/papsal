<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
require_once '../../../tabs.php';
ini_set("display_errors",1);
	require_once '../../../jq-config.php';
	require_once ABSPATH."php/jqUtils.php";
	require_once ABSPATH."php/jqGridPdo.php";
	require_once ABSPATH."php/jqChart.php";
	//$path=str_replace('/var/www/html','',ABSPATH);
	//$export_path=$path.'../export-chart/';
?>
<?php
	//include dimensioni chart	
		require_once 'conf.php';
		require_once 'funzioni.php';
	//impostazione connessione DB
		//$conn=mysql_connect("localhost",DB_USER,DB_PASSWORD);
		$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);

		//$dbh="northwind";
		//$db=mysql_select_db($dbh,$conn);
	//impostazioni variabili da form	
		//id_stazione
		//$stazione=$_POST["stazione"];
		if (!isset ($stazione)){
			$stazione=1;
		}
		$var[0]='Davis01-IAMB';
	//estraggo dati da sql
	//Tmin,Tmax,Pioggia,Umidità,Radiazione
		$sql="SELECT 
					UNIX_TIMESTAMP(date_time) 
					, Tmin
					, Tmax 
					, rain 
					, R_inc 
					, RH_max
				FROM 
					measures_extended 
				WHERE
					cadence='1D' 
					AND station= '".$var[0]."'
					;";
		$conn->query("SET NAMES utf8");
		$sth = $conn->prepare($sql);
		$sth->execute();
		//var_dump($sth);
		//$customers = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		//$result=mysql_query($sql,$conn);
		//$count=mysql_num_rows($result);
		$count = 1;
		if ($count>0){
			$i=0;
			//struttura per contenere i dati da sql
			$date[]  = array();
			$t_min[] = array();
			$t_max[] = array();
			$rain[]  = array();
			$rh_max[]= array();
			$r_inc[] = array();
			while($row=$sth->fetch(PDO::FETCH_NUM) )
			{
					//mysql_fetch_array($result)){
				//estraggo tutti i valori
				//converto la data in unix_time, --> msec
				$date[$i]=$day=$row[0]*1000;
				$t_min [$i] = array ($day ,  (float)$row[1]);
				$t_max [$i] = array ($day ,  (float)$row[2]);
				$rain  [$i] = array ($day ,  (float)$row[3]);
				$rh_max[$i] = array ($day ,  (float)$row[4]);
				$r_inc [$i] = array ($day ,  (float)$row[5]);
				$i++;
			}
			//prendo max e min da funzione
			list ($min, $max) = max_min_date($date);
			//calcolo valori maschera
		  	//se l'intervallo dei dati > 30 gg
		  	$middle=$min;
		  	if ( (($max-$min)/(1000*60*60*24)) > 30){
				//imposto maschera
				$middle=$max-(1000*60*60*24)*30;
		  	}
			$sth->closeCursor();
		}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chart M/S</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text"> 
	html, body { 
		margin: 0;            /* Remove body margin/padding */ 
		padding: 0; 
		overflow: hidden;    /* Remove scroll bars on browser window */ 
		font-size: 62.5%; 
	} 
	body { 
		font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif"; 
	} 
	#tags {z-index: 900} 
</style> 
<link rel="stylesheet" type="text/css" media="screen" href="../../../themes/redmond/jquery-ui-1.8.2.custom.css" /> 
<script src="../../../js/jquery.js" type="text/javascript"></script> 
<script src="../../../js/jquery.jqChart.js" type="text/javascript"></script>       
<script src="../../../js/jquery-ui-custom.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var masterChart, detailChart;
	//creo struttura per contenere i dati 
</script>
</head>
<body>
	
    <div id="container" style="position:relative">
    	<div id="detail-container" style="position:relative; height:<?php echo $alt_d;?>px; width:100%">
    	<?php include("detail.php");?>
		
    	</div>
    	<div id="master-container" style="position:relative; height:<?php echo $alt_m;?>px; width:100%">
    	<?php include("master.php");?>
    	</div> 
    </div>
    
    <div>
		<?php
			$sql="SELECT 
					ws.id 
					, ws.name 
				  FROM 
					weather_stations AS ws
				  WHERE ws.name IN (SELECT
										DISTINCT(me.station) 
									FROM
										measures_extended as me
									)
				 ";
			//$result=mysql_query($sql,$conn);
			$result = $conn->query($sql);
			//$count=mysql_num_rows($result);
      	?>
      <form id="form_table" name="form_table" action="./" method="post">
          Stazione meteo: 
          <select name="stazione">
            <?php
                $i=0;
                while ($val=$result->fetch(PDO::FETCH_NUM)) {
                    $id=$val[0];
                    $staz=$val[1];
                    if ($id==$stazione){
                        print("<option value=\"{$id}\" selected>{$staz}</option>");	
                    } else {
                        print("<option value=\"{$id}\">{$staz}</option>");
                    }
                    
                    $i++;
                }
				$result->closeCursor();
            ?>
          </select>
          <br/>
          <br/>  
      </form>
        <?php
            //mysql_close($conn);
			$conn = null;
			tabs(array('master.php','detail.php') ) ;
        ?>
    </div>
</body>
</html>

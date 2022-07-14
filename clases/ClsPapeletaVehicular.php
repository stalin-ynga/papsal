<?
include("conexion.php");
?>
<?php
class ClsPapeletaVehicular{
var $usuario ;
var $vehiculo ; 
var $observacion ;
var $fecha ;
var $destino ;

function CrearVehicular() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_GenCodVehi('$this->usuario','$this->vehiculo','$this->observacion','$this->fecha','$this->destino'); ";
   
	    $res=mysql_query($sql_guardar,$enlace);
	    while ($reg2 = mysql_fetch_array($res))
               { $var=$reg2[0];}
	   
	   if($var=='01'){
		   echo "<script> alert('Ya Existe Una Papeleta');</script>";
		   }
	   else{
	   
	   return true;
	   }
	   }


}
?>
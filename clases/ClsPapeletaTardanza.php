<?
include("conexion.php");
?>
<?php
class ClsPapeletaTardanza {
var $usuario ;
var $motivo; 
var $marca;
var $fundamento ;
var $f1;


function CrearTardanza() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_GenCodTardanza('$this->usuario','$this->motivo','$this->marca','$this->fundamento','$this->f1'); ";
   
	   $res=mysql_query($sql_guardar,$enlace);
	    while ($reg2 = mysql_fetch_array($res))
               { $var=$reg2[0];}
	   
	   if($var=='01'){
		   echo "<script> alert('Ya Creaste Una Papeleta Dentro De La Misma Hora');</script>";
		   }
	   else{
	   
	   return true;
	   }
	   
                  }




function HoraActual(){
  
	   $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="SELECT CONCAT(CURDATE(),' ',CURTIME()); ";
   
	   $res=mysql_query($sql_guardar,$enlace);
	   
   	   while ($reg2 = mysql_fetch_array($res))
               { $var=$reg2[0]; }
	
	   return $var;
}


}//fin de la clase
?>
<?
include("conexion.php");
?>
<?php
class ClsPapeletaSalida {
var $usuario ;
var $tipo; 
var $lugar;
var $fundamento ;
var $obser;
var $f1;
var $f2;
var $ip;
var $auto;


function CrearSalida() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_GenCodSalida('$this->usuario','$this->tipo','$this->lugar','$this->fundamento','$this->obser','$this->f1','$this->f2','$this->ip','$this->auto'); ";
  
	   $res2=mysql_query($sql_guardar,$enlace);
	    while ($reg2 = mysql_fetch_array($res2))
               { $var=$reg2[0];}
	   
	   if($var=='01'){
		   echo "<script> alert('Ya Creaste Un Papeleta Dentro De La Misma Hora');</script>";
		   }
	   else{
	   
	   return true;
	   }
                  }

function CrearDocumento() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   $sql_guardar="";
       $sql_guardar="CALL Sp_GenCodDoc('$this->usuario','$this->tipo','$this->lugar','$this->fundamento','$this->obser','$this->f1','$this->f2');";

	   $res2=mysql_query($sql_guardar,$enlace);
	  
	//    while ($reg2 = mysql_fetch_array($res2))
       //        { $var=$reg2[0];}
	  // 
	 //  if($var=='01'){
	//	 
	//	   }
	  // else{
	  //          echo "<script> alert('Exito Al Registrar');
	  return true;
	  
        }
		
function Ano(){
  
	   $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="SELECT YEAR(CURDATE()); ";
   
	   $res=mysql_query($sql_guardar,$enlace);
	   
   	   while ($reg2 = mysql_fetch_array($res))
               { $var=$reg2[0]; }
	
	   return $var;
}

function Mes(){
  
	   $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="SELECT MONTH(CURDATE()); ";
   
	   $res=mysql_query($sql_guardar,$enlace);
	   
   	   while ($reg2 = mysql_fetch_array($res))
               { $var=$reg2[0]; }
	
	   return $var;
}

function Dia(){
  
	   $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="SELECT DAY(CURDATE()); ";
   
	   $res=mysql_query($sql_guardar,$enlace);
	   
   	   while ($reg2 = mysql_fetch_array($res))
               { $var=$reg2[0]; }
	
	   return $var;
}

function Evalua(){
  
	   $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_HoraEvalua('$this->usuario'); ";
   	   $res=mysql_query($sql_guardar,$enlace);
	   
   	   while ($reg2 = mysql_fetch_array($res))
               { $var=$reg2[0]; }
	
		echo $var;
	
	   return $var;
}

}
?>
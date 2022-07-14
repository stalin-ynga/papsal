<?
include("conexion.php");
?>
<?php
class ClsAsigna{
	
var $trabajador ;
var $area ; 
var $jefe ; 
var $codigo ; 


function ClsAsigna(){

}

function Crear($jefe) {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
	   $sql_guardar2="CALL Sp_GenDetalleOficina('$jefe','$this->trabajador','$this->area','02');";
	   
       mysql_query($sql_guardar2,$enlace); 
	  
	  
	
	   return true;
	   
               }



function Modificar() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
	   $sql_guardar2="CALL Sp_ModDetalleOficina('$this->jefe','$this->codigo');";
	   
       mysql_query($sql_guardar2,$enlace); 
	  
	  
	
	   return true;
	   
               }

}
?>
<?
include("conexion.php");
?>
<?php
class ClsVehicular{
var $tipo ;
var $marca ; 
var $modelo ;
var $placa ;
var $codigo ;

function ClsVehicular(){

}

function Crear() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_CrearVehicular('$this->tipo','$this->modelo','$this->marca','$this->placa'); ";
   
	   mysql_query($sql_guardar,$enlace);
	
	   return true;
                  }

function Modificar() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_ModiVehi('$this->tipo','$this->modelo','$this->marca','$this->placa','$this->codigo');";
   
	   mysql_query($sql_guardar,$enlace);
	
	   
	   return true;
                  }


}
?>
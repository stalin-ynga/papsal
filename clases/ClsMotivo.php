<?
include("conexion.php");
?>
<?php
class ClsMotivo{

var $nombre ;
var $codigo ;

function ClsMotivo(){

}

function Crear() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_CrearMotivo('$this->nombre') ;";
      
	   mysql_query($sql_guardar,$enlace);
	
	return true;
                  }

function Modificar() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_ModiMotivo('$this->nombre','$this->codigo');";
   
	   mysql_query($sql_guardar,$enlace);
	
	   return true;
	  
                  }


}
?>
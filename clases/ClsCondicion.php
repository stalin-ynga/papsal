<?
include("conexion.php");
?>
<?php
class ClsCondicion{

var $nombre ;
var $codigo ;

function ClsCondicion(){

}

function Crear() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_CrearCondicion('$this->nombre') ;";
      
	   mysql_query($sql_guardar,$enlace);
	
	return true;
                  }

function Modificar() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_ModiCondicion('$this->nombre','$this->codigo');";
   
	   mysql_query($sql_guardar,$enlace);
	
	   return true;
	  
                  }


}
?>
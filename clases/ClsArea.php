<?
include("conexion.php");
?>
<?php
class ClsArea{

var $nombre ;
var $codigo ;

function ClsArea(){

}

function Crear() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_CrearArea('$this->nombre') ;";
      
	   mysql_query($sql_guardar,$enlace);
	
	return true;
                  }

function Modificar() {
	
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       $sql_guardar="CALL Sp_ModiArea('$this->nombre','$this->codigo');";
   
	   mysql_query($sql_guardar,$enlace);
	
	   return true;
	  
                  }


}
?>
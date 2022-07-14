<?php
include("conexion.php");

class ClsUsuario{
var $codigo;	
var $paterno ;
var $materno ; 
var $nombres ;
var $sexo ;
var $dni ;
var $area ;
var $condicion ;
var $cargo ;
var $user ;
var $pass;
var $sueldo;
var $acceso;
var $en;
var $sal;
function ClsUsuario()
{

}
function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}

function decrypt($string, $key) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}

function Crear() {
      $enlace = conexion();
      mysqli_select_db($enlace, 'dbpap');
      $sql_guardar="CALL Sp_CrearUsuario('".$this->encrypt($this->user,'pass')."','".$this->encrypt($this->pass,'pass')."','$this->nombres','$this->paterno','$this->materno','$this->area','$this->condicion','$this->dni','$this->sexo','$this->cargo',$this->sueldo,'$this->acceso','$this->en','$this->sal');";
	   mysqli_query($enlace, $sql_guardar);
	   return true;
}				  
function Modificar() {
      $enlace = conexion();
      mysqli_select_db($enlace, 'dbpap');
      $sql_guardar="CALL Sp_ModiUsuario('".$this->encrypt($this->user,'pass')."','".$this->encrypt($this->pass,'pass')."','$this->nombres','$this->paterno','$this->materno','$this->area','$this->condicion','$this->dni','$this->sexo','$this->cargo',$this->sueldo,'$this->acceso','$this->codigo','$this->en','$this->sal');";
	   mysqli_query($enlace, $sql_guardar);	
	   return true;
}				 
function CambiaPass($passw){
	   $enlace = conexion();
      mysqli_select_db($enlace, 'dbpap');
      $sql_guardar="CALL Sp_CambiaPass('".$this->encrypt($passw,'pass')."','$this->codigo'); ";
	   mysqli_query($enlace, $sql_guardar);	
	   return true;
}				  			  
function ActDes($est){
	   $enlace=conexion();
      mysqli_select_db($enlace, 'dbpap');
      if($est==1){	
	      $sql_guardar1="UPDATE TBLUSUARIO SET Estado='N' WHERE Codigo='$this->codigo';";
      }
		mysqli_query($enlace, $sql_guardar1); 	
		if($est==2){
         $sql_guardar1="UPDATE TBLUSUARIO SET Estado='A' WHERE Codigo='$this->codigo';";
      }
		mysqli_query($enlace, $sql_guardar1);
	   return true;
}

}
?>
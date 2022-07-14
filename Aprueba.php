<?php
       include("./clases/conexion.php");

       $enlace=conexion();

       mysql_select_db('dbpap', $enlace);

       $num=$_POST['num'];
	   
	   $tipo=$_POST['Tip'];
	   
	   $ip=$_POST['ip'];
	   
	   $usuario=$_POST['usuario'];
	   
	   // APROBACION PARA LAS SALIDAS
	   if($tipo=='01'){
		   
     for($i=1;$i<=$num;$i++)
{
      	if($_POST[$i]!=''){
       $sql_guardar="CALL Sp_MarcaEntrada('".$_POST[$i]."','$ip','$usuario','APROBACION'); ";
		
	   mysql_query($sql_guardar,$enlace);
		}
}
	   }
	   
	   // APROBACION PARA LAS TARDANZAS
	   if($tipo=='02'){
		   
     for($i=1;$i<=$num;$i++)
{
      	if($_POST[$i]!=''){
       $sql_guardar="CALL Sp_GenMarcadoTardanza('".$_POST[$i]."'); ";
  
	   mysql_query($sql_guardar,$enlace);}
}
	   }
	   
	   // APROBACION PARA LAS VEHICULARES
	   if($tipo=='03'){
		   
     for($i=1;$i<=$num;$i++)
{
      	if($_POST[$i]!=''){
       $sql_guardar="CALL Sp_GenMarcadoVehicular('".$_POST[$i]."'); ";
  
	   mysql_query($sql_guardar,$enlace);}
}
	   }
	 // FINALMENTE VOLVEMOS AL PRINICPIO DE LAS PAPALETAS PENDIENTES  
       header("Location:PorAprobar.php")

?>
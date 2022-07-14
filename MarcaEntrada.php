<?php
       include("./clases/conexion.php");

       $enlace=conexion();
       
       mysql_select_db('dbpap', $enlace);
       
       $num=$_POST['num'];
	  
	   $tipo=$_POST['Tip'];
	  
	   // APROBACION PARA LAS SALIDAS
	   if($tipo=='01'){
		   
       for($i=1;$i<=$num;$i++)
{
      	 
       $sql_guardar="CALL Sp_GenMarcadoSalida('".$_POST[$i]."'); ";
  
	   mysql_query($sql_guardar,$enlace);
}
	   
	   
	   	   }
	 // FINALMENTE VOLVEMOS AL PRINICPIO DE LAS PAPALETAS PENDIENTES  
     header("Location:FrmConsultaVig.php")

?>
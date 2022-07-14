<?php
       include("./clases/conexion.php");

       $enlace=conexion();

       mysql_select_db('dbpap', $enlace);

       $num=$_POST['num'];
	  
	   
	   // APROBACION PARA LAS SALIDAS
	  
     for($i=1;$i<=$num;$i++)
         {
      	if($_POST[$i]!=''){
       $sql_guardar="CALL Sp_Justifica('".$_POST[$i]."'); ";
		
	   mysql_query($sql_guardar,$enlace);
		                }
          }

	  
	 // FINALMENTE VOLVEMOS AL PRINICPIO DE LAS PAPALETAS PENDIENTES  
       header("Location:ConsultaGen.php")

?>
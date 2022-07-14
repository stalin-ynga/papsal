<?php
       include("./clases/ClsUsuario.php");

       $Usuario =new ClsUsuario;
	   
       $cod=$_GET['cod'];
	   
	   $est=$_GET['est'];
	   
	   
	   $Usuario->codigo=$cod;
	   
	   $ban=$Usuario->ActDes($est);
	   
	  if($ban==true){
	   
	  header("Location:FrmConsultaUsuario.php");	
	    
                    }
   else{
      
	    echo "Error al Actualizar" ;
       }
			
		 
?>
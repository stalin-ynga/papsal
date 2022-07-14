<?php

session_start();

if($_SESSION["User"] != "1"){header("Index.php");}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Free CSS Vertical Menu Designs at exploding-boy.com</title>

<script language="javascript">
	function verifica(itemq){
		if(document.f.tipo.value=="0000000003" || document.f.tipo.value=="0000000004"){
			if(itemq=="4"){
	    alert("Solo Para Jefes");
		document.getElementById("pendiente").href = "principal.html";
			return false;
			}
			
			
		}
		else {
		
		       return true;
			   
			   }	
}
</script>
  <style type="text/css">
  @import url("css/stylo.css");


#button {
	width: 18.1em;
	border-right: 1px solid #000;
	padding: 0 0 1em 0;
	margin-bottom: 1em;
	font-family: 'Trebuchet MS', 'Lucida Grande', Verdana, Arial, sans-serif;
	background-color: #90bade;
	color: #333;
}

#button ul {
	list-style: none;
	margin: 0;
	padding: 0;
	border: none;
}
	
#button li {
	border-bottom: 1px solid #90bade;
	margin: 0;
	list-style: none;
	list-style-image: none;
}
	
#button li a {
	display: block;
	padding: 5px 5px 5px 0.5em;
	border-left: 10px solid #1958b7;
	border-right: 10px solid #508fc4;
	background-color: #093;
	color: #fff;
	text-decoration: none;
	width: 100%;
}

html>body #button li a {
	width: auto;
}

#button li a:hover {
	border-left: 10px solid #1c64d1;
	border-right: 10px solid #5ba3e0;
	background-color: #09F;
	color: #fff;
}
  .Estilo1 {
	font-family: 'Trebuchet MS', 'Lucida Grande', Verdana, Arial, sans-serif;
	font-size: 11px;
}
  .Estilo2 {font-size: 12px}
  </style>
  <link href="../swaereo/css/menu.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form name="f" action="main.php" method="post" >
 <img src="img/logo_agricultura.gif" /> 

<div id="button">
 <?php
if($_SESSION["Acceso"] == "0000000001"){

?>
<div class="tabla_bici">Gestion De Registros</div>
  <ul>
    <li><a href="FrmConsultaUsuario.php" target="mainFrame" id="user">Gestion De Usuarios</a></li>
    <li><a href="FrmConsultaVehi.php" target="mainFrame" id="vehi">Gestion De Vehiculos</a></li>
    <li><a href="FrmConsultaAsignacion.php" target="mainFrame" id="vehi">Gestion De Asignaciones</a></li>
  </ul>
  
  <? } ?>
  
  <div class="tabla_bici">Generar Papeletas</div>
  <ul>
    <li><a href="PrevMostrar.php?id=3" target="mainFrame"  id="salida">Papeletas De Salida</a></li>
    <li><a href="PrevMostrar.php?id=7" target="mainFrame" id="tardanza" >Papeletas De Tardanza</a></li>
    <li><a href="PrevMostrar.php?id=8" target="mainFrame" id="vehicular">Papeletas Vehiculares</a></li>
  </ul>
  
  <div class="tabla_bici">Consultas Usuarios</div>
  <ul>
   
    <li><a href="PrevMostrar.php?id=6" target="mainFrame" id="hoy">Mis Papeletas De Hoy</a></li>
    <li><a href="PrevMostrar.php?id=9" target="mainFrame" id="pendiente" onclick="verifica(4);">Papeletas Por Aprobar</a></li>
	  
	
  </ul>
  <?php


if($_SESSION["Acceso"] == "0000000001"){

?>
  <div class="tabla_bici">Consultas Administrativas</div>
  <ul>
   
    <li><a href="ConsultaGen.php" target="mainFrame" id="hoy" onclick="verifica(3);">Consultas Marcado</a></li>
    <li><a href="ConsultaJusti.php" target="mainFrame" id="asigna" onclick="verifica(3);">Consultas Documentos</a></li>
    <li><a href="PrevMostrar.php?id=4" target="mainFrame" id="marcado" >Cargar Marcado</a></li>
  </ul>
  <? } ?>
  
  <?php
if($_SESSION["Acceso"] == "0000000004"){

?>
<div class="tabla_bici">Consultas Salidas</div>
  <ul>
    <li><a href="FrmConsultaVig.php" target="mainFrame" id="user">Consultar Papeletas</a></li>
    
  </ul>
  
  <? } ?>
  <div class="tabla_bici">Detalles</div>
  <ul>
    <li><a href="./acceso/logout.php" target="_parent">Cerrar Mi Sesion</a></li>
    <li><a href="PrevMostrar.php?id=5" target="mainFrame">Cambiar Mi Contraseña</a></li>
    <li><a href="./Docs/Reglamento UPER-2012.pdf" target="_blank">Ver Directivas Legales</a></li>
  </ul>
</div>
<input name="tipo" type="hidden" id="tipo" value="<? print $_SESSION["Acceso"] ?>">
</form>

</body>
</html>
<?php
include("./clases/ClsUsuario.php");
ini_set("session.gc_maxlifetime","30000");
session_start();

if($_SESSION["User"] != "1"){header("Index.php");}

if(isset($_POST["guardar"])>0){
   $Usuario =new ClsUsuario;
   $Usuario->codigo=$_SESSION["Codigo"];
   
  
  
   $ban=$Usuario->CambiaPass(trim($_POST['pass']));
   
   if($ban==true){
	  header("location:concluye.php?cod=8");
   }
   else{
        echo "Error Al Cambiar Contraseña" ;
   }
}

?>

<html>
<head>
<title>Cambio De Contraseña</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="jquery/js/jquery-1.10.2.js"></script>
	<script src="jquery/js/jquery-ui-1.10.4.custom.js"></script>
		
  <script type="text/javascript">
  $( "#dialog" ).dialog({ autoOpen: false });
function validar1 ()
{
var i;
for (i = 0; i < document.f.dni.value.length; i++)
{
if (document.f.dni.value.charCodeAt(i) < 48 || document.f.dni.value.charCodeAt(i) > 57)
{ 
document.f.dni.value = document.f.dni.value.slice(0, i);
}
}
}

function guardar(){
 
		document.usuario.guardar.value = "1";
	
}

	function validar(f){
		if(f.pass.value ==""){
			$(function() {
    $( "#dialog" ).dialog({
		autoOpen:true,
		position: "top center",
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
			return false;
		}
		
		
					
		f.submit();
		return true;
	}
</script>

	<style type="text/css">
			body,img,p,h1,h2,h3,h4,h5,h6,form,table,td,ul,li,dl,dt,dd,pre,blockquote,fieldset,label{
				margin:0;
				padding:0;
				border:0;
			}
pre{ padding: 20px; background-color: #ffffcc; border: solid 1px #fff; }
			.wrapper{ background-color: #ffffff; width: 800px; border: solid 1px #eeeeee; padding: 20px; margin: 0 auto; }
			.example-container{ background-color: #f4f4f4; border-bottom: solid 2px #777777; margin: 0 0 40px 0; padding: 20px; }
			.example-container p{ font-weight: bold; }
			.example-container dt{ font-weight: bold; height: 20px; }
			.example-container dd{ margin: -20px 0 10px 100px; border-bottom: solid 1px #fff; }
			.example-container input{ width: 150px; }
			.clear{ clear: both; }
			#ui-datepicker-div{ font-size: 80%; }

			/* css for timepicker */
			.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
			.ui-timepicker-div dl{ text-align: left; }
			.ui-timepicker-div dl dt{ height: 25px; }
			.ui-timepicker-div dl dd{ margin: -25px 10px 10px 65px; }
			.ui-timepicker-div td { font-size: 90%; }

		</style>


<style type="text/css">
<!--

.tb61 {
	border: 3px double #CCCCCC;
	width: 450px;
}
.ta2 {
	width:450px;
	height:60px;
	background-color:#99FFCC;
	border:1px solid #008800;
}
.ta21 {
	width:200px;
	height:40px;
	background-color:#99FFCC;
	border:1px solid #008800;
}

.tb6 {	border: 3px double #CCCCCC;
	width: 180px;
	text-align: left;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #FFFFFF;
	text-align: center;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #00CC33;
}
.Estilo3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}
.Estilo9 {
	font-size: 12px;
	text-align: left;
}
.s {
	text-align: right;
}
.Estilo2 {
	text-align: left;
}
.Estilo11 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #FFFFFF;
}
.Estilo11 {	color: #000;
}
.Estilo9 {	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.Estilo92 {	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.ww {
	border:1px solid black; padding:15px;
}
.Estilo91 {	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.Estilo911 {	font-size: 15px;
	font-family: "Lucida Console", Monaco, monospace;
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="CambiaPass.php" method="post" onSubmit="return validar(this)" class="ww" >
<center>
<table width="553" border="0">
  <tr>
    <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png" alt="" width="552" height="98"></div></td>
  </tr>
</table>
<table width="556" border="0">
  <tr>
    <td width="550" height="20" bgcolor="#0099FF"><div align="center" class="Estilo911">Actualizar Contraseña</div></td>
  </tr>
</table>
<table width="553" border="0" >
  <tr>
    <td width="547"><div align="right" class="Estilo91">(*)campos obligatorios</div></td>
  </tr>
</table>
<table width="553" border="0">
<tr>
                              <td width="143"><span class="Estilo9">Nueva Contrase&ntilde;a:</span></td>
                              <td width="267"><span class="Estilo9">
                                <input name="pass" type="text" class="tb6" id="pass" value="" maxlength="10">
                              (*)</span></td>
<td width="66"><input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="59"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9" /></td>
        </tr>
    </table>
<table width="556" border="0">
  <tr>
    <td width="550" bgcolor="#0099FF">&nbsp;</td>
  </tr>
</table>
</form>           
<div id="dialog" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Nueva Contraseña
  </p>
  
</div>
<script>
$( "#dialog" ).dialog({ autoOpen: false });
</script>
<span class="Estilo92"><span class="Estilo1">
<input name="guardar" type="hidden" id="guardar" />
</span></span></body>

</html>
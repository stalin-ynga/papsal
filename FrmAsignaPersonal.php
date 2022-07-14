<?php
include("./clases/ClsAsigna.php");
ini_set("session.gc_maxlifetime","30000");

session_start();

if($_SESSION["User"] != "1"){header("Index.php");}

if(isset($_POST["guardar"])>0){
   $Asigna =new ClsAsigna;
   $Asigna->trabajador=trim($_POST["NombreCom"]);
   $Asigna->area=trim($_POST['oficina']);
  $ban="";
  $db_conn = mysql_connect('localhost', 'root','');
       
	      mysql_select_db('dbpap',   $db_conn );
		  
	      $res3 = mysql_query("SELECT Codigo FROM tblusuario WHERE Area=(SELECT Codigo from tblarea WHERE Nombre='$Asigna->area') AND Acceso='0000000002';",$db_conn);

while ($reg3 = mysql_fetch_array($res3))
{   
             
           $ban=$Asigna->Crear($reg3[0]);
			
			
}

   if($ban==true){
	 header("location:concluye.php?cod=13");
   }
   else{
         echo "<script>alert('Error Al Registrar'); </script>" ;
   }
}

?>

<html>
<head>
<title>Ficha De Inscripcion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link type="text/css" rel="stylesheet" href="./css/jquery-ui-1.8.4.custom.css" />
        <link type="text/css" rel="stylesheet" href="./css/estilo.css" />
        <script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="./js/jquery-ui-1.8.4.custom.min.js"></script>
     <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    
        

		<script type="text/javascript" src="./js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>

<script type="text/javascript">
  jQuery(function() {
     
	 $('#NombreCom').autocomplete({
                   source : 'ajax.php?cod=1' });
				   
    $('#oficina').autocomplete({
                   source : 'ajax.php?cod=2' });
	  
  
  });
  
  </script> 
  <script type="text/javascript">
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
		if(f.NombreCom.value ==""){
			alert("Ingresar El Trabajador");
			return false;
		}
		if(f.oficina.value ==""){
			alert("Ingresar La Oficina");
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

/* Background Color */
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
	font-family: "Lucida Console", Monaco, monospace;
}
.s {
	text-align: right;
}
.Estilo2 {
	text-align: left;
}
.tb6 {	border: 3px double #CCCCCC;
	width: 180px;
	text-align: left;
}
.Estilo91 {	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.Estilo91 {	font-size: 15px;
	font-family: "Lucida Console", Monaco, monospace;
}
.ww {
	border:1px solid black; padding:15px;
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmAsignaPersonal.php" method="post" onSubmit="return validar(this)" class="ww" >
  <table width="553" border="0">
    <tr>
      <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png" width="552" height="98"></div></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" height="20" bgcolor="#0099FF"><div align="center" class="Estilo9">Asignacion De Personal</div></td>
    </tr>
  </table>
  <table width="553" border="0">
    <tr>
      <td width="547"><div align="right" class="Estilo9">(*)campos obligatorios</div></td>
    </tr>
  </table>
  <table width="553" border="0">
                            <tr>
                              <td width="104"><span class="Estilo9"> Trabajador:</span></td>
                              <td width="439"><input name="NombreCom" type="text" class="Estilo9"  id="NombreCom" size="50" maxlength="100"  />
                              <span class="Estilo9">(*)</span></td>
                            </tr>
                          </table>
      <table width="552" border="0">
        <tr>
          <td width="104"><span class="Estilo9">Oficina/Unidad</span></td>
          <td width="439"><input name="oficina" type="text" class="Estilo9"  id="oficina" size="50" maxlength="100" />
          <span class="Estilo9">(*)</span></td>
        </tr>
      </table>
      <table width="556" border="0">
<tr>
                              <td width="191" bgcolor="#00CC00"><input name="guardar" type="hidden" id="guardar"></td>
                              <td width="79" bgcolor="#00CC00"><input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="63" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9" /></td>
                              <td width="205" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
    </table>
</form>           

</body>

</html>
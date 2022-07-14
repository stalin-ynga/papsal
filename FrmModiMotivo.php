<?php

ini_set("session.gc_maxlifetime","30000");
session_start();

include("./clases/ClsMotivo.php");

$enlace=conexion();
	
mysql_select_db('dbpap', $enlace);
	
$Cod="";

$Cod=$_GET['Cod'];	   

if($Cod!='A'){
$sql_guardar1="select Codigo,Nombre from tbltipomotivo WHERE Codigo=".$Cod." ; 
 ";
 
$res1 =mysql_query($sql_guardar1,$enlace); 

$reg = mysql_fetch_array($res1);
}

if($_SESSION["User"] != "1"){header("Index.php");}


//--


if(isset($_POST["guardar"])>0){
   $Mot =new ClsMotivo;
   $Mot->nombre=$_POST['nombre'];
   $Mot->codigo=$_POST['codigo'];
   $ban=$Mot->Modificar();
   
   if($ban==true){
	   
	  header("location:concluye.php?cod=14");
	  
   }
   else{
           echo "<script language='javascript' type='text/javascript'>";
		echo "alert('Error Al Registrar');" ;
   }
}
?>

<html>
<head>
<title>Ficha De Inscripcion</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link type="text/css" rel="stylesheet" href="./css/jquery-ui-1.8.4.custom.css" /> 
        <script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="./js/jquery-ui-1.8.4.custom.min.js"></script>
        <link type="text/css" href="./css/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="./js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-1.8.13.custom.min.js"></script>

<script language="javascript">
function guardar(){
 
		document.f.guardar.value = "1";
		document.f.Cod.value = "A";
	
}
	
		function validar(f){
		if(f.nombre.value ==""){
			alert("Ingresar La Descripcion");
			return false;
		}
		
		f.submit();
		return true;
	}
	
	
</script>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
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
.ww {
	border:1px solid black; padding:10px;
}
.s {
	text-align: right;
	font-size: 9px;
}
.Estilo2 {
}
.Estilo11 {font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
}
.Estilo91 {font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.s1 {text-align: right;
	font-size: 9px;
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmModiMotivo.php" method="post" onSubmit="return validar(this)" class="ww" >
  <table width="428" border="0">
    <tr>
      <td width="422" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo11"><img src="modal/logo.png"  width="425" height="98"></div></td>
    </tr>
  </table>
  <table width="430" border="0">
    <tr>
      <td width="424" height="18" bgcolor="#00CC33"><div align="center" class="Estilo91">Actualizacion De Motivos</div></td>
    </tr>
  </table>
  <table width="430" border="0">
    <tr>
      <td width="424"><div align="right"><span class="Estilo2"> <span class="Estilo91">(*)campos obligatorios</span></span><span class="s1"></span></div></td>
    </tr>
  </table>
  <table width="430" border="0">
    <tr>
      <td width="424" bgcolor="#00CC00"><span class="Estilo91">DATOS DEL ITEM</span></td>
    </tr>
  </table>
  <table width="428" border="0">
                           
                            <tr>
                              <td width="54"><span class="Estilo9">Tipo</span></td>
                              <td width="364"><label>
                                <input name="nombre" type="text" id="nombre" value="<? echo $reg[1]?>" size="25" maxlength="100" class="Estilo9"/>
                                <span class="Estilo9">(*) </span><span class="Estilo9">Codigo:<span class="Estilo2">
                                <input name="codigo" type="text" readonly id="codigo" value="<? echo $reg[0]?>"  size="10" class="Estilo9">
                              </span></span></label></td>
                            </tr>
                          </table>
                          <table width="430" border="0">
                            <tr>
                              <td width="136" bgcolor="#00CC00">&nbsp;</td>
                              <td width="86" bgcolor="#00CC00"><input type="submit" name="Submit" value="Actualizar" align="center"  onClick="guardar();" class="Estilo9"/></td>
                              <td width="65" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9" /></td>
                              <td width="125" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
                          </table>
                           <input name="guardar" type="hidden" id="guardar">
</form>

</body>

</html>
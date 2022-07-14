<?php

ini_set("session.gc_maxlifetime","30000");
session_start();

include("./clases/ClsAsigna.php");

$enlace=conexion();
	
mysql_select_db('dbpap', $enlace);
	
$Cod="";

$Cod=$_GET['Cod'];	   

if($Cod!='A'){
$sql_guardar1="select NombreCom,tbldetnivel.codigo,(SELECT NombreCom from tblusuario WHERE tblusuario.codigo=Personal) from tbldetnivel,tblusuario  WHERE tbldetnivel.Codigo=".$Cod."  and Tblusuario.codigo=Jefe; 
 ";
 
$res1 =mysql_query($sql_guardar1,$enlace); 

$reg = mysql_fetch_array($res1);
}

if($_SESSION["User"] != "1"){header("Index.php");}


//--


if(isset($_POST["guardar"])>0){
   $Asigna =new ClsAsigna;
   $Asigna->codigo=$_POST['codigo'];
   $Asigna->jefe =$_POST['jefe'];
   $ban=$Asigna->Modificar();
   
   if($ban==true){
	 
	  header("location:concluye.php?cod=12");
	  
   }
   else{
          echo "Error al Actualizar" ;
   }
}
?>

<html>
<head>
<title>Asignacion</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link type="text/css" rel="stylesheet" href="./css/jquery-ui-1.8.4.custom.css" /> 
        <script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="./js/jquery-ui-1.8.4.custom.min.js"></script>
       <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    
		<script type="text/javascript" src="./js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-1.8.13.custom.min.js"></script>

<script language="javascript">
function guardar(){
 
		document.f.guardar.value = "1";
		document.f.Cod.value = "A";
	
}
	
		function validar(f){
		if(f.jefe.value ==""){
			alert("Ingresar El Jefe");
			return false;
		}
		
			
		f.submit();
		return true;
	}
	
	
</script>


<script type="text/javascript">

            $(function(){
                $('#jefe').autocomplete({
                   source : 'ajax.php?cod=10'
                 
                   
                });
                 
				
            });
		
</script>
<style type="text/css">
<!--
body,img,p,h1,h2,h3,h4,h5,h6,form,table,td,ul,li,dl,dt,dd,pre,blockquote,fieldset,label{
				margin:0;
				padding:0;
				border:0;
			}
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
.s {
	text-align: right;
	font-size: 9px;
}
.Estilo2 {
}
.ww {
	border:1px solid black; padding:15px;
}
.Estilo11 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #FFFFFF;
	text-align: center;
}
.Estilo91 {	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmModiAsigna.php" method="post" onSubmit="return validar(this)" class="ww" >
  <table width="553" border="0">
    <tr>
      <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo11"><img src="modal/logo.png" width="552" height="98"></div></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" height="20" bgcolor="#0099FF"><div align="center" class="Estilo91">Asignacion De Personal</div></td>
    </tr>
  </table>
  <table width="553" border="0">
    <tr>
      <td width="547"><div align="right" class="Estilo91">(*)campos obligatorios</div></td>
    </tr>
  </table>
  <table width="550" border="0">
                            <tr>
                              <td width="108"><span class="Estilo9">Trabajador:</span></td>
                              <td width="432"><input name="NombreCom" type="text" disabled class="Estilo9"  id="NombreCom" value="<?echo $reg[2]?>" size="50" maxlength="100"/>
                              <span class="Estilo91">(*)</span></td>
                            </tr>
                          </table>
      <table width="551" border="0">
        <tr>
          <td width="105"><span class="Estilo9">Jefe/Encargado:</span></td>
          <td width="436"><input name="jefe" type="text" class="Estilo9"  id="jefe" value="<?echo $reg[0]?>" size="50" maxlength="100" />
          <span class="Estilo91">(*)</span></td>
        </tr>
      </table>
      <table width="556" border="0">
<tr>
                              <td width="207" bgcolor="#00CC00"><input name="guardar" type="hidden" id="guardar">
                              <input name="codigo" type="hidden" id="codigo" value="<? echo $reg[1]?>"></td>
                              <td width="79" bgcolor="#00CC00"><input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="65" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar"  class="Estilo9"/></td>
                              <td width="182" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
    </table>
</form>           

</body>

</html>
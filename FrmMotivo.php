<?php
include("./clases/ClsMotivo.php");
ini_set("session.gc_maxlifetime","30000");

session_start();

if($_SESSION["User"] != "1"){header("Index.php");}


if(isset($_POST["guardar"])>0){
	
   $Mot =new ClsMotivo();
  
   $Mot->nombre=$_POST['nombre'];
   
   $ban=$Mot->Crear();
   
   if($ban==true){
	    header("location:concluye.php?cod=11");
	  // echo "<script type='text/javascript'>"; 
	   //echo "alert ('Exito En El Registro');"; 
       //echo "; 
	        
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script language='javascript' src="popcalendar.js"></script> 

<script language="javascript">

function guardar(){
 
		document.usuario.guardar.value = "1";
	
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
	font-size: 18px;
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
}
.Estilo2 {
}
.Estilo11 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
}
.Estilo91 {	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.s1 {	text-align: right;
	font-size: 9px;
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmMotivo.php" method="post" onSubmit="return validar(this)" class="ww" >
  <table width="428" border="0">
    <tr>
      <td width="422" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo11"><img src="modal/logo.png"  width="425" height="98"></div></td>
    </tr>
  </table>
  <table width="430" border="0">
    <tr>
      <td width="424" height="18" bgcolor="#00CC33"><div align="center" class="Estilo91">Registro De Motivos</div></td>
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
  <table width="429" border="0">
                            <tr>
                              <td width="100" class="Estilo9">Descripcion</td>
                              <td width="319" class="Estilo9"><input name="nombre" type="text" id="nombre" size="40" maxlength="100"  class="Estilo9" />
                                (*)</td>
                            </tr>
                          </table>
                          <table width="430" border="0">
                            <tr>
                              <td width="138" bgcolor="#00CC00">&nbsp;</td>
                              <td width="79" bgcolor="#00CC00"><input type="submit" name="Submit" value="Registrar" align="center"  onClick="guardar();" class="Estilo9"/></td>
                              <td width="65" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar"  class="Estilo9"/></td>
                              <td width="130" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
                          </table>
                           <input name="guardar" type="hidden" id="guardar">
</form>
         

</body>

</html>
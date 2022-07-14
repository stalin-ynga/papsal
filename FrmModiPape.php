<?php

ini_set("session.gc_maxlifetime","30000");
session_start();

include('./clases/conexion.php');

$enlace=conexion();
	
mysql_select_db('dbpap', $enlace);
	
$Cod="";

$Cod=$_GET['Cod'];	   

if($Cod!='A'){
$sql_guardar1="select FecSalida,FecRetorno,Codigo,(SELECT NombreCom from tblusuario where tblusuario.codigo=Usuario) as Usuario,(CASE tblsalida.statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' else null end),Observacion,Lugar,Fundamento from tblsalida WHERE Codigo='".$Cod."'; 
 ";
 
$res1 =mysql_query($sql_guardar1,$enlace); 

$reg = mysql_fetch_array($res1);
}

if($_SESSION["User"] != "1"){header("Index.php");}


//--


if(isset($_POST["guardar"])>0){
	$codigo=$_POST['codigo'];
	$fecha1=$_POST['fecha1'];
	$fecha2=$_POST['fecha2'];
	$observa=$_POST['observacion'];
	$funda=$_POST['motivo'];
	$lugar=$_POST['lugar'];
	$tipo=$_POST['tipo'];
	
	
   $sql_guardar1="UPDATE tblsalida SET FecSalida='$fecha1', FecRetorno='$fecha2', Fundamento='$funda',Lugar='$lugar',Observacion='$observa' WHERE Codigo='$codigo';";
 
 $res1 =mysql_query($sql_guardar1,$enlace); 
 
 $sql_guardar1="CALL Sp_GenMarcadoDoc('$codigo');";
 
 $res1 =mysql_query($sql_guardar1,$enlace); 
	
	
	header("location:concluye.php?cod=19");
   
}
?>

<html>
<head>
<title>Ficha De Inscripcion</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  
<link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="jquery/js/jquery-1.10.2.js"></script>
	<script src="jquery/js/jquery-ui-1.10.4.custom.js"></script>
	<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>	


<script language="javascript">

 $(function(){
  //IDIOMA CALENDARIO
	  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: 'Atras',
 nextText: 'Siguiente',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

 $('#fecha1').datetimepicker({
	      dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo'
				});
 
 $('#fecha2').datetimepicker({
	      dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo'
				});
  
            });
function guardar(){
 
		document.f.guardar.value = "1";
		document.f.Cod.value = "A";
	
}

	function validar(f){
		if(f.fecha1.value ==""){
			alert("Ingresar La Fecha");
			return false;
		}
		
		if(f.fecha2.value ==""){
			alert("Ingresar La Fecha");
			return false;
		}			
		f.submit();
		return true;
	}
	
	
</script>


<style type="text/css">
<!--
body,img,form,table,td,ul,li,dl,dt,dd,pre,blockquote,fieldset{
				margin:0;
				padding:0;
				border:0;font: 80.5% "Trebuchet MS", sans-serif;
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
.ww {
	border:1px solid black; padding:15px;
}
.s {
	text-align: right;
	font-size: 9px;
}
.Estilo2 {
}
.Estilo91 {	font-size: 15px;
	font-family: "Lucida Console", Monaco, monospace;
}
.ta2 {	width:365px;
	height:60px;
	background-color:#99FFCC;
	border:1px solid #008800;
	font-size: 14px;
	font-family: "Lucida Console", Monaco, monospace;
}
.Estilo21 {	text-align: left;
}
.ta21 {	width:200px;
	height:60px;
	background-color:#99FFCC;
	border:1px solid #008800;
	font-size: 14px;
	font-family: "Lucida Console", Monaco, monospace;
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px; font-size: 14px;"><form name="f" action="FrmModiPape.php" method="post" onSubmit="return validar(this)" class="ww">
  <table width="467" border="0">
    <tr>
      <td width="461" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png" width="462" height="98"></div></td>
    </tr>
  </table>
  <table width="467" border="0">
    <tr>
      <td width="460" height="20" bgcolor="#0099FF"><div align="center" class="Estilo9">Modificar Documento</div></td>
    </tr>
  </table>
  <table width="467" border="0">
                            <tr>
                              <td width="548" bgcolor="#00CC00"><span class="Estilo9">DATOS DEL DOCUMENTO</span></td>
                            </tr>
      </table>
<table width="460" border="0">
                            <tr>
                              <td width="60"><span style="text-align: left">
                                <label><span class="Estilo9">Salida</span></label>
                              </span></td>
                              <td width="171"><span style="text-align: left">
                                <input name="fecha1" type="text" id="fecha1"  value="<? echo $reg[0]?>" size="19" class="Estilo9" >
                              </span></td>
                              <td width="215"><label><span class="Estilo9">Retorno</span></label>
                             
                              <input name="fecha2" type="text" id="fecha2"  value="<? echo $reg[1]?>" size="19" class="Estilo9" ></td>
                            </tr>
                          </table>
<table width="444" border="0">
  <tr>
    <td width="60"><span style="text-align: left">
      <label><span class="Estilo9">Usuario</span></label>
    </span></td>
    <td width="374"><span style="text-align: left">
      <input name="fecha3" type="text" id="fecha3"  value="<? echo $reg[3]?>"  disabled size="45" class="Estilo9" >
    </span></td>
  </tr>
</table>
<table width="445" border="0">
  <tr>
    <td width="60"><span style="text-align: left">
      <label><span class="Estilo9">Estado</span></label>
    </span></td>
    <td width="116"><span style="text-align: left">
      <input name="fecha4" type="text" id="fecha5"  value="<? echo $reg[4]?>" size="15" disabled class="Estilo9" >
    </span></td>
    <td width="255"><span class="Estilo9">Codigo</span>      <input name="fecha6" type="text" id="fecha6"  value="<? echo $reg[2]?>" size="20" class="Estilo9"  disabled></td>
  </tr>
</table>
<table width="465" border="0" class="Estilo9">
  <tr>
    <td width="61" class="Estilo9"> Motivo</td>
    <td width="394" class="Estilo9"><textarea name="motivo" cols="53" rows="4" class="ta2" id="motivo"  ><? echo $reg[7]?></textarea>
      (*)</td>
  </tr>
</table>
<table width="466" border="0">
  <tr>
    <td width="57">&nbsp;</td>
    <td width="204"><span class="Estilo9">Observacion</span></td>
    <td width="184"><span class="Estilo9">Lugar<span class="Estilo21"><span style="text-align: justify">
      <input name="lugar" type="text" class="Estilo9" id="lugar" value="<? echo $reg[6]?>" size="21">
    </span></span></span></td>
  </tr>
</table>
<table width="440" border="0">
  <tr>
    <td width="62">&nbsp;</td>
    <td width="368"><span class="Estilo21"><span class="Estilo9"><span style="text-align: justify">
      <textarea name="observacion" cols="15" rows="2" class="ta21" id="observacion"  ><? echo $reg[5]?></textarea>
    </span></span></span></td>
  </tr>
</table>
<table width="467" border="0">
<tr>
                              <td width="148" height="26" bgcolor="#00CC00"><input name="guardar" type="hidden" id="guardar">
                              <input name="Cod" type="hidden" id="Cod">
                              <input name="codigo" type="hidden" id="codigo" value="<? echo $reg[2]?>">
                              </td>
                              <td width="85" bgcolor="#00CC00"><input type="submit" name="Submit" value="Actualizar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="63" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9" /></td>
                              <td width="153" bgcolor="#00CC00">&nbsp;</td>
        </tr>
</table>
</form>           

</body>

</html>
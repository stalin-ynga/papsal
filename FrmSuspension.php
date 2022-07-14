<?php
include("./clases/ClsPapeletaSalida.php");
include_once('./clases/conexion.php');
//------------------------
$enlace=conexion();
	
mysql_select_db('dbpap', $enlace);

ini_set("session.gc_maxlifetime","30000");

$temp="";

$sql_guardar1="select Codigo,Nombre from tbltipomotivo;";

//------------------------
 
$res1 =mysql_query($sql_guardar1,$enlace); 

session_start();

if($_SESSION["User"] != "1"){header("Index.php");}

if(isset($_POST["guardar"])>0){
   $Salida =new ClsPapeletaSalida;
   $Salida->usuario=$_POST["NombreCom"];
   $Salida->tipo=$_POST['tipo'];
   $Salida->lugar=$_POST['destino'];
   $Salida->fundamento=$_POST['motivo'];
   $Salida->obser=$_POST['observacion'];
   $Salida->f1=$_POST['salida'];
   $Salida->f2=$_POST['retorno'];
   
   if(($Salida->f1) < ($Salida->f2)){
	   
   $ban=$Salida->CrearDocumento();
   
   if($ban==true){
	 //header("location:concluye2.php");
	 
	 if($_POST['avanzado']=='on'){header("location:Avanzado.php?tipo=$Salida->tipo&lugar=$Salida->lugar&funda=$Salida->fundamento&obser=$Salida->obser&salida=$Salida->f1&retorno=$Salida->f2");}
	 else{ header("location:concluye.php?cod=20");}
	 
                 }
   else{
        
       }
   }
   else{
	     echo "<script>alert('Verifique Las Fechas');</script>";   
   }
}

?>

<html>
<head>
<title>Ficha De Inscripcion</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="./css/estilo.css" />
        <script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="./js/jquery-ui-1.8.4.custom.min.js"></script>
       
        

		<script type="text/javascript" src="./js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>

<script type="text/javascript">
  jQuery(function() {
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
	 $('#NombreCom').autocomplete({
                   source : 'ajax.php?cod=1' });
	 
	 $('#salida').datetimepicker({
		  dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo'
				});
 
 $('#retorno').datetimepicker({
	      dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo'
				});
  
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
		if(f.destino.value ==""){
			alert("Ingresar El Destino");
			return false;
		}
		if(f.motivo.value ==""){
			alert("Ingresar El Fundamento Del Documento");
			return false;
		}
		if(f.salida.value==""){
			alert("Ingresar La Fecha De Salida");
			return false;
		}
		if(f.retorno.value==""){
			alert("Ingresar La Fecha De Retorno");
			return false;
		}
					
		f.submit();
		return true;
	}
</script>

	<style type="text/css">
			body,img,form,table,td,ul,li,dl,dt,dd,pre,blockquote,fieldset{
				margin:0;
				padding:0;
				border:0;font: 95.5% "Trebuchet MS", sans-serif;
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
.ww {
	border:1px solid black; padding:15px;
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
.Estilo91 {	font-size: 15px;
	font-family: "Lucida Console", Monaco, monospace;
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmAsignacion.php" method="post" onSubmit="return validar(this)"  class="ww">
  <table width="553" border="0">
    <tr>
      <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png" width="552" height="98"></div></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" height="20" bgcolor="#0099FF"><div align="center" class="Estilo9">Registro De Suspensiones</div></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" bgcolor="#0099FF"><span class="Estilo9">DATOS DEL SOLICITANTE</span></td>
    </tr>
</table>
<table width="556" border="0">
                            <tr>
                              <td width="90"><span class="Estilo9">Trabajador:</span></td>
                              <td width="456"><input name="NombreCom" type="text" class="tb61 Estilo9"  id="NombreCom" size="70" maxlength="100" /></td>
                            </tr>
      </table>
  <table width="556" border="0">
    <tr>
      <td width="550" bgcolor="#0099FF"><span class="Estilo9">DATOS DEL FORMATO</span></td>
    </tr>
  </table>
  <table width="561" height="27" border="0">
<tr>
                              <td width="97"><span class="Estilo9">Documento:</span></td>
                              <td width="216"><span style="text-align: center"><span class="Estilo2">
 <select name="tipo" class="tb6 Estilo9" id="tipo">
  <?
  while ($reg = mysql_fetch_array($res1))
               {$temp.=' <option value="'.$reg[0].'">'.$reg[1].'</option> ';  }
    $options=' ';   
	
	$options.=$temp; 
    echo $options;  
  ?>
 </select>
 (*)</span></span></td>
                              <td width="49"><span class="Estilo9">Lugar</span></td>
                              <td width="209"><span class="Estilo2">
                                <input name="destino" type="text" class="tb6 Estilo9" id="destino" value="" >
                              </span></td>  
                             
        </tr>
                            <tr>
                             
                            </tr>
      </table>
                          <table width="555" border="0">
                            <tr>
                              <td width="92" height="82"><span class="Estilo9">Fundamento:</span></td>
                              <td width="453"><span style="text-align: justify">
                                <textarea name="motivo" cols="53" rows="4" class="ta2" id="motivo"  ></textarea>
                              </span></td>
                            </tr>
      </table>
                          <table width="554" border="0">
                            <tr>
                              <td width="89"><span class="Estilo9">Fecha De Salida:</span></td>
                              <td width="206"><span class="Estilo2">
                                <input name="salida" type="text" class="tb6 Estilo9" id="salida" value="" readonly>(*</span><span class="Estilo2">)</span></td>
                              <td width="37">&nbsp;</td>
                              <td width="204"><span class="ui-widget-header">Observacion </span> <---->Avanzado
                              <input type="checkbox" name="avanzado" id="avanzado"></td>
                             
                            </tr>
                            
                          </table>
                          <table width="560" border="0">
                            <tr>
                              <td width="90"><span class="Estilo9">Fecha De Retorno:</span></td>
                              <td width="199"><span class="Estilo2">
                                <input name="retorno" type="text" class="tb6 Estilo9" id="retorno" value="" readonly>(*)                              </span></td>
                              <td width="39">&nbsp;</td>
                              <td width="214"><span class="Estilo2"><span style="text-align: justify">
                                <textarea name="observacion" cols="15" rows="2" class="ta21" id="observacion" ></textarea>
                              </span></span></td>
                            </tr>
                          </table>
<table width="555" border="0">
                            <tr>
                              <td width="208" bgcolor="#00CC00"><input name="guardar" type="hidden" id="guardar"></td>
                              <td width="77" bgcolor="#00CC00"><input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="63" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar"  class="Estilo9"/></td>
                              <td width="189" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
      </table>
</form>           

</body>

</html>
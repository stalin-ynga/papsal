<!-- http://ProgramarEnPHP.wordpress.com -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Importar de Excel a la Base de Datos ::</title>

<link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
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
	 $('#fec').datepicker({
		  dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo'
				});
 
 
  
  });</script> 
  <script type="text/javascript">
  function validar(f){
		if(importa.fec.value ==""){
			alert("Ingresar La Fecha");
			return false;
		}
		if(importa.archivo.value ==""){
			alert("Cargar Primero El Archivo");
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
.Estilo9 {font-size: 12px}
.s {
	text-align: right;
}
.Estilo2 {
	font-size: 12px;
	color: #3C0;
}
.s {
	font-family: "Lucida Console", Monaco, monospace;
	color: #333;
	text-align: left;
}
.d {
	color: #00C;
}
.Estilo2 {
	color: #036;
}
.Estilo1 {
	color: #000;
}
.tb6 {	border: 3px double #CCCCCC;
	width: 180px;
	text-align: left;
}
.Estilo11 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #FFFFFF;
	text-align: center;
}
.Estilo911 {font-size: 15px;
	font-family: "Lucida Console", Monaco, monospace;
}
.Estilo91 {	font-size: 12px;
	text-align: left;
}
.Estilo91 {font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
-->
</style>
</head>

<body>
<!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL -->
<center>
<form name="importa" method="post" action="CargaReloj.php" enctype="multipart/form-data" onSubmit="return validar(this)" >
  <table width="470" border="0">
    <tr>
      <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo11"><img src="modal/logo.png" alt="" width="466" height="98"></div></td>
    </tr>
  </table>
  <table width="470" border="0">
    <tr>
      <td width="464" height="20" bgcolor="#0099FF"><div align="center" class="Estilo911">Subir Marcado Diario</div></td>
    </tr>
  </table>
  <table width="473" border="0">
                            
  </table>
  <table width="474" border="0">
                            
  </table>
<table width="468" border="0">
                           
                            <tr>
                              <td width="462"><label><span class="Estilo2"><span class="Estilo2">(*)</span><span class="Estilo91">Selecciona el archivo a importar</span></span></label></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo91">Archivo:</span>
                                <input type="file" name="excel" id="archivo"/>
<input type='submit' name='enviar'  value="Importar"  />
<input type="hidden" value="upload" name="action" /></td>
                            </tr>
  </table>
  <table width="468" border="0">
                            <tr>
                              <td width="56" height="29" ><div align="center" class="Estilo1"><span class="Estilo91">Fecha:</span></div></td>
                              <td width="156" ><input type="text" name="fec" id="fec" value="" readonly></td>
                              <td width="242" ><select name="tipos" class="tb6" id="tipos">
                                                               <option value="01">SIN TOLERANCIA</option>
                                <option value="02">CON TOLERANCIA</option>
                           
                              </select></td>
                            </tr>
                          </table>
                          <table width="468" border="0">
                            <tr>
                              <td width="164" bgcolor="#00CC00">&nbsp;</td>
                              <td width="60" bgcolor="#00CC00">&nbsp;</td>
                              <td width="60" bgcolor="#00CC00">&nbsp;</td>
                              <td width="166" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
  </table>
</form>
<!-- CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload -->

<?php

include("./clases/conexion.php");

$action="lol";
extract($_POST);

if ($action == "upload") //si action tiene como valor UPLOAD haga algo (el value de este hidden es es UPLOAD iniciado desde el value
{
//cargamos el archivo al servidor con el mismo nombre(solo le agregue el sufijo bak_)
$archivo = $_FILES['excel']['name']; //captura el nombre del archivo
$tipo = $_FILES['excel']['type']; //captura el tipo de archivo (2003 o 2007)

$destino = "bak_".$archivo; //lugar donde se copiara el archivo

if (copy($_FILES['excel']['tmp_name'],$destino)) //si dese copiar la variable excel (archivo).nombreTemporal a destino (bak_.archivo) (si se ha dejado copiar)
{
echo "Archivo Cargado Con Exito";
}
else
{
echo "Error Al Cargar el Archivo";
}

////////////////////////////////////////////////////////
if (file_exists ("bak_".$archivo)) //validacion para saber si el archivo ya existe previamente
{
	/* ELIMINADOS TODO EL CONTENIDO DE LA TABLA VOLCADO*/

	
/*INVOCACION DE CLASES Y CONEXION A BASE DE DATOS*/
/** Invocacion de Clases necesarias */
require_once('./Classes/PHPExcel.php');
require_once('./Classes/PHPExcel/Reader/Excel2007.php');
//DATOS DE CONEXION A LA BASE DE DATOS
$cn = mysql_connect ("localhost","root","") or die ("ERROR EN LA CONEXION");
$db = mysql_select_db ("dbpap",$cn) or die ("ERROR AL CONECTAR A LA BD");

$cns=("DELETE FROM tblvolcado");
mysql_query($cns);

// Cargando la hoja de calculo
$objReader = new PHPExcel_Reader_Excel2007(); //instancio un objeto como PHPExcelReader(objeto de captura de datos de excel)
$objPHPExcel = $objReader->load("bak_".$archivo); //carga en objphpExcel por medio de objReader,el nombre del archivo
$objFecha = new PHPExcel_Shared_Date();

// Asignar hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0); //objPHPExcel tomara la posicion de hoja (en esta caso 0 o 1) con el setActiveSheetIndex(numeroHoja)

// Llenamos un arreglo con los datos del archivo xlsx
$i=1; //celda inicial en la cual empezara a realizar el barrido de la grilla de excel
$param=0;
$contador=0;
while($param==0) //mientras el parametro siga en 0 (iniciado antes) que quiere decir que no ha encontrado un NULL entonces siga metiendo datos
{

$codigo=$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
$corre=$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
$gen=$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
$hora=$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
$fecha=$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
//$fecha=DateTime::createFromFormat('yyyy-mm-dd', $fecha);
//echo $fecha;
//echo "Necesitas primero importar el archivo";}
$c=("insert into tblvolcado values($codigo,'$fecha',$corre,$gen,$hora)");
mysql_query($c);
set_time_limit(50000); 
//procedemos a generar el marcado en el sistema con la fecha respectiva


//-LUEGO PASAMOS A REALIZAR EL VOLCADO DE LA MARCACION CON EL ARCHIVO SUBIDO
          
//-------------------------------------------
if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()==NULL) //pregunto que si ha encontrado un valor null en una columna inicie un parametro en 1 que indicaria el fin del ciclo while
{
$param=1; //para detener el ciclo cuando haya encontrado un valor NULL
}
$i++;
$contador=$contador+1;
}
$totalIngresados=$contador-1; //(porque se se para con un NULL y le esta registrando como que tambien un dato)
echo "<-->Total Registros Subidos xxx: $totalIngresados ";
}
else//si no se ha cargado el bak
{
echo "Necesitas primero importar el archivo";}
unlink($destino); //desenlazar a destino el lugar donde salen los datos(archivo)
	   
	   echo $tipos;
	   
      $enlace=conexion();
      mysql_select_db('dbpap', $enlace);   

	  $sql_guardar="CALL sp_GeneracionMarcacion2016('$fec','$tipos'); ";
      
	  //$sql_guardar="CALL Sp_GeneraMarcacion('$fec','$tipos'); ";
	  echo "<-->pendiente ";
	  mysql_query($sql_guardar,$enlace);
	  echo "<-->paso ";
}
?>
</body>
</html>
<?php
include("./clases/ClsPapeletaVehicular.php");
ini_set("session.gc_maxlifetime","30000");

session_start();

if($_SESSION["User"] != "1"){header("Index.php");}

if(isset($_POST["guardar"])>0){
   $Vehicular =new ClsPapeletaVehicular;
   $Vehicular->usuario=$_SESSION["Codigo"];
   $Vehicular->destino=$_POST['destino'];
   $Vehicular->observacion=$_POST['observacion'];
   $Vehicular->vehiculo=trim($_POST['vehiculo']);
   $Vehicular->fecha=$_POST['salida'];
  
  
   $ban=$Vehicular->CrearVehicular();
   
   if($ban==true){
	 header("location:concluye.php?cod=1");
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
	<script src="jquery/js/jquery-1.10.2.js"></script>
	<script src="jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">

  jQuery(function() {
      $('#vehiculo').autocomplete({
                   source : 'ajax.php?cod=6' });
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
	 //
	 $('#salida').datepicker({
		
		  dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo',
minDate:-1,
maxDate:2
				});
 
  
  });
  
  </script> 
  <script type="text/javascript">
   $( "#dialog1" ).dialog({ autoOpen: false });
   $( "#dialog2" ).dialog({ autoOpen: false });
    $( "#dialog3" ).dialog({ autoOpen: false });

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
		if(f.vehiculo.value ==""){
			//
			$(function() {
    $( "#dialog1" ).dialog({
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
			
			//
			return false;
		}
		if(f.destino.value ==""){
			//
			$(function() {
    $( "#dialog2" ).dialog({
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
			
			//
			return false;
		}
		if(f.salida.value==""){
			//
			$(function() {
    $( "#dialog3" ).dialog({
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
			
			//
			return false;
		}
		if(f.observacion.value==""){
			//
			$(function() {
    $( "#dialog4" ).dialog({
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
			
			//
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
				border:0;font: 80.5% "Trebuchet MS", sans-serif;
			}

		</style>


<style type="text/css">
<!--


.ta2 {
	width:415px;
	height:60px;
	background-color:#99FFCC;
	border:1px solid #008800;
	font-size: 14px;
	font-family: "Lucida Console", Monaco, monospace;
}


.ta21 {
	width:200px;
	height:60px;
	background-color:#99FFCC;
	border:1px solid #008800;
	font-size: 14px;
	font-family: "Lucida Console", Monaco, monospace;
}

.Estilo9 {
	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.Estilo91 {
	font-size: 15px;
	font-family: "Lucida Console", Monaco, monospace;
}
.s {
	text-align: right;
}
.Estilo2 {
	text-align: left;
}

.ww {
	border:1px solid black; padding:15px;
}

	
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmVehiSal.php" method="post" onSubmit="return validar(this)" class="ww" >
  <table width="553" border="0">
    <tr>
      <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png" alt="" width="552" height="98"></div></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" height="20" bgcolor="#0099FF"><div align="center" class="Estilo91">Papeleta Vehicular</div></td>
    </tr>
  </table>
  <table width="553" border="0">
    <tr>
      <td width="547"><div align="right" class="Estilo9">(*)campos obligatorios</div></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" bgcolor="#0099FF"><span class="Estilo9">DATOS DEL SOLICITANTE</span></td>
    </tr>
  </table>
  <table width="558" border="0">
    <tr>
      <td width="90"><span class="Estilo9">Ap.Paterno:</span></td>
      <td width="174" class="Estilo9"><label>
        <input name="pat" type="text"  disabled class="ui-state-focus Estilo9" id="pat" value="<? echo $_SESSION["Paterno"] ?>"  size="21" maxlength="100" />
      </label></td>
      <td width="100"><span class="Estilo9">Ap. Materno:</span></td>
      <td width="176"><input name="mat" type="text" disabled class="ui-state-focus Estilo9" id="mat" value="<? echo $_SESSION["Materno"] ?>" size="21" maxlength="100" /></td>
    </tr>
  </table>
  <table width="558" border="0">
    <tr>
      <td width="92" class="Estilo9"> Nombres:</td>
      <td width="456"><input name="nom" type="text" disabled class="ui-state-focus Estilo9" id="nom" value="<? echo $_SESSION["Nombre"] ?>" size="56" maxlength="100" /></td>
    </tr>
  </table>
  <table width="557" border="0">
    <tr>
      <td width="90"><span class="Estilo9">Oficina:</span></td>
      <td width="255"><input name="oficina" type="text"  disabled class="ui-state-focus Estilo9" id="oficina" value="<? echo $_SESSION["Area"] ?>" size="30" maxlength="100"/></td>
      <td width="59"><span class="Estilo9">Regimen:</span></td>
      <td width="135"><span class="Estilo2">
        <input name="condicion" type="text" disabled class="ui-state-focus Estilo9" id="condicion" value="<? echo $_SESSION["Condicion"] ?>" size="16" maxlength="100" />
      </span></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" bgcolor="#0099FF"><span class="Estilo9">DATOS DEL FORMATO</span></td>
    </tr>
  </table>
  <table width="557" border="0">
                            <tr>
                              <td width="95"><span class="Estilo9">Vehiculo:</span></td>
                              <td width="452" class="Estilo9"><input name="vehiculo" type="text"  class="Estilo9" id="vehiculo" size="59" maxlength="100"  />
                              <span class="Estilo2">(*)</span></td>
                            </tr>
      </table>
                          <table width="553" border="0">
                            <tr>
                              <td width="94"><span class="Estilo9">Destino:</span></td>
                              <td width="215"><input name="destino" type="text"   class="Estilo9" id="destino" size="21" maxlength="100"/>
                              <span class="Estilo9">(*)</span></td>
                              <td width="52"><span class="Estilo9">Fecha:</span></td>
                              <td width="174"><span class="Estilo9">
                                <input name="salida" type="text" class="Estilo9" id="salida" value="" size="20" readonly>
                              (*)</span></td>
                            </tr>
                          </table>
                          <table width="555" border="0">
                            <tr>
                              <td width="96"><span class="Estilo9">Observaciones:</span></td>
                              <td width="449" class="Estilo9"><span style="text-align: justify">
                              <textarea name="observacion" cols="44" rows="4" class="ta2" id="observacion"  ></textarea>
                              <span class="Estilo2"> (*)</span></span></td>
                            </tr>
</table>
                          <table width="556" border="0">
                            <tr>
                              <td width="212" bgcolor="#0099FF">&nbsp;</td>
                              <td width="77" bgcolor="#0099FF"><input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="63" bgcolor="#0099FF"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9" /></td>
                              <td width="185" bgcolor="#0099FF">&nbsp;</td>
                            </tr>
                          </table>
                          <span class="Estilo3">
                          <input name="guardar" type="hidden" id="guardar">
      </span>
</form>           
<div id="dialog1" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Vehiculo
  </p>
  
</div>

<div id="dialog2" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Destino
  </p>
  
</div>

<div id="dialog3" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Fecha De Salida
  </p>
  
</div>
<div id="dialog4" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Observacion
  </p>
  
</div>
<script>
$( "#dialog1" ).dialog({ autoOpen: false });
$( "#dialog2" ).dialog({ autoOpen: false });
$( "#dialog3" ).dialog({ autoOpen: false });
$( "#dialog4" ).dialog({ autoOpen: false });
</script>

</body>

</html>
<?php
include("./clases/ClsPapeletaSalida.php");
ini_set("session.gc_maxlifetime","30000");
session_start();

if(!isset($_POST["guardar"])>0){
//----- OBTENCION DE LA HORA
 $Sa =new ClsPapeletaSalida;
 $a=$Sa->Ano();
 $m=$Sa->Mes()-1;
 $d=$Sa->Dia();
 $d2=$d+2;
 $Sa->usuario=$_SESSION['Codigo'];
 $con=$Sa->Evalua();

}
//-----

// OBTENER IP DE CONEXION
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
}

$ipcliente=getRealIP();
// echo "Te conectas desde: ".$ipcliente;



if($_SESSION["User"] != "1"){header("Index.php");}

if(isset($_POST["guardar"])>0){
	
   $Salida =new ClsPapeletaSalida;
   $Salida->usuario=$_SESSION["Codigo"];
   $Salida->tipo=$_POST['tipo'];
   $Salida->lugar=$_POST['lugar'];
   $Salida->fundamento=$_POST['motivo'];
   $Salida->obser=$_POST['observacion'];
   $Salida->f1=$_POST['salida'];
   $Salida->f2=$_POST['retorno'];
   $Salida->ip=$ipcliente;
   $Salida->auto=$_POST['vehiculo'];

   $ban=$Salida->CrearSalida();
   
   if($ban==true){
   header("location:concluye.php?cod=1");
   }
   else{
        
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
    
<? 
 if($con=='NP'){ ?>
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
	 $('#salida').datetimepicker({
		
		  dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo',
	minDate: -1,
	maxDate: 2
	
				});
				
 
  
  });
  
  </script> 
  <script type="text/javascript">
  $( "#dialog1" ).dialog({ autoOpen: false });
   $( "#dialog2" ).dialog({ autoOpen: false });
    $( "#dialog3" ).dialog({ autoOpen: false });


function guardar(){
 
		document.usuario.guardar.value = "1";
	
}

function opcion(){
	if(document.getElementById('op').checked == true)
	{ 
		 puntero=document.getElementById('vehiculo');
  puntero.removeAttribute('disabled');
	}else{
		puntero=document.getElementById('vehiculo');
  puntero.setAttribute('disabled','disabled');
  document.getElementById('vehiculo').value="";;
	}
}


	function validar(f){
		if(f.lugar.value ==""){
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
		if(f.motivo.value ==""){
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
		
					
		f.submit();
		return true;
	}
</script>
<? } ?>    
    
<? if($con=='AP'){ ?>
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
	 $('#salida').datetimepicker({
		
		  dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo',
	minDate: new Date((document.getElementById('ano').value), (document.getElementById('mes').value), (document.getElementById('dia').value), 8, 11),
	maxDate: new Date((document.getElementById('ano').value), (document.getElementById('mes').value), (document.getElementById('dia2').value), 17, 15)
,hourMax: 17,hourMin:8,minuteMin:11
				});
				
 
  
  });
  
  </script> 
  <script type="text/javascript">
  $( "#dialog1" ).dialog({ autoOpen: false });
   $( "#dialog2" ).dialog({ autoOpen: false });
    $( "#dialog3" ).dialog({ autoOpen: false });
     

function guardar(){
 
		document.usuario.guardar.value = "1";
	
}

function opcion(){
	if(document.getElementById('op').checked == true)
	{ 
		 puntero=document.getElementById('vehiculo');
  puntero.removeAttribute('disabled');
	}else{
		puntero=document.getElementById('vehiculo');
  puntero.setAttribute('disabled','disabled');
  document.getElementById('vehiculo').value="";;
	}
}


	function validar(f){
		if(f.lugar.value ==""){
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
		if(f.motivo.value ==""){
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
		
					
		f.submit();
		return true;
	}
</script>
<? } ?>
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
	width:430px;
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

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px">
<form name="f" action="FrmSalida.php" method="post" onSubmit="return validar(this)" class="ww" >
  <table width="553" border="0">
<tr>
          <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png" width="552" height="98"></div></td>
        </tr>
      </table>
  <table width="556" border="0">
    <tr>
      <td width="550" height="20" bgcolor="#0099FF"><div align="center" class="Estilo91">Papeleta De Salida</div></td>
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
                              <td width="88"><span class="Estilo9"> Tipo Salida:</span></td>
                              <td width="186"><span style="text-align: center"><span class="Estilo2">
                                <select name="tipo" class="Estilo9" id="tipo">
                                  <option value="0000000001">COMISION</option>
                                  <option value="0000000002">SALUD</option>
                                                                    <option value="0000000004">PARTICULAR (DSCTO)</option>
                                                                    <option value="0000000006">ONOMASTICO</option>
                                </select>
                              </span></span></td>
                              <td width="89"><span class="Estilo9">Destino:</span></td>
                              <td width="176"><input name="lugar" type="text" class="Estilo9" id="lugar" size="20">
                              <span class="Estilo9">(*)</span></td>  
                             
                            </tr>
      </table>
                          <table width="555" border="0" class="Estilo9">
                            <tr>
                              <td width="91" class="Estilo9"> Motivo:</td>
                              <td width="454" class="Estilo9">
                              <textarea name="motivo" cols="53" rows="4" class="ta2" id="motivo"  ></textarea>(*)</td>
                            </tr>
      </table>
                          <table width="556" border="0">
                            <tr>
                              <td width="90"><span class="Estilo9"> Hora De Salida:</span></td>
                              <td width="218"><span class="Estilo2">
                                <input name="salida" type="text" class="Estilo9" id="salida" value="" readonly>
                                <span class="Estilo9">(*)</span></span></td>
                              <td width="54"><span class="Estilo9">Hora De Retorno:</span></td>
                              <td width="176"><span class="Estilo9"><span class="Estilo2">
                                <input name="retorno" type="text" class="Estilo9" id="retorno" value="" readonly >(*)</span></span></td>
                            </tr>
                          </table>
      <table width="549" border="0">
                            <tr>
                              <td width="90"><span class="Estilo9"> Observacion:</span></td>
                              <td width="213"><span class="Estilo2"><span class="Estilo9"><span style="text-align: justify">
                                <textarea name="observacion" cols="15" rows="2" class="ta21" id="observacion"  ></textarea>
                              </span></span></span></td>
                              <td width="34" align="center">&nbsp;</td>
                              <td width="194"><span class="Estilo2">
                              <input type="checkbox" name="op" id="op" onClick="opcion();">
                              <input name="vehiculo" type="text" class="Estilo9" id="vehiculo" value="" placeholder="Vehiculo D.R.S.A.U" disabled >
                              <label for="checkbox"></label>
                              <input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" />
                              <input type="reset" name="Submit2" value="Limpiar" class="Estilo9" />
                              </span></td>
                            </tr>
      </table>
      <table width="556" border="0">
        <tr>
          <td width="550" bgcolor="#0099FF" class="Estilo9">(*) Verifique bien las fechas y datos, asi evitara problemas futuros (UPER)</td>
        </tr>
      </table>
      <input name="guardar" type="hidden" id="guardar">
      <input name="ano" type="hidden" id="ano" value="<? echo $a; ?>">
      <input name="mes" type="hidden" id="mes" value="<? echo $m; ?>">
      <input name="dia" type="hidden" id="dia" value="<? echo $d; ?>">
        <input name="dia2" type="hidden" id="dia2" value="<? echo $d2; ?>">
</form>           
<div id="dialog1" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Destino
  </p>
  
</div>

<div id="dialog2" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Motivo
  </p>
  
</div>

<div id="dialog3" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Hora De Salida
  </p>
  
</div>
<script>
$( "#dialog1" ).dialog({ autoOpen: false });
$( "#dialog2" ).dialog({ autoOpen: false });
$( "#dialog3" ).dialog({ autoOpen: false });
</script>
</body>

</html>
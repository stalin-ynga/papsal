<?php
include("./clases/ClsPapeletaTardanza.php");

ini_set("session.gc_maxlifetime","30000");

session_start();

if($_SESSION["User"] != "1"){header("Index.php");}

$Hora=new ClsPapeletaTardanza;//objeto de la hora
$hor=$Hora->HoraActual();//captura la hora del servidor

if(isset($_POST["guardar"])>0){
   $Tardanza =new ClsPapeletaTardanza;
   $Tardanza->usuario=$_SESSION["Codigo"];
   $Tardanza->marca=$_POST['marca'];
   $Tardanza->fundamento=$_POST['fundamento'];
   $Tardanza->motivo=$_POST['motivo'];
   $Tardanza->f1=$_POST['salida'];
  
  
   $ban=$Tardanza->CrearTardanza();
   
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
		if(f.fundamento.value ==""){
			
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
			body,img,form,table,td,ul,li,dl,dt,dd,pre,blockquote,fieldset{
				margin:0;
				padding:0;
				border:0;font: 62.5% "Trebuchet MS", sans-serif;
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

<td colspan="2" align="left" bgcolor="#000000" style="height: 3px">
<form name="f" action="FrmTardanza.php" method="post" onSubmit="return validar(this)" class="ww" >
  <table width="553" border="0">
<tr>
          <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png" width="552" height="98"></div></td>
        </tr>
      </table>
  <table width="556" border="0">
    <tr>
      <td width="550" height="20" bgcolor="#0099FF"><div align="center" class="Estilo91">Papeleta De Tardanza</div></td>
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
                              <td width="92" class="Estilo9"><span class="Estilo9"> Nombres:</span></td>
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
      <table width="556" border="0" class="Estilo9">
                            <tr>
                              <td width="90"><span class="Estilo9">Motivo:</span></td>
                              <td width="100"><span style="text-align: center"><span class="Estilo2">
                                <select name="motivo" class="Estilo9" id="motivo">
                                  
                                  <option value="0000000002">SALUD</option>
                                  <option value="0000000003">PERSONAL</option>
                                  <option value="0000000004">PARTICULAR</option>
                                  
                                </select>
                              </span></span></td>
                              <td width="149" class="Estilo9">Marcado a justificar:</span></td>
                              <td width="199" class="Estilo9">
<select name="marca" class="Estilo9" id="marca">
                                  <option value="EN1">ENTRADA DRSAU</option>
                                 
                                  <option value="EN2">ENTRADA REFRIGERIO</option>
                                  
                              </select>
                             (*)</td>  
                             
                            </tr>
      </table>
                          <table width="554" border="0">
                            <tr>
                              <td width="92"><span class="Estilo9">Fundamento:</span></td>
                              <td width="452" class="Estilo9">
                              <textarea name="fundamento" cols="53" rows="4" class="ta2" id="fundamento"   ></textarea>(*)</td>
                            </tr>
      </table>
                          <table width="547" border="0" class="Estilo9">
                            <tr>
                              <td width="91" class="Estilo9">Hora:</td>
                              <td width="274" class="Estilo9">
                                <input name="salida" type="text" class="Estilo9" id="salida" value="<? echo $hor;?>" readonly >
                                (*)</td>
                              <td width="77"><input type="submit" name="Submit" id="dia" value="Registrar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="87"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9" /></td>
                            </tr>
      </table>
                          <table width="556" border="0">
                            <tr>
                              <td width="550" bgcolor="#0099FF" class="Estilo9">(*) Verifique bien las fechas y datos, asi evitara problemas futuros (UPER)</td>
                            </tr>
                          </table>
                          
                          <input name="guardar" type="hidden" id="guardar">
     
    
</form>           
<div id="dialog" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Fundamento
  </p>
  
</div>
<script>
$( "#dialog" ).dialog({ autoOpen: false });
</script>
</body>

</html>
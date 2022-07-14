

<html>
<head>
<title>Ficha De Inscripcion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="jquery/js/jquery-1.10.2.js"></script>
	<script src="jquery/js/jquery-ui-1.10.4.custom.js"></script>


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
		if(f.fundamento.value ==""){
			alert("Ingresar El Fundamento");
			return false;
		}
		
		if(f.salida.value==""){
			alert("Ingresar La Fecha");
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

.tb61 {
	border: 3px double #CCCCCC;
	width: 450px;
}
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
	height:40px;
	background-color:#99FFCC;
	border:1px solid #008800;
}

.tb6 {	border: 3px double #CCCCCC;
	width: 180px;
	text-align: left;
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

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmTardanza.php" method="post" onSubmit="return validar(this)" class="ww" >
  <table width="553" border="0">
<tr>
          <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="logo.png" width="552" height="98"></div></td>
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
                              <td width="199">
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
                              <td width="91">Hora Entrada:</td>
                              <td width="274">
                                <input name="salida" type="text" class="Estilo9" id="salida" value="<? echo $hor;?>" readonly >
                                (*)</td>
                              <td width="77"><input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="87"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9" /></td>
                            </tr>
      </table>
                          <table width="556" border="0">
                            <tr>
                              <td width="550" bgcolor="#0099FF" class="Estilo9">(*) Verifique bien las fechas y datos, asi evitara problemas futuros (UPER)</td>
                            </tr>
                          </table>
                          
                          <input name="guardar" type="hidden" id="guardar">
      </span>
</form>           

</body>

</html>
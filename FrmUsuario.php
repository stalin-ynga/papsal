<?php
include("./clases/ClsUsuario.php");
ini_set("session.gc_maxlifetime","30000");
session_start();

if($_SESSION["User"] != "1"){header("Index.php");}


if(isset($_POST["guardar"])>0){
   $Usuario =new ClsUsuario;
   $Usuario->paterno=utf8_encode($_POST['pat']);
   $Usuario->materno=utf8_encode($_POST['mat']);
   $Usuario->nombres=utf8_encode($_POST['nom']);
   $Usuario->sexo=$_POST['sexo'];
   $Usuario->dni=$_POST['dni'];
   $Usuario->area=$_POST['area'];
   $Usuario->condicion=$_POST['condicion'];
   $Usuario->cargo=$_POST['cargo'];
   $Usuario->user=$_POST['user'];
   $Usuario->pass=$_POST['pass'];
   $Usuario->sueldo=$_POST['sueldo'];
   $Usuario->acceso=$_POST['acceso'];
   $Usuario->en=$_POST['entrada'];
   $Usuario->sal=$_POST['salida'];
   $ban=$Usuario->Crear();
   
   if($ban==true){

	  header("location:concluye.php?cod=9");
 
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
<script language="javascript">

function checkDecimals(fieldName, fieldValue) {

decallowed = 2;  // how many decimals are allowed?



if (isNaN(fieldValue) || fieldValue == "") {

alert("Eso no parece ser un número válido. Prueba de nuevo.");

// fieldName.select();

document.f.sueldo.focus();

}

else {

if (fieldValue.indexOf('.') == -1) fieldValue += ".";

dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);



if (dectext.length > decallowed)

{

alert ("Por favor, entra un número con " + decallowed + " números decimales.");

document.f.sueldo.focus();

      }
else {
      }
   }

}

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
 
		document.f.guardar.value = "1";
	
}

	function validar(f){
		if(f.pat.value ==""){
			alert("Ingresar Su Apellido Paterno");
			return false;
		}
		if(f.mat.value==""){
			alert("Ingresar Su Apellido Materno");
			return false;
		}
		if(f.nom.value==""){
			alert("Ingresar Su Nombre Completo");
			return false;
		}
		if(f.sexo.value==""){
			alert("Ingresar Su Sexo");
			return false;
		}
		if(f.dni.value==""){
			alert("Ingresar Su Dni");
			return false;
		}
		if(f.area.value==""){
			alert("Ingresar Su Area De Trabajo");
			return false;
		}
		if(f.condicion.value==""){
			alert("Ingresar Su Condicion Laboral");
			return false;
		}
		
		if(f.cargo.value==""){
			alert("Ingresar Su Cargo Laboral");
			return false;
		}
		if(f.user.value==""){
			alert("Ingresar Su Usuario");
			return false;
		}
		
		if(f.pass.value==""){
			alert("Ingresar Su Password");
			return false;
		}
		
		if(f.acceso.value==""){
			alert("Ingresar El Acceso");
			return false;
		}
					
		f.submit();
		return true;
	}
	
	
</script>
<script type="text/javascript">
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
	 //
	   
				 $('#entrada').datepicker({
		  dateFormat: 'yy-mm-dd'
		 
				});
  $('#salida').datepicker({
		  dateFormat: 'yy-mm-dd'
		 
				});
 
                $('#area').autocomplete({
                   source : 'ajax.php?cod=2'
                 
                   
                });
				$('#acceso').autocomplete({
                   source : 'ajax.php?cod=4'
                 
});
            });
		
</script>
<script type="text/javascript">
	        $(document).ready(function(){
                $('#user').focusout(function(){		  		//usuario es el id del input a validar
                            if($('#user').val()!= ""){ 		// si el input está vacio no sera necesaria una validacion
                            $.ajax({
                                type: "POST",			  		//Metodo de envio de los datos
                                url: "acceso/comprobar.php",	//script que se usara para la validacion del nick
                                data: "user="+$('#user').val(),	//Enviamos el valor que esta en el input
                                beforeSend: function(){
                                    $('div#estadoUser').html('Verificando...');	//Antes de recibir la respuesta se mostrara el mensaje verificando... 
                                },
                                success: function( respuesta ){
                                    if (respuesta == "0")	//Si la respuesta es 0 el nick NO esta disponible
									{						//Entonces en el div mostramos el mensaje de error
                                    $('div#estadoUser').html("<div style='color:red;'><img height='16' src='images/error.png'>Ya Existente</div>");
									$('#user').val ("");	//Borramos el input ya que el nick es incorrecto
									}
                                    else					//Si la respuesta es 1 el nick SI esta disponible
                                    $('div#estadoUser').html("<div style='color:#04B431;'><img height='16' src='images/check.png'>Disponible</div>");
                            }
                        });
                    }
                });
            });
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
	border:1px solid black; padding:10px;
}
.s {
	text-align: right;
	font-size: 9px;
}
.Estilo2 {
}
.Estilo91 {	font-size: 12px;
	color: #000;
	text-align: right;
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmUsuario.php" method="post" onSubmit="return validar(this)" class="ww" >
<table width="457" border="0">
<tr>
          <td width="451" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png"  width="456" height="98"></div></td>
        </tr>
      </table>
  <table width="460" border="0">
<tr>
<td width="454" height="18" bgcolor="#00CC33"><div align="center" class="Estilo9">Registro De Usuarios </div></td>
                            </tr>
                          </table>
  <table width="458" border="0">
                            <tr>
                              <td width="452"><div align="right"><span class="Estilo2"> <span class="Estilo9">(*)campos obligatorios</span></span><span class="s"></span></div></td>
                            </tr>
      </table>
  <table width="460" border="0">
    <tr>
      <td width="454" bgcolor="#00CC00"><span class="Estilo9">DATOS PERSONALES</span></td>
    </tr>
  </table>
  <table width="462" border="0">
                           
                            <tr>
                              <td width="107"><span class="Estilo9">Apellido Paterno </span></td>
                              <td width="345"><label>
                                <input name="pat" type="text" id="pat" size="25" maxlength="100" class="Estilo9" />
                              <span class="Estilo9">(*) <span class="Estilo91">Acceso</span></span></label></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Apellido Materno </span></td>
                              <td><input name="mat" type="text" id="mat" size="25" maxlength="100" class="Estilo9" />
                              <span class="Estilo9">(*)
                              <input name="acceso" type="text" id="acceso" size="15" class="Estilo9" >
                              </span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Nombres</span></td>
                              <td><input name="nom" type="text" id="nom" size="40" maxlength="100" onClick="number(this)" class="Estilo9" />
                              <span class="Estilo9">(*)</span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Sexo</span></td>
                              <td><label>
                                <select name="sexo" id="sexo" class="Estilo9">
                                  <option value="M">MASCULINO</option>
                                  <option value="F">FEMENINO</option>
                                  
                                </select>
                                <span class="Estilo9">(*)</span><span class="Estilo9"> Sueldo</span></label>
                                <label for="sueldo"></label>
                              <input name="sueldo" type="text" id="sueldo" size="15" onChange="checkDecimals(this.form.sueldo, this.form.sueldo.value)" class="Estilo9"></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Dni</span></td>
                              <td><input name="dni" type="text" id="dni" size="25" maxlength="8" onKeyUp="validar1()" class="Estilo9" />
                              <span class="Estilo9">(*)</span></td>
                            </tr>
                                <tr>
                              <td><span class="Estilo9">Fec.Entrada</span></td>
                              <td><input name="entrada" type="text" id="entrada" size="16" maxlength="8" onKeyUp="validar1()" class="Estilo9" readonly/>
                                <span class="Estilo9">Fec.Salida
                              <input name="salida" type="text" id="salida" size="16" maxlength="8" onKeyUp="validar1()" class="Estilo9" readonly />
                              </span></td>
                            </tr>
                          </table>
<table width="460" border="0">
  <tr>
    <td width="454" bgcolor="#00CC00"><span class="Estilo9">DATOS LABORALES</span></td>
  </tr>
</table>
<table width="463" border="0">

<tr>
                              <td width="108"><span class="Estilo9">Area de Trabajo </span></td>
                              <td width="345"><span class="Estilo2">
                                <input name="area" type="text" id="area" onClick="number(this)" size="40" maxlength="100" class="Estilo9" />
                              </span><span class="Estilo9">(*)</span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Condicion Laboral</span></td>
                              <td><select name="condicion" id="condicion" class="Estilo9">
                              <option value="0000000001">CAS</option>
                                <option value="0000000002">NOMBRADO</option>
                                <option value="0000000003">PROYECTO</option>
                                <option value="0000000004">TERCEROS</option>
                                <option value="0000000005">ADSCRITO</option>
                                <option value="0000000006">CONTRATADO</option>
                               
                                
                              </select>
                              <span class="Estilo9">(*)</span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Cargo que Desempeña</span></td>
                              <td><input name="cargo" type="text" id="cargo" size="40" maxlength="100" class="Estilo9" />
                              <span class="Estilo9">(*)</span></td>
                            </tr>
                          </table>
                          <table width="460" border="0">
                            <tr>
                              <td width="454" bgcolor="#00CC00"><span class="Estilo9">DATOS DE ACCESO AL SISTEMA </span></td>
                            </tr>
                          </table>
                          <table width="458" border="0">
                            <tr>
                              <td width="109"><span class="Estilo9">Usuario</span></td>
                              <td width="335"><input name="user" type="text" id="user" size="25" maxlength="15" class="Estilo9"/>
                              <span class="Estilo9">(*)</span></td>  
                              <td width="0"> <div id ="estadoUser"></div></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Password</span></td>
                              <td><input name="pass" type="text" id="pass" size="25" maxlength="10" class="Estilo9" />
                              <span class="Estilo9">(*)</span></td>
                            </tr>
                          </table>
                          <table width="462" border="0">
                            <tr>
                              <td width="157" height="20" bgcolor="#00CC00"><input name="guardar" type="hidden" id="guardar"></td>
                              <td width="68" bgcolor="#00CC00"><input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" /></td>
                              <td width="58" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9" /></td>
                              <td width="161" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
                          </table>
</form>           

</body>

</html>
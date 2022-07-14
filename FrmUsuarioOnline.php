<?php
include("./clases/ClsUsuario.php");

session_start();

if(isset($_SESSION["User"])){header("Index.php");}


if(isset($_POST["guardar"])>0){
   $Usuario =new ClsUsuario;
   $Usuario->paterno=$_POST['pat'];
   $Usuario->materno=$_POST['mat'];
   $Usuario->nombres=$_POST['nom'];
   $Usuario->sexo=$_POST['sexo'];
   $Usuario->dni=$_POST['dni'];
   $Usuario->area=$_POST['area'];
   $Usuario->condicion=$_POST['condicion'];
   $Usuario->cargo=$_POST['cargo'];
   $Usuario->user=$_POST['user'];
   $Usuario->pass=$_POST['pass'];
   $ban=$Usuario->Crear();
   
   if($ban==true){
	   echo "<script type='text/javascript'>"; 
	   echo "alert ('Exito En El Registro');"; 
       echo "</script>"; 
	   
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
<script type="text/javascript" src="acceso/jquery.js"></script>

<script language="javascript">
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
					
		f.submit();
		return true;
	}
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
.Estilo9 {font-size: 12px}
.s {
	text-align: right;
	font-size: 9px;
}
.Estilo2 {
}
-->
</style>
</head>

<body>
<tr align="left">

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px"><form name="f" action="FrmUsuarioOnline.php" method="post" onSubmit="return validar(this)" >
<table width="464" border="0">
<tr>
          <td width="458" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="images/dra12.png" width="461" height="73"></div></td>
        </tr>
      </table>
  <table width="466" border="0">
<tr>
<td width="460" height="18" bgcolor="#00CC33"><div align="center" class="Estilo1">Registro De Usuarios </div></td>
                            </tr>
                          </table>
  <table width="463" border="0">
                            <tr>
                              <td width="457"><div align="right"><span class="Estilo2"> <span class="s">(*)campos obligatorios</span></span><span class="s"></span></div></td>
                            </tr>
      </table>
      <table width="463" border="0">
                            <tr>
                              <td width="457" bgcolor="#00CC00"><span class="Estilo3">DATOS PERSONALES </span></td>
                            </tr>
                          </table>
<table width="462" border="0">
                           
                            <tr>
                              <td width="107"><span class="Estilo9">Apellido Paterno </span></td>
                              <td width="345"><label>
                                <input name="pat" type="text" id="pat" size="25" maxlength="100" />
                              <span class="Estilo2">(*)</span></label></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Apellido Materno </span></td>
                              <td><input name="mat" type="text" id="mat" size="25" maxlength="100" />
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Nombres</span></td>
                              <td><input name="nom" type="text" id="nom" size="45" maxlength="100" onClick="number(this)" />
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Sexo</span></td>
                              <td><label>
                                <select name="sexo" id="sexo">
                                  <option value="M">MASCULINO</option>
                                  <option value="F">FEMENINO</option>
                                  
                                </select>
                              <span class="Estilo2">(*)</span></label></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Dni</span></td>
                              <td><input name="dni" type="text" id="dni" size="25" maxlength="8" onKeyUp="validar1()" />
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                          </table>
                          <table width="464" border="0">
                            <tr>
                              <td width="458" bgcolor="#00CC00"><span class="Estilo3">DATOS LABORALES</span></td>
                            </tr>
</table>
                          <table width="463" border="0">

                            <tr>
                              <td width="108"><span class="Estilo9">Area de Trabajo </span></td>
                              <td width="345"><select name="area" id="area">
                                <option value="0000000001">U.T.I</option>
                                <option value="0000000002">ABASTECIMIENTO</option>
                                <option value="0000000003">ASESORIA JURIDICA</option>
                                <option value="0000000004">ADMINISTRACION</option>
                               
                              </select>
                              <span class="Estilo2">(*)</span>  </td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Condicion Laboral</span></td>
                              <td><select name="condicion" id="condicion">
                              <option value="0000000001">CAS</option>
                                <option value="0000000002">NOMBRADO</option>
                                <option value="0000000003">PROYECTO</option>
                               <option value="0000000003">TERCEROS</option>
                                <option value="0000000003">ADSCRITO</option>
                              </select>
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Cargo que Desempeña</span></td>
                              <td><input name="cargo" type="text" id="cargo" size="45" maxlength="100" />
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                          </table>
                          <table width="460" border="0">
                            <tr>
                              <td width="454" bgcolor="#00CC00"><span class="Estilo3">DATOS DE ACCESO AL SISTEMA </span></td>
                            </tr>
                          </table>
                          <table width="458" border="0">
                            <tr>
                              <td width="107"><span class="Estilo9">Usuario</span></td>
                              <td width="341"><input name="user" type="text" id="user" size="25" maxlength="15" />   
                              <span class="Estilo2">(*)</span></td>  <td> <div id ="estadoUser"></div></td>
                             
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Password</span></td>
                              <td><input name="pass" type="password" id="pass" size="25" maxlength="10" />
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                          </table>
                          <table width="462" border="0">
                            <tr>
                              <td width="157" height="20" bgcolor="#00CC00"><input name="guardar" type="hidden" id="guardar"></td>
                              <td width="68" bgcolor="#00CC00"><input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" /></td>
                              <td width="58" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar" /></td>
                              <td width="161" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
                          </table>
</form>           

</body>

</html>
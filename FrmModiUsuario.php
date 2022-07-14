<?php
//------------funciones
function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}

function decrypt($string, $key) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}
//------------funciones
ini_set("session.gc_maxlifetime","30000");
session_start();

include("./clases/ClsUsuario.php");

// $enlace = conexion();
//mysqli_select_db($enlace, 'dbpap');

//
$host = "localhost";
$user = "root";
$pass = "";
$db = "dbpap";
$conexion = mysqli_connect($host, $user, $pass, $db);

$enlace = $conexion;

//

// if (!$conexion) {
//       //  die("Connection failed: " . mysqli_connect_error());
//       die('Location:../error4.php');
//    }
//    echo "Connected successfully";
//    mysqli_close($conn);

$Cod="";


if(isset($_GET['Cod']))
{  
  $Cod=$_GET['Cod'];
}
else{

  $Cod=$_POST["Cod"];
}
echo "codigo ".$Cod;
/*else
{
  if(isset($_POST["Cod"]))
  {
    $Cod = $_POST["Cod"];
  }
  else
  {
    echo "no entro";
  }
}*/






if($Cod!='A'){
  $sql_guardar1 = "SELECT Codigo, Nombre, ApellidoPat, ApellidoMat, Sexo, (SELECT Nombre from tblarea where tblarea.Codigo = tblusuario.area) as Area, (SELECT Descripcion from tblacceso where tblacceso.Codigo = tblusuario.acceso) as Acceso, (SELECT Nombre from tblcondicion where tblcondicion.Codigo = tblusuario.condicion) as Condicion, Dni, Cargo, Sueldo, (CASE Estado WHEN 'A' THEN 'ACTIVO' WHEN 'N' THEN 'INACTIVO' ELSE NULL END) AS Estado, Usser, Pass, Entrada, Salida from tblusuario WHERE Codigo='".$Cod."';";
 
  // $res1 = mysqli_query($enlace, $sql_guardar1); 
  $res1 = $enlace->query($sql_guardar1);

  $reg = mysqli_fetch_array($res1);

  $reg[12] = decrypt($reg[12],"pass");

  $reg[13] = decrypt($reg[13],"pass");
}
//phpinfo();
//var_dump($reg);

if($_SESSION["User"] != "1"){header("Index.php");}

//--

if(isset($_POST["guardar"])>0){
   $Usuario =new ClsUsuario;
   $Usuario->paterno= utf8_encode($_POST['pat']);
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
   $Usuario->codigo=$_POST['codigo'];
   $Usuario->acceso=$_POST['acceso'];
   $Usuario->en=$_POST['entrada'];
   $Usuario->sal=$_POST['salida'];
   $ban=$Usuario->Modificar(); //No esta ejecutando bien ,revisar
   
   if($ban==true){
	    header("location:concluye.php?cod=3");
   }
   else{
      echo "<script language='javascript' type='text/javascript'>";
		  echo "alert('Error Al Actualizar');" ;
   }
}
?>

<html>
<head>
  <title>Ficha De Inscripcion</title>
  <meta http-equiv="Content-Type" content="text/html;">

  <link type="text/css" rel="stylesheet" href="./css/jquery-ui-1.8.4.custom.css" /> 
  <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
  <script src="jquery/js/jquery-1.10.2.js"></script>
  <script src="jquery/js/jquery-ui-1.10.4.custom.js"></script>

  <script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>

  <script language="javascript">

    function checkDecimals(fieldName, fieldValue) {
      decallowed = 2;  // how many decimals are allowed?
      if (isNaN(fieldValue) || fieldValue == "") {
        alert("Eso no parece ser un n�mero v�lido. Prueba de nuevo.");
        // fieldName.select();
        document.f.sueldo.focus();
      }
      else {
        if (fieldValue.indexOf('.') == -1) fieldValue += ".";
          dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);

        if (dectext.length > decallowed){
          alert ("Por favor, entra un n�mero con " + decallowed + " n�meros decimales.");
          document.f.sueldo.focus();
        }
        else {
        }
      }
    }

    function validar1 (){
      var i;
      for (i = 0; i < document.f.dni.value.length; i++){
        if (document.f.dni.value.charCodeAt(i) < 48 || document.f.dni.value.charCodeAt(i) > 57){
          document.f.dni.value = document.f.dni.value.slice(0, i);
        }
      }
    }

    function guardar(){
      document.f.guardar.value = "1";
      document.f.Cod.value = "A";
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
        if($('#user').val()!= ""){ 		// si el input est� vacio no sera necesaria una validacion
          $.ajax({
            type: "POST",			  		//Metodo de envio de los datos
            url: "acceso/comprobar.php",	//script que se usara para la validacion del nick
            data: "user="+$('#user').val(),	//Enviamos el valor que esta en el input
            beforeSend: function(){
              $('div#estadoUser').html('Verificando...');	//Antes de recibir la respuesta se mostrara el mensaje verificando... 
            },
            success: function( respuesta ){
              if (respuesta == "0")	//Si la respuesta es 0 el nick NO esta disponible
              {//Entonces en el div mostramos el mensaje de error
                $('div#estadoUser').html("<div style='color:red;'><img height='16' src='images/error.png'>Ya Existente</div>");
                $('#user').val ("");	//Borramos el input ya que el nick es incorrecto
              }
              else{					//Si la respuesta es 1 el nick SI esta disponible
                $('div#estadoUser').html("<div style='color:#04B431;'><img height='16' src='images/check.png'>Disponible</div>");
              }
            }
          });
        }
      });
    });
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
      $('#condicion').autocomplete({
        source : 'ajax.php?cod=3'
      });
      $('#area').autocomplete({
        source : 'ajax.php?cod=2'           
      });
      $('#acceso').autocomplete({
        source : 'ajax.php?cod=4'             
      });		
    });
  </script>
  <style type="text/css">
    /* <!-- */
    body,img,form,table,td,ul,li,dl,dt,dd,pre,blockquote,fieldset{
      margin:0;
      padding:0;
      border:0;font: 80.5% "Trebuchet MS", sans-serif;
    }
    .Estilo1{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #FFFFFF;
    }
    .Estilo2{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      color: #00CC33;
    }
    .Estilo3{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      color: #FFFFFF;
    }
    .Estilo9{
      font-size: 12px;
      font-family: "Lucida Console", Monaco, monospace;
    }
    .ww{
      border:1px solid black; padding:10px;
    }
    /* text-align: right;
    font-size: 9px; */
    /* } */
    .Estilo2 {
    }
    .s{
      text-align: right;
      font-size: 9px;
    }
    /* --> */
  </style>
</head>

<body>
  <tr align="left">
    <td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px">
      <form name="f" action="FrmModiUsuario.php" method="post" onSubmit="return validar(this)"  class="ww">
        <table width="457" border="0">
          <tr>
            <td width="451" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png"  width="456" height="98"></div></td>
          </tr>
        </table>
        <table width="458" border="0">
          <tr>
            <td width="452" height="18" bgcolor="#00CC33"><div align="center" class="Estilo9">Actualizacion De Usuarios </div></td>
          </tr>
        </table>
        <table width="455" border="0">
          <tr>
            <td width="449"><div align="right"><span class="Estilo2"> <span class="Estilo9">(*)campos obligatorios</span></span><span class="s"></span></div></td>
          </tr>
        </table>
        <table width="458" border="0">
          <tr>
            <td width="452" bgcolor="#00CC00"><span class="Estilo9">DATOS PERSONALES </span></td>
          </tr>
        </table>
        <table width="455" border="0">                       
          <tr>
            <td width="107"><span class="Estilo9">Apellido Paterno </span></td>
            <td width="338"><label>
              <input name="pat" type="text" id="pat" value="<?= $reg[2]?>" size="25" maxlength="100" class="Estilo9" />
              <span class="Estilo9">(*)</span><span class="Estilo9"> Codigo:</span></label>
            </td>
          </tr>
          <tr>
            <td><span class="Estilo9">Apellido Materno </span></td>
            <td>
              <input name="mat" type="text" id="mat" value="<?php echo $reg[3]?>" size="25" maxlength="100" class="Estilo9"  />
              <span class="Estilo9">(*)</span><span class="Estilo2"><input name="codigo" type="text" readonly id="codigo" value="<?php echo $reg[0]?>"  size="15" class="Estilo9"/></span>
            </td>
          </tr>
          <tr>
            <td><span class="Estilo9">Nombres</span></td>
            <td>
              <input name="nom" type="text" id="nom" onClick="number(this)" value="<?php echo $reg[1]?>" size="40" maxlength="100" class="Estilo9"/>
              <span class="Estilo9">(*)</span>
            </td>
          </tr>
          <tr>
            <td><span class="Estilo9">Sexo</span></td>
            <td><label>
              <select name="sexo" id="sexo" class="Estilo9" >
                <option value="M">MASCULINO</option>
                <option value="F">FEMENINO</option>                      
              </select>
              <span class="Estilo9">(*)</span><span class="Estilo9">Sueldo</span><span class="Estilo2"><span class="Estilo9">:</span></span></label>
              <label for="sueldo"></label>
              <input name="sueldo" type="text" id="sueldo" onChange="checkDecimals(this.form.sueldo, this.form.sueldo.value)" value="<?php echo $reg[10]?>" size="15" class="Estilo9" >
            </td>
          </tr>
          <tr>
            <td><span class="Estilo9">Dni</span></td>
            <td>
              <input name="dni" type="text" id="dni" onKeyUp="validar1()" value="<?php echo $reg[8]?>" size="25" maxlength="8" class="Estilo9" />
              <span class="Estilo9">(*)</span>
            </td>
          </tr>
          <tr>
            <td><span class="Estilo9">Fec.Entrada</span></td>
            <td>
              <input name="entrada" type="text" class="Estilo9" id="entrada" onKeyUp="validar1()" value="<?php echo $reg[14] ?>" size="16" maxlength="8" readonly/>
              <span class="Estilo9">Fec.Salida
                <input name="salida" type="text" class="Estilo9" id="salida" onKeyUp="validar1()" value="<?php echo $reg[15] ?>" size="16" maxlength="8" readonly />
              </span>
            </td>
          </tr>
        </table>
        <table width="456" border="0">
          <tr>
            <td width="450" bgcolor="#00CC00"><span class="Estilo9">DATOS LABORALES</span></td>
          </tr>
        </table>
        <table width="456" border="0">
          <tr>
            <td width="108"><span class="Estilo9">Area de Trabajo </span></td>
            <td width="338">
              <input name="area" type="text" id="area" value="<?php echo $reg[5]?>" size="40" maxlength="100" class="Estilo9"  />
              <span class="Estilo9">(*)</span>
            </td>
          </tr>
          <tr>
            <td><span class="Estilo9">Condicion Laboral</span></td>
            <td>
              <input name="condicion" type="text" id="condicion" onKeyUp="validar1()" value="<?php echo $reg[7]?>" size="25" maxlength="8" class="Estilo9"  />
              <span class="Estilo9">(*)</span>
            </td>
          </tr>
          <tr>
            <td><span class="Estilo9">Cargo que Desempeña</span></td>
            <td>
              <input name="cargo" type="text" id="cargo" value="<?php echo $reg[9]?>" size="40" maxlength="100" class="Estilo9" />
              <span class="Estilo9">(*)</span>
            </td>
          </tr>
        </table>
        <table width="454" border="0">
          <tr>
            <td width="448" bgcolor="#00CC00"><span class="Estilo9">DATOS DE ACCESO AL SISTEMA </span></td>
          </tr>
        </table>
        <table width="456" border="0">
          <tr>
            <td width="108"><span class="Estilo9">Usuario</span></td>
            <td width="325">
              <input name="user" type="text" id="user" value="<?php echo $reg[12]; ?>" size="25" maxlength="15" class="Estilo9"  />
              <span class="Estilo9">(*)</span><span class="Estilo9"> Acceso</span>:
              <label for="acceso"></label>
            </td>  
          </tr>
          <tr>
            <td><span class="Estilo9">Password</span></td>
            <td>
              <input name="pass" type="password" id="pass" value="<?php echo $reg[13] ?>" size="25" maxlength="10" class="Estilo9"  />
              <span class="Estilo9">(*)</span>
              <input name="acceso" type="text" id="acceso" value="<?php echo $reg[6]?>" size="15" class="Estilo9"  >
            </td>
          </tr>
        </table>
        <table width="452" border="0">
          <tr>
            <td width="148" height="26" bgcolor="#00CC00">
              <input name="guardar" type="hidden" id="guardar" value="1">
              <input name="Cod" type="hidden" id="Cod" value="A">
            </td>
            <td width="85" bgcolor="#00CC00"><input type="submit" name="Submit" value="Actualizar" align="center" onClick="guardar();" class="Estilo9"  /></td>
            <td width="63" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar" class="Estilo9"  /></td>
            <td width="138" bgcolor="#00CC00">&nbsp;</td>
          </tr>
        </table>
      </form>
    </td>
  </tr>         
</body>
</html>
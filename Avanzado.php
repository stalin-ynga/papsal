<?php

//------------------------


$lugar=$_GET['lugar'];
$tipo=$_GET['tipo'];
$funda=$_GET['funda'];
$obser=$_GET['obser'];
$salida=$_GET['salida'];
$retorno=$_GET['retorno'];

if(isset($_POST["guardar"])>0){


   
$lugar1=$_POST['lugar'];
$tipo1=$_POST['tipo'];
$funda1=$_POST['funda'];
$obser1=$_POST['obser'];
$salida1=$_POST['salida'];
$retorno1=$_POST['retorno'];
 
	$var1=$_POST['n9'];
    $temp="";
	for( $i=0;$i<count($var1);$i++){

   $link = mysqli_connect("localhost", "root", "", "dbpap");
   $temp="CALL Sp_GenCodDoc('".$var1[$i]."','$tipo1','$lugar1','$funda1','$obser1','$salida1','$retorno1'); ";
 mysqli_multi_query($link,$temp);
mysqli_close($link);

}
	
 // echo $temp;
 header("location:concluye.php?cod=20");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<title>Tab Pane Demo (WebFX)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="./css/estilo.css" />
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

        <script type="text/javascript" src="./js/jquery-ui-1.8.4.custom.min.js"></script>
<!-- this link element includes the css definitions that describes the tab pane -->
<!--
<link type="text/css" rel="stylesheet" href="tab.winclassic.css" />
-->

<!-- the id is not needed. It is used here to be able to change css file at runtime -->

<style type="text/css">
<style type="text/css">
			body,img,form,table,td,ul,li,dl,dt,dd,pre,blockquote,fieldset{
				margin:0;
				padding:0;
				border:0;font: 70.5% "Trebuchet MS", sans-serif;
			}

.dynamic-tab-pane-control h2 {
	text-align:	center;
	width:		auto;
}

.dynamic-tab-pane-control h2 a {
	display:	inline;
	width:		auto;
}

.dynamic-tab-pane-control a:hover {
	background: transparent;
}

.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	color: #FFFFFF;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #00CC33;
}
.Estilo3 {
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
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
.added {
				float: center;
				margin-right: 10px;
			}
.eliminar {
				margin: 5px;
			}

</style>
<script type="text/javascript" src="js/tabpane.js"></script>
<script type="text/javascript">


     
	  $(function(){
                $('#NombreCom').autocomplete({
                   source : 'ajax.php?cod=1'
                 
                   
                });
				$('#area').autocomplete({
                   source : 'ajax.php?cod=2'
                 
                   
                });
            });
				   
  
function verifica(){
		
		
			if(confirm("¿Desea Grabar?")) {
             guardar();
             return true;
		                 }
						 else{return false;}
                
}	
function guardar(){
 
		document.usuario.guardar.value = "1";
		
		
	
}
			$(document).ready(function() {



				var MaxInputs       = 400; //maximum input boxes allowed
				var contenedor   	= $("#contenedor"); //Input boxes wrapper ID
				var AddButton       = $("#agregarCampo"); //Add button ID

				//var x = contenedor.length; //initlal text box count
				var x = $("#contenedor div").length + 1;
				var FieldCount = x-1; //to keep track of text box added
                
				$(AddButton).click(function (e)  //on add input button click
				{
						if(x <= MaxInputs) //max input box allowed
						{
							FieldCount++; //text box added increment

                              $(contenedor).append('<div align="center" class="added"><tr><td width="27" class="Estilo9" > - - - ><input name="n9[]" class="Estilo9" type="text" id="n9[]" size="45" maxlength="100" value="'+document.getElementById("NombreCom").value+'" /><a href="#" class="eliminar">&times;</a></td></tr></div>');
							  
				document.getElementById("NombreCom").value="";			  
							//
							x++; //text box increment
						}
				return false;
				});

				$("body").on("click",".eliminar", function(e){ //user click on remove text
						if( x > 1 ) {
								$(this).parent('div').remove(); //remove text box
								x--; //decrement textbox
						}
				return false;
				});

			});
		</script>
</head>
<body>
<form action="Avanzado.php"  method="post" name="Cat1" class="ww">

		<center>
	<table width="553" border="0">
    <tr>
      <td width="547" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="modal/logo.png" width="552" height="98"></div></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" height="20" bgcolor="#0099FF"><div align="center" class="Estilo9">ASIGNACION AVANZADA DE DOCUMENTOS</div></td>
    </tr>
  </table>
  <table width="556" border="0">
    <tr>
      <td width="550" bgcolor="#0099FF" align="center"><span class="Estilo9">LISTA DE TRABAJADORES ANEXADOS AL DOCUMENTO</span></td>
    </tr>
</table>
<center>
  <span class="Estilo9">Trabajador</span>
<input name="NombreCom" type="text" class="tb61 Estilo9"  id="NombreCom" size="56" maxlength="100" /> <input type="submit" name="Submit" value="Registrar" align="center" onClick="guardar();" class="Estilo9" />
 <input name="lugar" type="hidden" id="lugar" value="<? echo $lugar ?>" />
  <input name="tipo" type="hidden" id="tipo" value="<? echo $tipo ?>" />
   <input name="salida" type="hidden" id="salida" value="<? echo $salida ?>" />
    <input name="retorno" type="hidden" id="retorno" value="<? echo $retorno ?>" />
     <input name="funda" type="hidden" id="funda" value="<? echo $funda ?>" />
      <input name="obser" type="hidden" id="obser" value="<? echo $obser ?>" />
      <input name="guardar" type="hidden" id="guardar">
  </center>
<table width="816" border="0" align="center">
                      
                           
                        <div id="wrapper" align="center">
<a id="agregarCampo" class="btn btn-info Estilo9" href="#">Agregar Trabajador</a>
			<div id="contenedor" align="center">
			  
            </div>
    </div>   
  </table>  

</form>
</body>
</html>


<?
ini_set("session.gc_maxlifetime","30000");
  session_start();

if($_SESSION["User"] != "1"){header("Index.php");}
  
       include('./clases/conexion.php');

       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
	   if(isset($_POST['ver'])){
		   
	  $sql_guardar1="";
	   $where="";
	  // traemos los datos ingresados en la consulta
	      
	   $inicio=$_POST['inicio'];
	   $final=$_POST['final'];
	   $estado=$_POST['estado'];
	   $tipo=$_POST['tipo'];
	   $num=0;
	   
// verificamos si hay datos en las cajas de texto
		
// INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE SALIDA 
		if($tipo=="01"){
			if($estado!="T")
			{$where=" AND Statuss='$estado'";};
			
				   
$sql_guardar1="select Codigo,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,Fundamento,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tblsalida WHERE Usuario='".$_SESSION['Codigo']."' AND FecSalida BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
 
 $sql_guardar2="select COUNT(*) from tblsalida WHERE Usuario='".$_SESSION['Codigo']."' AND FecSalida BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
       $res1 =mysql_query($sql_guardar1,$enlace); 
	   $res2 =mysql_query($sql_guardar2,$enlace); 
	   while ($reg2 = mysql_fetch_array($res2))
               { $num=$reg2[0];}
	   }
	   
	   // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE TARDANZA 
		if($tipo=="02"){
			if($estado!="T")
			{$where=" AND Statuss='$estado'";};
			
				   
$sql_guardar1="select Codigo,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Fundamento,Fecha,(CASE Marcado WHEN 'EN1' THEN 'ENTRADA DRSAU' WHEN 'EN2' THEN 'ENTRADA REFRIGERIO' ELSE NULL END) as Marcado,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tbltardanza WHERE Usuario='".$_SESSION['Codigo']."' AND Fecha BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
 
 $sql_guardar2="select COUNT(*) from tbltardanza WHERE Usuario='".$_SESSION['Codigo']."' AND Fecha BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
       $res1 =mysql_query($sql_guardar1,$enlace); 
	   $res2 =mysql_query($sql_guardar2,$enlace); 
	   while ($reg2 = mysql_fetch_array($res2))
               { $num=$reg2[0];}
	   }
	   
	   // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE VEHICULAR
		if($tipo=="03"){
			if($estado!="T")
			{$where=" AND Statuss='$estado'";};
			
				   
$sql_guardar1="select Codigo,Fecha,(SELECT Modelo from tblauto where Codigo=Vehiculo) as Vehiculo,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Destino,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tblvehicular WHERE Usuario='".$_SESSION['Codigo']."' AND Fecha BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
 
 $sql_guardar2="select COUNT(*) from tblvehicular WHERE Usuario='".$_SESSION['Codigo']."' AND Fecha BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
       $res1 =mysql_query($sql_guardar1,$enlace); 
	   $res2 =mysql_query($sql_guardar2,$enlace); 
	   while ($reg2 = mysql_fetch_array($res2))
               { $num=$reg2[0];}
	   }
 }
 else
 { //LLAMA A TODAS LAS PAPELETAS DE SALIDA DEL DIA
	$sql_guardar1="select Codigo,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,Fundamento,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tblsalida WHERE Usuario='".$_SESSION['Codigo']."' AND FecSalida BETWEEN CONCAT(CONVERT(CURDATE(),CHAR),' 00:00:00') AND CONCAT(CONVERT(CURDATE(),CHAR),' 23:59:00'); 
 ";
 $sql_guardar2="SELECT COUNT(*) from tblsalida WHERE Usuario='".$_SESSION['Codigo']."' AND FecSalida BETWEEN CONCAT(CONVERT(CURDATE(),CHAR),' 00:00:00') AND CONCAT(CONVERT(CURDATE(),CHAR),' 23:59:00');";
   //$sql_guardar=$sql_guardar.$where;
	   $res1 =mysql_query($sql_guardar1,$enlace); 
	   $res2 =mysql_query($sql_guardar2,$enlace); 
	  while ($reg2 = mysql_fetch_array($res2))
               { $num=$reg2[0];}
 }//FIN DEL IF PRINCIPAL "VER"
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    
 <link type="text/css" rel="stylesheet" href="./css/jquery-ui-1.8.4.custom.css" />
        <link type="text/css" rel="stylesheet" href="./css/estilo.css" />
        
      <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="jquery/js/jquery-1.10.2.js"></script>
	<script src="jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>

        <script type="text/javascript">
		
		 jQuery(function() {
     $( "#button" ).button();
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
	   
				 $('#inicio').datetimepicker({
		  dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo'
				});
 
 $('#final').datetimepicker({
	      dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo'
				});
 
  
  });
			

           
			$(document).ready(parpadear);
function parpadear(){
					for (i=1; i<=document.f2.num.value; i++)
{
	 $('#parpa'+i).fadeIn(500).delay(250).fadeOut(500, parpadear) }
}
</script>
     

<script type="text/javascript">

 $( "#dialog1" ).dialog({ autoOpen: false });
   $( "#dialog2" ).dialog({ autoOpen: false });
   
function validar(f){

            
				 
				 if(f.inicio.value==""){
					
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
		                               };
											  
				 if(f.final.value==""){
					
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
		                                      };
			
				 f.submit();
	return true;
}

   </script>
        
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TinyTable</title>
<link rel="stylesheet" href="style.css" />

<style>
body,img,form,table,td,ul,li,dl,dt,dd,pre,blockquote,fieldset{
				margin:0;
				padding:0;
				border:0;font: 80.5% "Trebuchet MS", sans-serif;
			}
.tb6 {
	border: 3px double #CCCCCC;
	width: 180px;
	text-align: left;
}
.tb61 {
	border: 3px double #CCCCCC;
	width: 450px;
}
.Estilo3 {font-size: 10px}
.Estilo4 {font-size: 11px}
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 12px}
.Estilo7 {font-family: "Times New Roman", Times, serif}
.Estilo8 {font-family: "Times New Roman", Times, serif; font-size: 11px; }

.Estilo11 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 18px;
}
.titulo_cabecera {
	color: #000;
	text-align: right;
}

.a {
	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
#f2 div table tr td .a {
	color: #000;
}
.titulo_cabecera1 {	text-align: right;
	color: #000;
}
#f2 div table {
	text-align: right;
}
.titulo_cabecera2 {	color: #000;
	text-align: center;
	font-size: 14px;
}
.Estilo9 {
	font-size: 16px;
	font-family: "Lucida Console", Monaco, monospace;
}
.ww {
	border:1px solid black; padding:15px;
}
</style>
<? 
  for ($i=1; $i<=$num; $i++) {
        echo "<style>";
	    echo "#parpa".$i."{";
	    echo "background:#F00;";
	    echo "width:10px;";
	    echo "display:inline-table;";
		echo "-webkit-border-radius: 8px;";
		echo "-moz-border-radius: 8px;";
		echo "border-radius: 8px;";
		echo "color:#ffffff;";
		echo "font-size:8px;";
		echo "font-family: Helvetica, Arial;";
		echo "padding:8px;";
		echo "margin-left:8px;";
		echo "margin-top:8px;}";
		echo "#parp".$i.$i."{";
	    echo "background:#090;";
	    echo "width:10px;";
	    echo "display:inline-table;";
		echo "-webkit-border-radius: 8px;";
		echo "-moz-border-radius: 8px;";
		echo "border-radius: 8px;";
		echo "color:#ffffff;";
		echo "font-size:8px;";
		echo "font-family: Helvetica, Arial;";
		echo "padding:8px;";
		echo "margin-left:8px;";
		echo "margin-top:8px;}";
		echo "</style>";
  }
?>
</head>
<body>
<center>
<form name="f2" id="f2" method="post" action="Pendiente.php"  onSubmit="return validar(this);" class="ww Estilo9">
<input name="num" type="hidden" id="num" value="<? echo $num?>"  />
 <script type="text/javascript">
		
			$(document).ready(parpadear);
function parpadear(){
					for (i=1; i<=document.f2.num.value; i++)
{
	 $('#parpa'+i).fadeIn(500).delay(250).fadeOut(500, parpadear) }
}
</script>
<div style="border-style:solid; border-color:#CCCCCC; border-width:thin; height=252px; width:250p; font-family: ', Times, serif;">
<p>&nbsp;</p>
<table width="976" border="0" >
  <tr>
    <td width="976" bgcolor="#33CC00" class="titulo_cabecera2">Mis Papeletas y Permisos</td>
  </tr>
</table>
<table width="976" border="0">
  <tr>
    <td width="976" bgcolor="#990000" class="titulo_cabecera">&nbsp;</td>
    </tr>
</table>
<table width="977" border="0">
  <tr>
    <td width="31"><span class="titulo_cabecera">Desde:</span></td>
    <td width="185"><input name="inicio" type="text" class="tb6 a" id="inicio"  readonly="readonly"/></td>
    <td width="32" class="titulo_cabecera">Hasta: </span></td>
    <td width="185">
      <input name="final" type="text" class="tb6 a" id="final"  readonly="readonly"/>
    </span></td>
    <td width="63" class="titulo_cabecera">Estado: </span></td>
    <td width="187"><select name="estado" class="tb6 a" id="estado">
      <option value="T">TODOS</option>
      <option value="01"> PENDIENTE</option>
      <option value="02"> APROBADO</option>
      
    </select></td>
    <td width="65"><span class="titulo_cabecera">Tipo:</span></td>
    <td width="195"><label for="select"></label>
      <select name="tipo" class="tb6 a" id="tipo">
        <option value="01"> PAPELETA DE SALIDA</option>
        <option value="02"> PAPELETA DE TARDANZA</option>
        <option value="03"> PAPELETA VEHICULAR</option>
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="button" type="submit" class="ui-button-text" id="button" onclick="asigna(); " value="FILTRAR"  /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;	</p>
</div>
	<table width="1043" border="0" cellpadding="0" cellspacing="0" class="sortable" id="table">
		<thead>
			<tr>
           
					
			
				<? 
				
				if(isset($_POST['ver']))
				{		
			
				
	             if($tipo=='01'){		
			echo"	<th width='122'><h3>Codigo</h3></th>";
			echo"	<th width='145'><h3>Fecha Salida</h3></th>";
			echo"	<th width='145'><h3>Fecha Retorno</h3></th>";
            echo"   <th width='80'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Lugar</h3></th>";
            echo"   <th width='232'><h3>Fundamento</h3></th>";
			echo"  <th width='232'><h3>Observacion</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";
			
				 }
			
			
	             if($tipo=='02'){
						
			echo"	<th width='60'><h3>Codigo</h3></th>";
			echo"	<th width='100'><h3>Tipo Motivo</h3></th>";
			echo"	<th width='200'><h3>Fundamento</h3></th>";
            echo"   <th width='120'><h3>Fecha</h3></th>";
            echo"   <th width='119'><h3>Marcado Justificado</h3></th>";
			echo"	<th width='50'><h3>Estado</h3></th>";
			
				 }
				 
				 
	             if($tipo=='03'){		
			echo"	<th width='113'><h3>Codigo</h3></th>";
			echo"	<th width='156'><h3>Fecha Salida</h3></th>";
			echo"	<th width='159'><h3>Vehiculo</h3></th>";
            echo"   <th width='100'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Destino</h3></th>";
            echo"   <th width='232'><h3>Fundamento</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";
				 }
			}
			else 
			{
			echo"	<th width='122'><h3>Codigo</h3></th>";
			echo"	<th width='145'><h3>Fecha Salida</h3></th>";
			echo"	<th width='145'><h3>Fecha Retorno</h3></th>";
            echo"   <th width='80'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Lugar</h3></th>";
            echo"   <th width='232'><h3>Fundamento</h3></th>";
			echo"  <th width='232'><h3>Observacion</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";	
			}
			?>
			</tr>
		</thead>
		<tbody>
			<?
			$i=0;
            if(isset($_POST['ver'])){
				if($res1==NULL){echo ".::NO EXISTEN DATOS CON LOS PARAMETROS INGRESADOS::.";}
				 else{
					 //primer tipo
					 if($tipo=='01'){
			while ($reg = mysql_fetch_array($res1))
               {   $i=$i+1;
            echo"<tr>";
			echo"<td>".$reg[0]."</td>";
			echo"<td>".$reg[1]."</td>";
			echo"<td>".$reg[2]."</td>";
			echo"<td>".$reg[3]."</td>";
			echo"<td>".$reg[4]."</td>";
			echo"<td>".$reg[5]."</td>";
			echo"<td>".$reg[6]."</td>";
			if($reg[7]=='PENDIENTE'){
			echo"<td> <div id='parpa".$i."'>".$reg[7]."</div></td>";
			}
			else{
				echo"<td> <div id='parp".$i.$i."'>".$reg[7]."</div></td>";
			}
			echo"</tr>";
			}}//--primer tipo
			
			//segundo tipo
					 if($tipo=='02'){
			while ($reg = mysql_fetch_array($res1))
               {   $i=$i+1;
            echo"<tr>";
			echo"<td>".$reg[0]."</td>";
			echo"<td>".$reg[1]."</td>";
			echo"<td>".$reg[2]."</td>";
			echo"<td>".$reg[3]."</td>";
			echo"<td>".$reg[4]."</td>";
			if($reg[5]=='PENDIENTE'){
			echo"<td> <div id='parpa".$i."'>".$reg[5]."</div></td>";
			}
			else{
				echo"<td> <div id='parp".$i.$i."'>".$reg[5]."</div></td>";
			}
			echo"</tr>";
			}}//--segundo tipo
			
			//tercer tipo
					 if($tipo=='03'){
			while ($reg = mysql_fetch_array($res1))
               {   $i=$i+1;
            echo"<tr>";
			echo"<td>".$reg[0]."</td>";
			echo"<td>".$reg[1]."</td>";
			echo"<td>".$reg[2]."</td>";
			echo"<td>".$reg[3]."</td>";
			echo"<td>".$reg[4]."</td>";
			echo"<td>".$reg[5]."</td>";
			if($reg[6]=='PENDIENTE'){
			echo"<td> <div id='parpa".$i."'>".$reg[6]."</div></td>";
			}
			else{
				echo"<td> <div id='parp".$i.$i."'>".$reg[6]."</div></td>";
			}
			echo"</tr>";
			}}//--tercer tipo
			
			}}
			else
			{
				while ($reg = mysql_fetch_array($res1))
               {   $i=$i+1;
            echo"<tr>";
			echo"<td>".$reg[0]."</td>";
			echo"<td>".$reg[1]."</td>";
			echo"<td>".$reg[2]."</td>";
			echo"<td>".$reg[3]."</td>";
			echo"<td>".$reg[4]."</td>";
			echo"<td>".$reg[5]."</td>";
			echo"<td>".$reg[6]."</td>";
			if($reg[7]=='PENDIENTE'){
			echo"<td> <div id='parpa".$i."'>".$reg[7]."</div></td>";
			}
			else{
				echo"<td> <div id='parp".$i.$i."'>".$reg[7]."</div></td>";
			}
			echo"</tr>";}
			}
			?>
		</tbody>
  </table>
	<div id="controls">
  <div id="perpage">
			<select onchange="sorter.size(this.value)">
			<option value="5">5</option>
				<option value="10" selected="selected">10</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span class="a">Reg. por pagina</span>
	  </div>
		<div id="navigation">
			<img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text" class="a">Pag.N°<span id="currentpage"></span> De <span id="pagelimit"></span></div>
	</div>
  <script type="text/javascript" src="script.js"></script>
  <script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",1);
	
  </script>
  
  <input type="hidden" name="ver" id="ver"  />
  
</form>
<div id="dialog1" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Fecha Inicial
  </p>
  
</div>

<div id="dialog2" title="SISPAP - D.R.S.A.U" class="Estilo9">
  <p align="center">
    Ingresar Fecha Final
  </p>
  
</div>

  
</div>
<script>
$( "#dialog1" ).dialog({ autoOpen: false });
$( "#dialog2" ).dialog({ autoOpen: false });

</script>
</body>
</html>
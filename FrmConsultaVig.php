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
	   $usuario=trim($_POST['NombreCom']);    
	   $estado=$_POST['estado'];
	   $tipo=$_POST['tipo'];
       $num=0;
	   
// verificamos si hay datos en las cajas de texto
		
// INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE SALIDA 
		if($tipo=="01"){
			 if($estado!="T")
			{$where=" AND Statuss='$estado'";};
			if($usuario!=""){$where=$where." AND NombreCom='$usuario'";};
						   
$sql_guardar1="select tblsalida.Codigo,NombreCom,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,Fundamento,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tblsalida,tblusuario WHERE Usuario=tblusuario.Codigo AND FecSalida BETWEEN CONCAT(CONVERT(CURDATE(),CHAR),' 00:00:00') AND CONCAT(CONVERT(CURDATE(),CHAR),' 23:59:00') ".$where." ; 
 ";
 
    $sql_guardar2="select COUNT(*) from tblsalida,tblusuario WHERE Usuario=tblusuario.Codigo AND FecSalida BETWEEN CONCAT(CONVERT(CURDATE(),CHAR),' 00:00:00') AND CONCAT(CONVERT(CURDATE(),CHAR),' 23:59:00') ".$where." ; 
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
				if($usuario!=""){$where=$where." AND NombreCom='$usuario'";};
		
				   
$sql_guardar1="select tblvehicular.Codigo,NombreCom,Fecha,(SELECT Modelo from tblauto where Codigo=Vehiculo) as Vehiculo,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Destino,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END ) AS Estado
from tblvehicular,tblusuario WHERE Usuario=tblusuario.Codigo AND Fecha BETWEEN CONCAT(CONVERT(CURDATE(),CHAR),' 00:00:00') AND CONCAT(CONVERT(CURDATE(),CHAR),' 23:59:00') ".$where." ; 
 ";
 
 $sql_guardar2="select COUNT(*) from tblvehicular,tblusuario WHERE Usuario=tblusuario.Codigo AND Fecha BETWEEN CONCAT(CONVERT(CURDATE(),CHAR),' 00:00:00') AND CONCAT(CONVERT(CURDATE(),CHAR),' 23:59:00')  ".$where." ; 
 ";
       $res1 =mysql_query($sql_guardar1,$enlace); 
	   $res2 =mysql_query($sql_guardar2,$enlace); 
	   while ($reg2 = mysql_fetch_array($res2))
               { $num=$reg2[0];}
	   }
 }
 else
 { 
 //LLAMA A TODAS LAS PAPELETAS DE SALIDA DEL DIA
	$sql_guardar1="select tblsalida.Codigo,NombreCom,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,Fundamento,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tblsalida,tblusuario WHERE Usuario=tblusuario.Codigo AND FecSalida BETWEEN CONCAT(CONVERT(CURDATE(),CHAR),' 00:00:00') AND CONCAT(CONVERT(CURDATE(),CHAR),' 23:59:00') AND Statuss='02'; 
 ";
 $sql_guardar2="SELECT COUNT(*) from tblsalida,tblusuario WHERE Usuario=tblusuario.Codigo AND FecSalida BETWEEN CONCAT(CONVERT(CURDATE(),CHAR),' 00:00:00') AND CONCAT(CONVERT(CURDATE(),CHAR),' 23:59:00') AND Statuss='02'; 
 ";
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
        
        <script type="text/javascript" src="./js/jquery.illuminate.0.7.min.js"></script>
      <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="jquery/js/jquery-1.10.2.js"></script>
	<script src="jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>



        <script type="text/javascript">
 
            $(function(){
 $( "#button" ).button();
  $( "#aprueba" ).button();
               $('#NombreCom').autocomplete({
                   source : 'ajax.php?cod=1'
                 
                   
                });
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
</script>
     

<script type="text/javascript">

function Aprueba(){
	
	if(document.f2.tipo.value=='01'){
										   
	document.f2.action='MarcaEntrada.php';
	document.f2.submit();
	}	
}

   </script>
        
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TinyTable</title>
<link rel="stylesheet" href="style.css" />
<style>
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
.Estilo5 {
	font-family: Arial, Helvetica, sans-serif;
	color: #000;
}
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
	text-align: center;
}


#f2 div table tr td .a {
	color: #000;
}
.titulo_cabecera1 {	
	color: #000;
}
#f2 div table {
	text-align: left;
}
.titulo_cabecera2 {
	color: #000;
	text-align: center;
	font-size: 14px;
}
.titulo_cabecera3 {	color: #000;
	
}
.Estilo9 {
	font-size: 16px;
	font-family: "Lucida Console", Monaco, monospace;
}
.ww {
	border:1px solid black; padding:15px;
}
.a {
	font-size: 11px;
	font-family: "Lucida Console", Monaco, monospace;
}
.a1 {	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.titulo_cabecera4 {	color: #000;
	text-align: center;
}
</style>
<? 
  for ($i=1; $i<=$num; $i++) {
        echo "<style>";
	    
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
		echo "</style>";
  }
?>
</head>
<body>
<center>
<form name="f2" id="f2" method="post" action="FrmConsultaVig.php"  onSubmit="return validar(this);" class="ww">
  <script type="text/javascript">
		
			$(document).ready(parpadear);
function parpadear(){
					for (i=1; i<=document.f2.num.value; i++)
{
	 $('#parpa'+i).fadeIn(500).delay(250).fadeOut(500, parpadear) }
}
</script>
<div style="border-style:solid; border-color:#CCCCCC; border-width:thin; height=252px; width:250p; font-family: 'Times New Roman', Times, serif;">
<p>&nbsp;</p>
<table width="1066" border="0">
  <tr>
    <td width="1060" bgcolor="#33CC00" class="Estilo9">Papeletas De Salida-Verificacion y Marcado De Retorno</td>
  </tr>
</table>
<table width="1066" border="0">
  <tr>
    <td width="1060" bgcolor="#0033FF" class="titulo_cabecera">&nbsp;</td>
    </tr>
</table>
<table width="985" border="0">
  <tr>
    <td width="39"><span class="titulo_cabecera a">Usuario:</span></td>
    <td width="459"><input name="NombreCom" type="text" class="tb61" id="NombreCom" /></td>
    <td width="9" class="titulo_cabecera"></span></td>
    <td width="73"></span></td>
    <td width="22" class="titulo_cabecera"><table width="536" border="0">
      <tr>
        <td width="63" class="titulo_cabecera Estilo9">Estado: </span></td>
        <td width="186"><select name="estado" class="tb6 a" id="estado">
          <option value="T">TODOS</option>
          <option value="01"> PENDIENTE</option>
          <option value="02"> APROBADO</option>
        </select></td>
        <td width="63" class="titulo_cabecera Estilo9">Tipo:</td>
        <td width="206"><label for="select3"></label>
          <select name="tipo" class="tb6 a" id="tipo">
            <option value="01"> PAPELETA DE SALIDA</option>
            <option value="02"> PAPELETA DE TARDANZA</option>
            <option value="03"> PAPELETA VEHICULAR</option>
          </select></td>
      </tr>
    </table>      </span></td>
    <td width="162">&nbsp;</td>
    <td width="147" >&nbsp;</td>
    <td width="40"><label for="select"></label></td>
  </tr>
</table>
<input type="submit" name="button" id="button" value="FILTRAR" onclick="asigna(this); "  />
<input type="button" name="aprueba" id="aprueba" value="  MARCAR ENTRADA    " onclick="Aprueba();"/>
<p>&nbsp;</p>
</div>
	<table width="1043" border="0" cellpadding="0" cellspacing="0" class="sortable a" id="table">
		<thead>
			<tr>
           
					
			
				<? 
				
				if(isset($_POST['ver']))
				{		
			
				
	             if($tipo=='01'){		
			echo"	<th width='113'><h3>Codigo</h3></th>";
			echo"	<th width='150'><h3>Usuario</h3></th>";
			echo"	<th width='156'><h3>Fecha Salida</h3></th>";
			echo"	<th width='159'><h3>Fecha Retorno</h3></th>";
            echo"   <th width='100'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Lugar</h3></th>";
            echo"   <th width='232'><h3>Fundamento</h3></th>";
			echo"  <th width='232'><h3>Observacion</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";
			echo"	<th width='50'><h3>Elige</h3></th>";
		
			
				 }
			
			
	             
				 
	             if($tipo=='03'){		
			echo"	<th width='113'><h3>Codigo</h3></th>";
			echo"	<th width='150'><h3>Usuario</h3></th>";
			echo"	<th width='156'><h3>Fecha Salida</h3></th>";
			echo"	<th width='159'><h3>Vehiculo</h3></th>";
            echo"   <th width='100'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Destino</h3></th>";
            echo"   <th width='232'><h3>Fundamento</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";
			echo"	<th width='50'><h3>Elige</h3></th>";
			
				 }
			}
			else 
			{
			echo"	<th width='113'><h3>Codigo</h3></th>";
			echo"	<th width='150'><h3>Usuario</h3></th>";
			echo"	<th width='156'><h3>Fecha Salida</h3></th>";
			echo"	<th width='159'><h3>Fecha Retorno</h3></th>";
            echo"   <th width='100'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Lugar</h3></th>";
            echo"   <th width='232'><h3>Fundamento</h3></th>";
			echo"  <th width='232'><h3>Observacion</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";	
			echo"	<th width='50'><h3>Elige</h3></th>";
			
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
			echo"<td>".$reg[7]."</td>";
			if($reg[8]=='PENDIENTE'){
			echo"<td> <div id='parpa".$i."'>".$reg[8]."</div></td>";
			echo"<td><center><input type='checkbox' value=".$reg[0]." disabled  name='".$i."' id='".$i."'></center></td>";
			}
			else{
				echo"<td> <div id='parp".$i.$i."'>".$reg[8]."</div></td>";
				if($reg[3]!='0000-00-00 00:00:00'){
				echo"<td><center><input type='checkbox' disabled  value='0'  name='".$i.$i."'  id=".$i.$i."></center></td>";}
				else{
					echo"<td><center><input type='checkbox'  name='".$i."'  id=".$i." value=".$reg[0]." ></center></td>";
				}
			}
		
			echo"</tr>";
			}}//--primer tipo
			
			
			
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
			echo"<td>".$reg[6]."</td>";
			if($reg[7]=='PENDIENTE'){
			echo"<td> <div id='parpa".$i."'>".$reg[7]."</div></td>";
			echo"<td><center><input type='checkbox' value=".$reg[0]." disabled name='".$i."' id='".$i."'></center></td>";
			}
			else{
				echo"<td> <div id='parp".$i.$i."'>".$reg[7]."</div></td>";
				if($reg[3]!='0000-00-00 00:00:00'){
				echo"<td><center><input type='checkbox' disabled  value='0'  name='".$i.$i."'  id=".$i.$i."></center></td>";}
				else{
					echo"<td><center><input type='checkbox'  name='".$i."'  id=".$i." value=".$reg[0]." ></center></td>";
				}
			}
		
			echo"</tr>";
			}}//--tercer tipo
			
			}}// PRIMERA ENTRADA A LA INTERFAZ
			else
			{ $tipo='01';
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
			echo"<td>".$reg[7]."</td>";
			if($reg[8]=='PENDIENTE'){
				
			echo"<td> <div id='parpa".$i."'>".$reg[8]."</div></td>";
			echo"<td><center><input type='checkbox' disabled='disabled'    name='".$i.$i."' id='".$i.$i."'></center></td>";
			
			}
			else{
				echo"<td> <div id='parp".$i.$i."' > ".$reg[8]." </div></td>";
				if($reg[3]!='0000-00-00 00:00:00'){
				echo"<td><center><input type='checkbox' disabled  value='0'  name='".$i.$i."'  id=".$i.$i."></center></td>";}
				else{
					echo"<td><center><input type='checkbox'  name='".$i."'  id=".$i." value=".$reg[0]." ></center></td>";
				}
				                                   
			}
			
			echo"</tr>";}
			}
			$num=$i;
		
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
  <input name="num" type="hidden" id="num" value="<? echo $num?>"  />
  <input name="Tip" type="hidden" id="Tip" value="<? echo $tipo?>"  />
</form>
<form id="form1" name="form1" method="post" action="">
  <label for="ds"></label> 
 
</form>
</body>
</html>
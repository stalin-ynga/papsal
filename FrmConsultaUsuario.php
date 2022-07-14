<?php
  ini_set("session.gc_maxlifetime","30000");
  session_start();

if($_SESSION["User"] != "1"){header("Index.php");}
  
    include('./clases/conexion.php');

       $enlace=conexion();
	   
       mysqli_select_db($enlace,'dbpap');
	   
	   if(isset($_POST['ver'])){
		   
	   $sql_guardar1="";
	   
	   $where="";
	  // traemos los datos ingresados en la consulta
	      
	   $usuario=trim($_POST['NombreCom']); 
	   $area=trim($_POST['area']); 
	   $condicion=$_POST['condicion'];
	   $estado=$_POST['estado'];
	 
	   
// verificamos si hay datos en las cajas de texto
	    if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND Estado='$estado'";};
		if($condicion!="T"){$where=$where." AND Condicion='$condicion'";};	
// INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE SALIDA 
			   
$sql_guardar1="select Codigo,NombreCom,(SELECT Nombre from tblarea where tblarea.Codigo=tblusuario.area) as Area,(SELECT Descripcion from tblacceso where tblacceso.Codigo=tblusuario.acceso) as Acceso,(SELECT Nombre from tblcondicion where tblcondicion.Codigo=tblusuario.condicion) as Condicion,Dni,Cargo,Sueldo,(CASE Estado WHEN 'A' THEN 'ACTIVO' WHEN 'N' THEN 'INACTIVO' ELSE NULL END) AS Estado,Entrada,Salida from tblusuario WHERE 1=1".$where." ; 
 ";
 
 $res1 =mysqli_query($enlace, $sql_guardar1);

 }
 else
 { 
 //LLAMA A TODAS LAS PAPELETAS DE SALIDA DEL DIA
$sql_guardar1="select Codigo,NombreCom,(SELECT Nombre from tblarea where tblarea.Codigo=tblusuario.area) as Area,(SELECT Descripcion from tblacceso where tblacceso.Codigo=tblusuario.acceso) as Acceso,(SELECT Nombre from tblcondicion where tblcondicion.Codigo=tblusuario.condicion) as Condicion,Dni,Cargo,Sueldo,(CASE Estado WHEN 'A' THEN 'ACTIVO' WHEN 'N' THEN 'INACTIVO' ELSE NULL END) AS Estado,Entrada,Salida from tblusuario;";
 
 $res1 =mysqli_query($enlace, $sql_guardar1);
 }//FIN DEL IF PRINCIPAL "VER"
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
        var GB_ROOT_DIR = "./greybox/";
    </script>
 <script type="text/javascript" src="./greybox/AJS.js"></script>
    <script type="text/javascript" src="./greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="./greybox/gb_scripts.js"></script>
    <link href="./greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="./static_files/help.js"></script>
   
 <link type="text/css" rel="stylesheet" href="./css/jquery-ui-1.8.4.custom.css" />
        <link type="text/css" rel="stylesheet" href="./css/estilo.css" />
        
        
        
        <script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="./js/jquery-ui-1.8.4.custom.min.js"></script>
   <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
		<script type="text/javascript" src="./js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>



<script type="text/javascript">
        var GB_ROOT_DIR = "./greybox/";
    </script>

   
   
<script type="text/javascript">
GB_myShow = function(caption,url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 490,
        width: width || 490,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

        <script type="text/javascript">

            $(function(){
                $('#NombreCom').autocomplete({
                   source : 'ajax.php?cod=1'
                 
                   
                });
				$('#area').autocomplete({
                   source : 'ajax.php?cod=2'
                 
                   
                });
            });
		
</script>
     

<script type="text/javascript">
 jQuery(function() {
$( "#button" ).button();
  });
function verifica1(){
		
		
			if(confirm("¿Desactivar Usuario?")) {

             return true;
		                 }
						 else{return false;}
                
}

function verifica2(){
		
		
			if(confirm("¿Activar Usuario?")) {

            return true;
		                 }
						 else{return false;}
                
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
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 12px}
.Estilo7 {font-family: "Times New Roman", Times, serif}
.Estilo8 {font-family: "Times New Roman", Times, serif; font-size: 11px; }
.Estilo9 {
	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.a {
	font-size: 12px;
	font-family: "Lucida Console", Monaco, monospace;
}
.b {
	font-size: 9px;
	font-family: "Lucida Console", Monaco, monospace;
}

.ww {
	border:1px solid black; padding:15px;
}
.Estilo11 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 18px;
}
#f2 div table {
	text-align: left;
}
</style>

</head>
<body>
<center>
<form name="f2" id="f2" method="post" action="FrmConsultaUsuario.php"  onSubmit="return validar(this);" class="Estilo9">
  
<div style="border-style:solid; border-color:#CCCCCC; border-width:thin; height=252px; width:250p; font-family: 'Times New Roman', Times, serif;">
<p>&nbsp;</p>
<table width="1044" border="0">
  <tr>
    <td width="1034" bgcolor="#33CC00" class="a">Consultas Y Mantenimiento De Usuarios</td>
  </tr>
</table>
<table width="1044" border="0">
  <tr>
    <td width="1038" bgcolor="#CCFF33" class="titulo_cabecera">&nbsp;</td>
    </tr>
</table>
<table width="1033" border="0" class="Estilo9">
  <tr>
    <td width="84" height="24"><span class="titulo_cabecera">Usuario:</span></td>
    <td width="454"><input name="NombreCom" type="text" class="tb61" id="NombreCom" /></td>
    <td width="72"><span class="titulo_cabecera3">Condicion:</span></td>
    <td width="195"><select name="condicion" class="tb6" id="condicion">
      <option value="T">TODOS</option>
      <option value="0000000001">CAS</option>
      <option value="0000000002">NOMBRADO</option>
      <option value="0000000003">PROYECTO</option>
      <option value="0000000004">TERCEROS</option>
      <option value="0000000005">ADSCRITO</option>
      <option value="0000000006">CONTRATADO</option>
    </select></td>
    <td width="206"><label for="select">
      <input type="submit" name="button" id="button" value="FILTRAR" onclick="asigna(this); "  />
      &lt; &gt;<a href="FrmUsuario.php"  target="mainFrame" class="ui-widget-header"   onclick="return GB_myShow('D.R.S.A.U', this.href)"><img border='0'  src=./images/add.png width='15' height='15' title="Nuevo"/>Nuevo</a></label>
	</td>
  </tr>
  <tr>
    <td height="30"><span class="titulo_cabecera3">Area/Unidad:</span></td>
    <td><input name="area" type="text" class="tb61" id="area" /></td>
    <td>Estado:</td>
    <td>
        <select name="estado" class="tb6" id="estado">
          <option value="T">TODOS</option>
          <option value="A">ACTIVO</option>
          <option value="N">INACTIVO</option>
        </select>
      </td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
	<table width="1043" border="0" cellpadding="0" cellspacing="0" class="sortable" id="table">
		<thead>
			<tr>
			 <th width='113'><h3>Codigo</h3></th>
			 <th width='250'><h3>Usuario</h3></th>
			 <th width='200'><h3>Area</h3></th>
             <th width='100'><h3>Acceso</h3></th>
			 <th width='159'><h3>Condicion</h3></th>
             <th width='60'><h3>Dni</h3></th>
             <th width='119'><h3>Cargo</h3></th>
             <th width='40'><h3>Sueldo</h3></th>
             <th width='70'><h3>Entrada</h3></th>
             <th width='70'><h3>Salida</h3></th>
			 <th width='100'><h3>Estado</h3></th>
		     <th width='20'><h3>Edi.</h3></th>
             <th width='20'><h3>Act/Des</h3></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=0;
            if(isset($_POST['ver'])){
				if($res1==NULL){echo ".::NO EXISTEN DATOS CON LOS PARAMETROS INGRESADOS::.";}
				 else{
					 
			while ($reg = mysqli_fetch_array($res1))
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
			echo"<td>".$reg[8]."</td>";
			echo"<td>".$reg[9]."</td>";
			echo"<td>".$reg[10]."</td>";
		?>
			<td><center> <a href="FrmModiUsuario.php?Cod=<?= $reg[0]?>"  target="mainFrame" class="ui-widget-header"   onclick="return GB_myShow('D.R.S.A.U', this.href)"><img border='0'  src=./img/btn_edit.gif width='20' height='20' title="Modifica"/></a></td>
			<?php
			
			if($reg[8]=='ACTIVO'){
			echo"<td> <center><a href='ActDes.php?cod=".$reg[0]."&est=1' title='Desactiva' onclick='return verifica1();'><img border='0'  src=./img/on.jpg width='22' height='15'</td>";}
			else{
			echo"<td> <center><a href='ActDes.php?cod=".$reg[0]."&est=2' title='Activa' onclick='return verifica2();'><img border='0'  src=./img/apa.png width='27' height='20'</td>";	
			    }
			echo"</tr>";
			
			}
			}}// PRIMERA ENTRADA A LA INTERFAZ
			else
			{ 
				while ($reg = mysqli_fetch_array($res1))
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
			echo"<td>".$reg[8]."</td>";
			echo"<td>".$reg[9]."</td>";
			echo"<td>".$reg[10]."</td>";
		?>
			<td><center> <a href="FrmModiUsuario.php?Cod=<?php echo $reg[0]?>" target="mainFrame" class="ui-widget-header"   onclick="return GB_myShow('D.R.S.A.U', this.href)"><img border='0'  src=./img/btn_edit.gif width='20' height='20' title="Modifica"/></a></td>
			<?php
			 
			if($reg[8]=='ACTIVO'){
			echo"<td> <center><a href='ActDes.php?cod=".$reg[0]."&est=1' title='Desactiva' onclick='return verifica1();'><img border='0'  src=./img/on.jpg width='27' height='20'</td>";}
			else{
			echo"<td> <center><a href='ActDes.php?cod=".$reg[0]."&est=2' title='Activa' onclick='return verifica2();'><img border='0'  src=./img/apa.png width='27' height='20'</td>";	
			    }
			echo"</tr>";
			
			}

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
</body>
</html>
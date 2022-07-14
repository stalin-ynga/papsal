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
	      
	   $modelo=trim($_POST['modelo']); 
	  
	 
	   
// verificamos si hay datos en las cajas de texto
	    if($modelo!=""){$where=" AND Nombre='$modelo'";};
	    
// INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE SALIDA 
			   
$sql_guardar1="select Codigo,Nombre,(CASE Estado WHEN 'A' THEN 'ACTIVO' WHEN 'N' THEN 'INACTIVO' ELSE NULL END) AS Estado from tbltipomotivo WHERE 1=1".$where." ; 
 ";
 
 $res1 =mysql_query($sql_guardar1,$enlace); 

 }
 else
 { 
 //LLAMA A TODAS LAS PAPELETAS DE SALIDA DEL DIA
$sql_guardar1="select Codigo,Nombre,(CASE Estado WHEN 'A' THEN 'ACTIVO' WHEN 'N' THEN 'INACTIVO' ELSE NULL END) AS Estado from tbltipomotivo; 
 ";
 $res1 =mysql_query($sql_guardar1,$enlace); 
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
    
  <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="./css/estilo.css" />
        
         
        <script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="./js/jquery-ui-1.8.4.custom.min.js"></script>
      
		



<script type="text/javascript">
        var GB_ROOT_DIR = "./greybox/";
    </script>

   
   
<script type="text/javascript">
GB_myShow = function(caption,url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 265,
        width: width || 465,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

        <script type="text/javascript">
jQuery(function() {
$( "#button" ).button();
  });
            $(function(){
                $('#modelo').autocomplete({
                   source : 'ajax.php?cod=11'
                   
                });
				
            });
		
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
	width: 240px;
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
<form name="f2" id="f2" method="post" action="FrmConsultaMotivo.php"  onSubmit="return validar(this);" class="ww">
  
<div style="border-style:solid; border-color:#CCCCCC; border-width:thin; height=252px; width:250p; font-family: 'Times New Roman', Times, serif;">
<p>&nbsp;</p>
<table width="1044" border="0" class="Estilo9">
  <tr>
    <td width="1034" bgcolor="#33CC00" align="center" class="a">Consultas Y Mantenimiento De Tipos De Motivo</td>
  </tr>
</table>
<table width="1044" border="0">
  <tr>
    <td width="1038" bgcolor="#CCFF33" class="titulo_cabecera">&nbsp;</td>
    </tr>
</table>
<table width="977" border="0" class="Estilo9">
  <tr>
    <td width="60" height="24"><span class="titulo_cabecera">Nombre:</span></td>
    <td width="260"><input name="modelo" type="text" class="tb61" id="modelo" /></td>
    <td width="196"><input type="submit" name="button" id="button" value="FILTRAR" onclick="asigna(this); "  />
      <a href="FrmMotivo.php"  target="mainFrame" class="ui-widget-header"   onclick="return GB_myShow('D.R.S.A.U', this.href)"><img  src="./images/add.png" alt="" width='15' height='15' border='0' title="Nuevo"/>Nuevo</a></td>
    <td width="47">&nbsp;</td>
    <td width="392">&nbsp;</td>
  </tr>
</table>
</div>
	<table width="1043" border="0" cellpadding="0" cellspacing="0" class="sortable Estilo9" id="table">
		<thead>
			<tr>
			 <th width='113'><h3>Codigo</h3></th>
			 <th width='100'><h3>Nombre</h3></th>
			 <th width='80'><h3>Estado</h3></th>
		     <th width='50'><h3>Editar</h3></th>
			</tr>
		</thead>
		<tbody>
			<?
			$i=0;
            if(isset($_POST['ver'])){
				if($res1==NULL){echo ".::NO EXISTEN DATOS CON LOS PARAMETROS INGRESADOS::.";}
				 else{
					 
			while ($reg = mysql_fetch_array($res1))
               {   $i=$i+1;
            echo"<tr>";
			echo"<td>".$reg[0]."</td>";
			echo"<td>".$reg[1]."</td>";
			echo"<td>".$reg[2]."</td>";

		?>
			<td><center> <a href="FrmModiMotivo.php?Cod=<? echo $reg[0]?>"  target="mainFrame" class="ui-widget-header"   onclick="return GB_myShow('D.R.S.A.U', this.href)"><img border='0'  src=./img/btn_edit.gif width='20' height='20' title="Modifica"/></a></td>
			<?
			
			
			echo"</tr>";
			
			}
			}}// PRIMERA ENTRADA A LA INTERFAZ
			else
			{ 
				while ($reg = mysql_fetch_array($res1))
               {   $i=$i+1;
            echo"<tr>";
			echo"<td>".$reg[0]."</td>";
			echo"<td>".$reg[1]."</td>";
			echo"<td>".$reg[2]."</td>";
			
		?>
			<td><center> <a href="FrmModiMotivo.php?Cod=<? echo $reg[0]?>" target="mainFrame" class="ui-widget-header"   onclick="return GB_myShow('D.R.S.A.U', this.href)"><img border='0'  src=./img/btn_edit.gif width='20' height='20' title="Modifica"/></a></td>
			<?
			 
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
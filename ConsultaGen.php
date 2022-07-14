<?

       include('./clases/conexion.php');

       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);

	  
	  # INICIAMOS LAS VARIABLES
	  
	   $usuario="";   
	   $inicio="";
	   $final="";
	   $area="";
	   $estado="";
	   $tipo="";
	   $condi="";
	  
	  #DEFINIMOS VARIABLES QUE TENDRAN EL VALOR LITERAL
	  $it1="";
	  $it2="";
	  $it3="";
	  #
	  $MINU=0;
	  $DCTOS=0;
	  #
	   if(isset($_POST['ver'])){
	
	   $where="";
	  // traemos los datos ingresados en la consulta
	   $usuario=trim($_POST['NombreCom']);   
	   $inicio=$_POST['inicio'];
	   $final=$_POST['final'];
	   $area=trim($_POST['area']);
	   $estado=$_POST['estado'];
	   $tipo=$_POST['tipo'];
	   $condi=$_POST['condi'];
	   
	   // verificamos si hay datos en las cajas de texto
	    if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tblmarcado.Condicion='$estado'";};
		if($tipo!="T"){$where=$where." AND Tipo='$tipo'";};
		if($condi!="T"){$where=$where." AND Tblusuario.Condicion='$condi'";};
		   
	   //
		if($estado=='T'){$it1='TODOS';};
		if($estado=='01'){$it1='MARCADO NORMAL';};
		if($estado=='02'){$it1='JUSTIFICADO';};
		if($estado=='03'){$it1='NO MARCO';};
		if($estado=='04'){$it1='TARDANZA';};
		
		// 
		//
		if($condi=='T'){$it3='TODOS';};
		if($condi=='0000000001'){$it3='CAS';};
		if($condi=='0000000002'){$it3='NOMBRADO';};
		if($condi=='0000000003'){$it3='PROYECTO';};
		if($condi=='0000000004'){$it3='TERCEROS';};
		if($condi=='0000000005'){$it3='ADSCRITO';};
		if($condi=='0000000006'){$it3='CONTRATADO';};
		
		// 
		if($tipo=='T'){$it2='TODOS';};
		if($tipo=='EN1'){$it2='ENTRADA DRSAU';};
		if($tipo=='SA1'){$it2='SALIDA REFRIGERIO';};
		if($tipo=='EN2'){$it2='ENTRADA REFRIGERIO';};
		if($tipo=='SA2'){$it2='SALIDA DRSAU';};
		//  
       $sql_guardar="select tblmarcado.Codigo,NombreCom,Fecha,Conteo,(CASE Tipo WHEN 'EN1' THEN 'ENTRADA DRSAU' WHEN 'SA1' THEN 'SALIDA REFRIGERIO' WHEN 'EN2' THEN 'ENTRADA REFRIGERIO' WHEN 'SA2' THEN 'SALIDA DRSAU' ELSE NULL END) as Tipo,Papeleta,tblmarcado.Estado,TRUNCATE((((Sueldo/31)/8)/60)*Conteo,2) AS dcto,(CASE Tblusuario.Condicion WHEN '0000000001' THEN 'CAS' WHEN '0000000002' THEN 'NOMBRADO' WHEN '0000000003' THEN 'PROYECTO' WHEN '0000000004' THEN 'TERCEROS' WHEN '0000000005' THEN 'ADSCRITOS' WHEN '0000000006' THEN 'CONTRATADO' ELSE NULL END) AS Condi from tblmarcado,tblusuario WHERE tblusuario.Codigo=tblmarcado.Usuario AND Fecha BETWEEN '$inicio' AND '$final'".$where."; 
 ";
 
   //$sql_guardar=$sql_guardar.$where;
	   $res1 =mysql_query($sql_guardar,$enlace);
	  
	   }
	   else
	   {
		  $res1=NULL; 
	   }
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
        <link type="text/css" href="./css/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
	
         <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script type="text/javascript" src="./js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>

   
   
<script type="text/javascript">
GB_myShow = function(caption,url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 275,
        width: width || 492,
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
$( "#button2" ).button();
$( "#button3" ).button();
  });
            $(function(){
                $('#NombreCom').autocomplete({
                   source : 'ajax.php?cod=1'
                 
                   
                });
				$('#area').autocomplete({
                   source : 'ajax.php?cod=2'
                 
                   
                });
				 $('#inicio').datetimepicker({
		  dateFormat: 'yy-mm-dd',
		  ampm: false,
	      timeFormat: 'hh:mm:ss',
					currentText: 'Hora Actual',
	closeText: 'Listo'
				});
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
									   
	document.f2.action='Justifica.php';
	document.f2.submit();

}

function Eliminar(){
										   
	document.f2.action='Eliminar.php';
	document.f2.submit();

}

function Todo() 
    {
       if(document.getElementById('todo').checked==true){
		for (i=1; i<=(document.getElementById('num').value); i++)
{
	
document.getElementById(i).checked=true;
}
	   }else
	   {
		   for (i=1; i<=(document.getElementById('num').value); i++)
{
document.getElementById(i).checked=document.getElementById('todo').checked;
}
	   }
    }


function validar(f){
            
				 
				 if(f.inicio.value==""){
					
			     alert("Ingresar Fecha Inicial");
			                    return false;
		                               };
											  
				 if(f.final.value==""){
					
			      alert("Ingresar Fecha Final");
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
	color: #000;
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
</style>
</head>
<body>

<form name="f2" method="post" action="ConsultaGen.php" >
<div style="border-style:solid; border-color:#CCCCCC; border-width:thin; height=252px; width:250p; font-family: 'Times New Roman', Times, serif;">
<p>&nbsp;</p>
<table width="1105" border="0" class="d">
  <tr>
    <td width="864" bgcolor="#33CC00" class="titulo_cabecera"><span class="Estilo9">Consultas Generales Del Marcado Del Reloj</span></td>
  </tr>
</table>
<table width="1103" border="0">
  <tr>
    <td width="559" bgcolor="#00CCFF" class="titulo_cabecera">&nbsp;</td>
    </tr>
</table>
<table width="1099" border="0" class="Estilo9">
  <tr>
    <td width="53"><span class="titulo_cabecera">Usuario:</span></td>
    <td width="466"><input name="NombreCom" type="text" class="tb61" id="NombreCom" /></td>
    <td width="14">&nbsp;</td>
    <td width="76"><span class="titulo_cabecera">Estado:</span></td>
    <td width="184"><select name="estado" class="tb6" id="estado">
     <option value="T">TODOS</option>
      <option value="01"> MARCADO NORMAL</option>
      <option value="02"> JUSTIFICADO</option>
      <option value="03"> NO MARCO</option>
      <option value="04"> TARDANZA</option>
    </select></td>
    <td width="81"><span class="titulo_cabecera">Tipo Marcado:</span></td>
    <td width="195"><label for="select"></label>
      <select name="tipo" class="tb6" id="tipo">
        <option value="T">TODOS</option>
        <option value="EN1">ENTRADA DRSAU</option>
        <option value="SA1">SALIDA REFRIGERIO</option>
        <option value="EN2">ENTRADA REFRIGERIO</option>
        <option value="SA2">SALIDA DRSAU</option>
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="titulo_cabecera">Desde:</span></td>
    <td class="v"><span class="k">
      <input name="inicio" type="text" class="tb6" id="inicio"  readonly="readonly"/>
      <span class="C"><span class="titulo_cabecera">Hasta:
      <input name="final" type="text" class="tb6" id="final"  readonly="readonly"/>
      </span></span><span class="titulo_cabecera"></span></span></td>
    <td>&nbsp;</td>
    <td><span class="titulo_cabecera">Area/Unidad:</span></td>
    <td><span class="k">
      <input name="area" type="text" class="tb6" id="area" />
    </span></td>
    <td><span class="titulo_cabecera">Condicion:</span></td>
    <td><select name="condi" class="tb6" id="condi">
      <option value="T">TODOS</option>
      <option value="0000000001">CAS</option>
      <option value="0000000002">NOMBRADO</option>
      <option value="0000000003">PROYECTO</option>
      <option value="0000000004">TERCEROS</option>
      <option value="0000000005">ADSCRITOS</option>
      <option value="0000000006">CONTRATADOS</option>
    </select></td>
  </tr>
</table>
<table width="1099" border="0">
  <tr>
    <td width="230">&nbsp;</td>
    <td width="44" class="v">&nbsp;</td>
    <td width="44">&nbsp;</td>
    <td width="44">&nbsp;</td>
    <td width="374">&nbsp;</td>
    <td width="135"><input type="submit" name="button" id="button" value=" FILTRAR " onclick="asigna(); "  /></td>
    <td width="198"><input type="submit" name="button2" id="button2" value=" JUSTIFICAR " onclick="Aprueba();"  />
      <input type="submit" name="button3" id="button3" value=" ELIMINAR " onclick="Eliminar();"  /></td>
  </tr>
</table>
</div>
<table width="1102" border="0">
  <tr>
    <td width="8" bgcolor="#009933">&nbsp;</td>
    <td width="111" bgcolor="#009933" class="DDD"><p>Exportar Consulta:</p>
      </td>
    <td width="82" class="ff" bgcolor="#009933">&nbsp;</td>
    <td width="11" bgcolor="#009933">&nbsp;</td>
    <td width="352" bgcolor="#009933" class="F">Datos Consultados:</td>
    <td width="283" bgcolor="#009933">&nbsp;</td>
    <td width="206" bgcolor="#009933">&nbsp;</td>
    <td width="206" bgcolor="#009933">&nbsp;</td>
    <td width="15" bgcolor="#009933">&nbsp;</td>
    </tr>
  <tr>
    <td class="q" bgcolor="#009933">&nbsp;</td>
   <td class='q'> <? echo"<a target='_new' href='./Reportes/RptMarcado.php?area=$area&estado=$estado&tipo=$tipo&inicio=$inicio&final=$final&usuario=$usuario&it1=$it1&it2=$it2&it3=$it3&condi=$condi'><img src='img/pdf.gif' width='31' height='31' /></a>";?></td>
   <td class='q'><? echo "<a target='_new'  href='./Reportes/RptMarcadoExel.php?area=$area&estado=$estado&tipo=$tipo&inicio=$inicio&final=$final&usuario=$usuario&it1=$it1&it2=$it2&it3=$it3&condi=$condi'>1<img src='img/excel.gif' width='22' height='22' title='Reporte Detallado' /></a>";?>
   <? echo "<a target='_new'  href='./Reportes/RptMarcadoExel-S.php?area=$area&estado=$estado&tipo=$tipo&inicio=$inicio&final=$final&usuario=$usuario&it1=$it1&it2=$it2&it3=$it3&condi=$condi'>2<img src='img/excel.gif' width='22' height='22' title='Reporte Sintetico'/></a>";?></td>
    <td bgcolor="#009933">&nbsp;</td>
    <td > Usuario:<? echo $usuario?> </td>
    <td >Desde: <? echo $inicio?></td>
    <td >Hasta: <? echo $final?></td>
    <td >Condicion: </td>
    <td bgcolor="#009933">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#009933">&nbsp;</td>
    <td class="JJ" >A Pdf</td>
    <td class="JJ" >A Excel</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td >Estado: <? echo $it1?></td>
    <td >Tipo Marcado: <? echo $it2 ?></td>
    <td >Area: <? echo $area?></td>
    <td ><? echo $it3?></td>
    <td bgcolor="#009933">&nbsp;</td>
    </tr>
     <tr>
    <td bgcolor="#009933">&nbsp;</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td bgcolor="#009933">&nbsp;</td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
<thead>
			<tr>
				<th><h3>Codigo</h3></th>
				<th><h3>Usuario</h3></th>
				<th><h3>Fecha Y Hora</h3></th>
				<th><h3>Conteo Minutos</h3></th>
                <th><h3>Tipo Marcado</h3></th>
				<th><h3>Doc/Justifacion</h3></th>
                <th><h3>Condicion</h3></th>
				<th><h3>Estado</h3></th>
                <th><h3>Editar</h3></th>
                <th align="center"><h3>Elige
             <input type="checkbox" name="todo" id="todo" onclick="Todo();" />
                </h3></th>
				
			</tr>
	</thead>
		<tbody>
			<?
			$i=0;
            if(isset($_POST['ver'])){
				if($res1==NULL){echo ".::NO EXISTEN DATOS CON LOS PARAMETROS INGRESADOS::.";}
				 else{
			while ($reg = mysql_fetch_array($res1))
               {   
			$i=$i+1;
            echo"<tr>";
			echo"<td>".$reg[0]."</td>";
			echo"<td>".$reg[1]."</td>";
			echo"<td>".$reg[2]."</td>";
			echo"<td>".$reg[3]."</td>";
			echo"<td>".$reg[4]."</td>";
			echo"<td>".$reg[5]."</td>";
			echo"<td>".$reg[8]."</td>";
			echo"<td>".$reg[6]."</td>";
			
			?>
            
			<td><center> <a href="FrmModiMarcado.php?Cod=<? echo $reg[0]?>"  target="mainFrame" class="ui-widget-header"   onclick="return GB_myShow('D.R.S.A.U', this.href)"><img border='0'  src=./img/btn_edit.gif width='20' height='20' title="Modifica"/></a></td>
			<?
			echo"<td><center><input type='checkbox' value=".$reg[0]."   name='".$i."' id='".$i."'></center></td>";
			echo"</tr>";
			
			#CONTEO DE LA ACUMULACION DE MINUTOS Y DSCTO CORRESPONDIENTE
			$MINU=$MINU+$reg[3];
			$DCTOS=$DCTOS+$reg[7];
			#
			}
			
			$DCTOS=ceil($DCTOS);
			}}
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
			<span>Marcaciones por pagina</span>
		</div>
		<div id="navigation">
			<img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text">Pag.N°<span id="currentpage"></span> De <span id="pagelimit"></span></div>
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
</form>
</body>
</html>
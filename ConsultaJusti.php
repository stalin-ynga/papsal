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
	   $categoria="";
	  #
	  $it1="";
	  $it2="";
	  $it3="";
	  #
	   
	   if(isset($_POST['ver'])){
		   
	   $band=1;
	   $where="";
	  // traemos los datos ingresados en la consulta
	   $usuario=trim($_POST['NombreCom']);   
	   $inicio=$_POST['inicio'];
	   $final=$_POST['final'];
	   $area=trim($_POST['area']);
	   $estado=$_POST['estado'];
	   $tipo=$_POST['tipo'];
	   $categoria=$_POST['categoria'];
	   
	   //-------
	   //ASIGNAMOS EL VALOR LITERAL DE LAS VARIABLES CONSULTADAS
		if($estado=='T'){$it1='TODOS';};
		if($estado=='01'){$it1='PENDIENTE';};
		if($estado=='02'){$it1='APROBADO';};
		
		//
		if($categoria=='01'){$it3='PAPELETAS DE SALIDA';};
		if($categoria=='02'){$it3='PAPELETAS DE TARDANZA';};
		if($categoria=='03'){$it3='PAPELETAS VEHICULARES';};
		if($categoria=='04'){$it3='DOCUMENTOS Y FORMATOS';};
		// 
		if($tipo=='T'){$it2='TODOS';};
		if($tipo=='0000000001'){$it2='COMISION';};
		if($tipo=='0000000002'){$it2='SALUD';};
		if($tipo=='0000000003'){$it2='ASUNTO PERSONAL';};
		if($tipo=='0000000004'){$it2='ASUNTO PARTICULAR';};
		if($tipo=='0000000005'){$it2='VACACIONES';};
		if($tipo=='0000000006'){$it2='ONOMASTICO';};
		if($tipo=='0000000007'){$it2='DESCANSO POR SEPELIO';};
		if($tipo=='0000000008'){$it2='LICENSIA POR PATERNIDAD';};
		if($tipo=='0000000009'){$it2='TRATAMIENTO MEDICO';};
		if($tipo=='0000000010'){$it2='CARTA DE JUSTIFICACION';};
		if($tipo=='0000000011'){$it2='DESCANSO MEDICO';};
        if($tipo=='0000000012'){$it2='LICENSIA SINDICAL';};
		if($tipo=='0000000013'){$it2='FERIADOS';};
        if($tipo=='0000000014'){$it2='SUSPENSION';};
        if($tipo=='0000000015'){$it2='LICENSIA SIN GOZE DE HABER';};
		if($tipo=='0000000016'){$it2='LICENSIA POR MATERNIDAD(PRE-POST NATAL)';};
		//FIN DE LA ASIGANCION  
	    if($categoria=="01"){
			
		if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tblsalida.Statuss='$estado'";};
		if($tipo!="T"){$where=$where." AND TipoMotivo='$tipo'";};
			//
			
				   
$sql_guardar1="select tblsalida.Codigo,NombreCom,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,(SELECT Nombre from tblarea where tblarea.Codigo=tblusuario.area) as Area,Fundamento,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tblsalida,tblusuario WHERE NOT(Statuss='04' || TipoMotivo='0000000005' || TipoMotivo='0000000007' || TipoMotivo='0000000008' || TipoMotivo='0000000009' || TipoMotivo='0000000010' || TipoMotivo='0000000011' || TipoMotivo='0000000012' || TipoMotivo='0000000013' || TipoMotivo='0000000014' || TipoMotivo='0000000015' || TipoMotivo='0000000016')
AND tblusuario.Codigo=tblsalida.Usuario AND FecSalida BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";

       $res1 =mysql_query($sql_guardar1,$enlace); 
	  
	   }
	   
	   // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE TARDANZA 
		if($categoria=="02"){
			
		if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tbltardanza.Statuss='$estado'";};
		if($tipo!="T"){$where=$where." AND TipoMotivo='$tipo'";};
			
				   
$sql_guardar1="select tbltardanza.Codigo,NombreCom,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Fundamento,Fecha,(SELECT Nombre from tblarea where tblarea.Codigo=tblusuario.area) as Area,(CASE Marcado WHEN 'EN1' THEN 'ENTRADA DRSAU' WHEN 'EN2' THEN 'ENTRADA REFRIGERIO' ELSE NULL END) as Marcado,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tbltardanza,tblusuario WHERE NOT(Statuss='04')
AND tblusuario.Codigo=tbltardanza.Usuario AND Fecha BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
 
 
       $res1 =mysql_query($sql_guardar1,$enlace); 
	 
	   }
	   
	   // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE VEHICULAR
		if($categoria=="03"){
			
		if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tblvehicular.Statuss='$estado'";};
		if($tipo!="T"){$where=$where." AND TipoMotivo='$tipo'";};
			
				   
$sql_guardar1="select tblvehicular.Codigo,NombreCom,Fecha,(SELECT Modelo from tblauto where tblauto.Codigo=Vehiculo) as Vehi,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Destino,(SELECT tblarea.Nombre from tblarea where tblarea.Codigo=tblusuario.area ) as Area,
Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado from tblvehicular,tblusuario WHERE NOT(Statuss='04')
AND tblusuario.Codigo=tblvehicular.Usuario AND Fecha BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
 

       $res1 =mysql_query($sql_guardar1,$enlace); 
	   
	   }
	   
	    // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE VEHICULAR
   
    if($categoria=="04"){
			
		if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tblsalida.Statuss='$estado'";};
		if($tipo!="T"){$where=$where." AND TipoMotivo='$tipo'";};
			
				   
$sql_guardar1="select tblsalida.Codigo,NombreCom,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,(SELECT Nombre from tblarea where tblarea.Codigo=tblusuario.area) as Area,Fundamento,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado
from tblsalida,tblusuario WHERE NOT(Statuss='04' || TipoMotivo='0000000002')
AND tblusuario.Codigo=tblsalida.Usuario AND FecSalida BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";

       $res1 =mysql_query($sql_guardar1,$enlace); 
	  
	   }
   //--
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
    
 
        <link type="text/css" rel="stylesheet" href="./css/estilo.css" />
    
        
        <script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="./js/jquery-ui-1.8.4.custom.min.js"></script>
       <link href="jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
		<script type="text/javascript" src="./js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>



        <script type="text/javascript">
		jQuery(function() {
$( "#button" ).button();
  });
		$(document).ready(function(){
   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            elegido=$(this).val();
            $.post("categoria.php", { elegido: elegido }, function(data){
            $("#tipo").html(data);
            });            
        });
   })
});
            $(function(){
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
        var GB_ROOT_DIR = "./greybox/";
    </script>

   
   
<script type="text/javascript">
GB_myShow = function(caption,url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 435,
        width: width || 600,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

<script type="text/javascript">
GB_myShow2 = function(caption,url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 455,
        width: width || 500,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>
<script type="text/javascript">
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

<form name="f2" method="post" action="ConsultaJusti.php"  onSubmit="return validar(this);" class="Estilo9">
<div style="border-style:solid; border-color:#CCCCCC; border-width:thin; height=252px; width:250p; font-family: 'Times New Roman', Times, serif;">
<p>&nbsp;</p>
<table width="1105" border="0" class="d">
  <tr>
    <td width="864" bgcolor="#33CC00" class="a">Consultas Documentos De Justificacion</td>
  </tr>
</table>
<table width="1103" border="0">
  <tr>
    <td width="559" bgcolor="#993399" class="titulo_cabecera">&nbsp;</td>
    </tr>
</table>
<table width="1102" border="0" class="Estilo9">
  <tr>
    <td width="43"><span class="titulo_cabecera">Usuario:</span></td>
    <td width="462"><input name="NombreCom" type="text" class="tb61" id="NombreCom" /></td>
    <td width="8">&nbsp;</td>
    <td width="83"><span class="titulo_cabecera">Estado:</span></td>
    <td width="189"><select name="estado" class="tb6" id="estado">
     <option value="T">TODOS</option>
      <option value="01"> PENDIENTE</option>
      <option value="02"> APROBADO</option>
      
      
    </select></td>
    <td width="61"><span class="titulo_cabecera">Justificacion:</span></td>
    <td width="226"><label for="select"></label>
      <select name="tipo" class="tb6" id="tipo">
        <option value="T">TODOS</option>
        <option value="0000000001">COMISION</option>
        <option value="0000000002">SALUD</option>
        <option value="0000000004">ASUNTO PARTICULAR</option>
        <option value="0000000006">ONOMASTICO</option>
        
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
    <td><label for="textfield"></label>
      <input name="inicio" type="text" class="tb6" id="inicio"  readonly="readonly"/>
      <span class="titulo_cabecera">Hasta:
      <input name="final" type="text" class="tb6" id="final"  readonly="readonly"/>
      </span><span class="titulo_cabecera"></span></span></td>
    <td>&nbsp;</td>
    <td><span class="titulo_cabecera">Area/Unidad:</span></td>
    <td><span class="k">
      <input name="area" type="text" class="tb6" id="area" />
    </span></td>
    <td><span class="titulo_cabecera">Categoria:</span></td>
    <td><select name="categoria" class="tb6" id="categoria">
      <option value="01">PAPELETAS DE SALIDA</option>
      <option value="02">PAPELETAS DE TARDANZA</option>
      <option value="03">PAPELETAS VEHICULARES</option>
      <option value="04">DOCUMENTOS Y FORMATOS</option>
    </select></td>
  </tr>
</table>
<table width="1102" border="0">
  <tr>
    <td width="43">&nbsp;</td>
    <td width="462">&nbsp;</td>
    <td width="8">&nbsp;</td>
    <td width="83">&nbsp;</td>
    <td width="189"><input type="submit" name="button" id="button" value="  FILTRAR " onclick="asigna(); "  /></td>
    <td width="61">&nbsp;</td>
    <td width="226"><img src="images/add.png" width="16" height="16" /><a href="FrmAsignacion.php" target="mainFrame" class="ui-widget-header"  id="agrega" onclick="return GB_myShow('D.R.S.A.U', this.href)"> Agregar</a></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>
<table width="1103" border="0">
  <tr>
    <td width="6" bgcolor="#009933">&nbsp;</td>
    <td width="107" bgcolor="#009933" class="DDD"><p>Exportar Consulta:</p>
      </td>
    <td width="78" class="ff" bgcolor="#009933">&nbsp;</td>
    <td width="10" bgcolor="#009933">&nbsp;</td>
    <td width="281" bgcolor="#009933" class="F">Datos Consultados:</td>
    <td width="237" bgcolor="#009933">&nbsp;</td>
    <td width="187" bgcolor="#009933">&nbsp;</td>
    <td width="148" bgcolor="#009933">&nbsp;</td>
    <td width="11" bgcolor="#009933">&nbsp;</td>
    </tr>
  <tr>
    <td class="q" bgcolor="#009933">&nbsp;</td>
    <td class="q"><? echo"<a target='_new' href='./Reportes/RptDocumento.php?area=$area&inicio=$inicio&final=$final&usuario=$usuario&estado=$estado&tipo=$tipo&categoria=$categoria'><img src='img/pdf.gif' width='31' height='31' title='Reporte Detallado' /></a>";?><? echo"<a target='_new' href='./Reportes/RptDocumentoEspe.php?inicio=$inicio&final=$final&categoria=$categoria'><img src='img/pdf.gif' width='31' height='31' title='Reporte Especial' /></a>";?></td>
    <td class="q"><? echo"<a target='_new' href='./Reportes/RptDocumentoExel.php?area=$area&inicio=$inicio&final=$final&usuario=$usuario&estado=$estado&tipo=$tipo&categoria=$categoria'><img src='img/excel.gif' width='22' height='22' title='Reporte A Excel' /></a>";?></td>
    <td bgcolor="#009933">&nbsp;</td>
    <td > Usuario:<? echo $usuario?> </td>
    <td >Desde: <? echo $inicio?></td>
    <td >Hasta: <? echo $final?></td>
    <td class="xx" >Categoria:</td>
    <td class="xx" bgcolor="#009933">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#009933">&nbsp;</td>
    <td class="JJ" >A Pdf</td>
    <td class="JJ" >A Excel</td>
    <td bgcolor="#009933">&nbsp;</td>
    <td >Estado: <? echo $it1 ?> </td>
    <td >Justificacion: <? echo $it2 ?></td>
    <td >Area: <? echo $area?></td>
    <td ><? echo $it3 ?></td>
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
				
				<? 
				
				if(isset($_POST['ver']))
				{		
			
	             if($categoria=='01' || $categoria=='04'){		
			echo"	<th width='113'><h3>Codigo</h3></th>";
			echo"	<th width='113'><h3>Trabajador</h3></th>";
			echo"	<th width='156'><h3>Fecha Salida</h3></th>";
			echo"	<th width='159'><h3>Fecha Retorno</h3></th>";
            echo"   <th width='100'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Lugar</h3></th>";
			echo"   <th width='119'><h3>Area</h3></th>";
            echo"   <th width='232'><h3>Fundamento</h3></th>";
			echo"   <th width='232'><h3>Observacion</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";
			echo"	<th width='50'><h3>Editar</h3></th>";
			
				 }
			
			
	             if($categoria=='02'){
						
			echo"	<th width='60'><h3>Codigo</h3></th>";
			echo"	<th width='113'><h3>Trabajador</h3></th>";
			echo"	<th width='100'><h3>Tipo Motivo</h3></th>";
			echo"	<th width='200'><h3>Fundamento</h3></th>";
            echo"   <th width='120'><h3>Fecha</h3></th>";
			echo"   <th width='119'><h3>Area</h3></th>";
            echo"   <th width='119'><h3>Marcado Justificado</h3></th>";
			echo"	<th width='50'><h3>Estado</h3></th>";
			
				 }
				 
				 
	             if($categoria=='03'){		
			echo"	<th width='113'><h3>Codigo</h3></th>";
			echo"	<th width='113'><h3>Trabajador</h3></th>";
			echo"	<th width='156'><h3>Fecha Salida</h3></th>";
			echo"	<th width='159'><h3>Vehiculo</h3></th>";
            echo"   <th width='100'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Destino</h3></th>";
			echo"   <th width='119'><h3>Area</h3></th>";
            echo"   <th width='232'><h3>Observacion</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";
				 }
			}
			else 
			{
			echo"	<th width='113'><h3>Codigo</h3></th>";
			echo"	<th width='113'><h3>Trabajador</h3></th>";
			echo"	<th width='156'><h3>Fecha Salida</h3></th>";
			echo"	<th width='159'><h3>Fecha Retorno</h3></th>";
            echo"   <th width='100'><h3>Tipo</h3></th>";
            echo"   <th width='119'><h3>Lugar</h3></th>";
			echo"   <th width='119'><h3>Area</h3></th>";
            echo"   <th width='232'><h3>Fundamento</h3></th>";
			echo"   <th width='232'><h3>Observacion</h3></th>";
			echo"	<th width='100'><h3>Estado</h3></th>";	
			echo"	<th width='50'><h3>Editar</h3></th>";
			}
			?>
				
			</tr>
	  </thead>
		<tbody>
			<?
            if(isset($_POST['ver'])){
				if($res1==NULL){echo ".::NO EXISTEN DATOS CON LOS PARAMETROS INGRESADOS::.";}
				 else{
					 if($categoria=='01' || $categoria=='04'){
					 
			while ($reg = mysql_fetch_array($res1))
               {   
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
			?>
            
			<td><center> <a href="FrmModiPape.php?Cod=<? echo $reg[0]?>"  target="mainFrame" class="ui-widget-header"   onclick="return GB_myShow2('D.R.S.A.U', this.href)"><img border='0'  src=./img/btn_edit.gif width='20' height='20' title="Modifica"/></a></td>
			<?
			echo"</tr>";
			}}
			
			if($categoria=='02'){
					 
			while ($reg = mysql_fetch_array($res1))
               {   
            echo"<tr>";
			echo"<td>".$reg[0]."</td>";
			echo"<td>".$reg[1]."</td>";
			echo"<td>".$reg[2]."</td>";
			echo"<td>".$reg[3]."</td>";
			echo"<td>".$reg[4]."</td>";
			echo"<td>".$reg[5]."</td>";
			echo"<td>".$reg[6]."</td>";
			echo"<td>".$reg[7]."</td>";
			echo"</tr>";
			}}
			
			
			if($categoria=='03'){
					 
			while ($reg = mysql_fetch_array($res1))
               {   
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
			echo"</tr>";
			}}
			
			
			}}
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
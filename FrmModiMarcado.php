<?php

ini_set("session.gc_maxlifetime","30000");
session_start();

include('./clases/conexion.php');

$enlace=conexion();
	
mysql_select_db('dbpap', $enlace);
	
$Cod="";

$Cod=$_GET['Cod'];	   

if($Cod!='A'){
$sql_guardar1="select NombreCom,Fecha,Conteo,(CASE Tipo WHEN 'EN1' THEN 'ENTRADA DRSAU' WHEN 'SA1' THEN 'SALIDA REFRIGERIO' WHEN 'EN2' THEN 'ENTRADA REFRIGERIO' WHEN 'SA2' THEN 'SALIDA DRSAU' ELSE NULL END) as tipo,tblmarcado.Condicion,tblmarcado.codigo from tblmarcado,tblusuario WHERE tblmarcado.Codigo='".$Cod."' and tblusuario.codigo=tblmarcado.usuario ; 
 ";
 
$res1 =mysql_query($sql_guardar1,$enlace); 

$reg = mysql_fetch_array($res1);
}

if($_SESSION["User"] != "1"){header("Index.php");}


//--


if(isset($_POST["guardar"])>0){
	$codigo=$_POST['codigo'];
	$min=$_POST['min'];
	$est=$_POST['est'];
	$fecha=$_POST['fecha'];
	
	if($est=='01'){
   $sql_guardar1=" UPDATE TBLMARCADO SET Estado='MARCADO NORMAL', Conteo=$min,Condicion='$est',Fecha='$fecha' WHERE Codigo='$codigo'";
 
 $res1 =mysql_query($sql_guardar1,$enlace); 
	}
   
   if($est=='02'){
   $sql_guardar1=" UPDATE TBLMARCADO SET Estado='JUSTIFICADO', Conteo=$min,Condicion='$est',Fecha='$fecha' WHERE Codigo='$codigo'
 ";
 
 $res1 =mysql_query($sql_guardar1,$enlace); 
	}
   
   if($est=='03'){
   $sql_guardar1=" UPDATE TBLMARCADO SET Estado='NO MARCO', Conteo=$min,Condicion='$est',Fecha='$fecha' WHERE Codigo='$codigo'
 ";
 
 $res1 =mysql_query($sql_guardar1,$enlace); 
	}
	
	if($est=='04'){
   $sql_guardar1=" UPDATE TBLMARCADO SET Estado='TARDANZA', Conteo=$min,Condicion='$est',Fecha='$fecha' WHERE Codigo='$codigo'
 ";
 
 $res1 =mysql_query($sql_guardar1,$enlace); 
	}
	   
	  header("location:concluye.php?cod=6");
	// echo "<script>alert('Operacion Exitosa');";
   
}
?>

<html>
<head>
<title>Ficha De Inscripcion</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<script language="javascript">


function guardar(){
 
		document.f.guardar.value = "1";
		document.f.Cod.value = "A";
	
}

	function validar(f){
		if(f.fecha.value ==""){
			alert("Ingresar La Fecha");
			return false;
		}
		
					
		f.submit();
		return true;
	}
	
	
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
.Estilo9 {
	font-size: 12px;
	color: #000;
	text-align: right;
}
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

<td colspan="2" align="left" bgcolor="#00FF00" style="height: 3px; font-size: 14px;"><form name="f" action="FrmModiMarcado.php" method="post" onSubmit="return validar(this)" >
<table width="464" border="0">
<tr>
          <td width="458" height="29" bgcolor="#FFFFFF"><div align="center" class="Estilo1"><img src="images/dra12.png" width="461" height="73"></div></td>
        </tr>
      </table>
  <table width="466" border="0">
<tr>
<td width="460" height="18" bgcolor="#00CC33"><div align="center" class="Estilo1">Mantenimiento De Marcado </div></td>
                            </tr>
                          </table>
  <table width="463" border="0">
                            <tr>
                              <td width="457"><div align="right"><span class="Estilo2"> <span class="s">(*)campos obligatorios</span></span><span class="s"></span></div></td>
                            </tr>
      </table>
      <table width="463" border="0">
                            <tr>
                              <td width="457" bgcolor="#00CC00"><span class="Estilo3">DATOS DE MARCADO</span></td>
                            </tr>
                          </table>
<table width="466" border="0">
                           
                            <tr>
                              <td width="97"><span class="Estilo9">Trabajador: </span></td>
                              <td width="359">
                                <input name="pat" type="text" id="pat" value="<? echo $reg[0]?>" size="50" maxlength="100" disabled />
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Tipo De Entrada</span>:</td>
                              <td style="text-align: left"><input name="mat" type="text" id="mat" value="<? echo $reg[3]?>" size="25" maxlength="100" disabled/>
                              <span class="Estilo2">(*) </span>
                              <span class="Estilo9"> Min.Acum: </span>
                              <input name="min" type="text"  id="min" value="<? echo $reg[2]?>"  size="7">
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                            <tr>
                              <td><span class="Estilo9">Estado Marcacion</span>:</td>
                              <td><label>
                              
                              <? if($reg[4]=='01'){ ?>
                                <select name="est" id="est">
                                  <option value="01" selected>MARCADO NORMAL</option>
                                  <option value="02">JUSTIFICADO</option>
                                   <option value="03">NO MARCO</option>
                                  <option value="04">TARDANZA</option>
                                </select>
                                <? } ?>
                                
                              <? if($reg[4]=='02'){ ?>
                                <select name="est" id="est">
                                  <option value="01" >MARCADO NORMAL</option>
                                  <option value="02" selected>JUSTIFICADO</option>
                                   <option value="03">NO MARCO</option>
                                  <option value="04">TARDANZA</option>
                                </select>
                                <? } ?>
                                
                              <? if($reg[4]=='03'){ ?>
                                <select name="est" id="est">
                                  <option value="01" >MARCADO NORMAL</option>
                                  <option value="02">JUSTIFICADO</option>
                                   <option value="03" selected>NO MARCO</option>
                                  <option value="04">TARDANZA</option>
                                </select>
                                <? } ?>
                                
                              <? if($reg[4]=='04'){ ?>
                                <select name="est" id="est">
                                  <option value="01" >MARCADO NORMAL</option>
                                  <option value="02">JUSTIFICADO</option>
                                   <option value="03">NO MARCO</option>
                                  <option value="04" selected>TARDANZA</option>
                                </select>
                                <? } ?>
                                <span class="Estilo2">(*) </span><span class="Estilo9">Fecha</span><span class="Estilo2"><span class="Estilo9">: </span></span></label>
                             
                              <input name="fecha" type="text" id="fecha"  value="<? echo $reg[1]?>" size="15" >
                              <span class="Estilo2">(*)</span></td>
                            </tr>
                          </table>
<table width="462" border="0">
<tr>
                              <td width="157" height="26" bgcolor="#00CC00"><input name="guardar" type="hidden" id="guardar">
                              <input name="Cod" type="hidden" id="Cod">
                              <input name="codigo" type="hidden" id="codigo" value="<? echo $reg[5]?>"></td>
                              <td width="68" bgcolor="#00CC00"><input type="submit" name="Submit" value="Actualizar" align="center" onClick="guardar();" /></td>
                              <td width="58" bgcolor="#00CC00"><input type="reset" name="Submit2" value="Limpiar" /></td>
                              <td width="161" bgcolor="#00CC00">&nbsp;</td>
                            </tr>
                        </table>
</form>           

</body>

</html>
<?php
include('./clases/conexion.php');

$enlace=conexion();
	
mysql_select_db('dbpap', $enlace);




$options="";
if ($_POST["elegido"]=='01') {
    $options= '
	<option value="T">TODOS</option>
    <option value="0000000001">COMISION</option>
    <option value="0000000002">SALUD</option>
    <option value="0000000004">ASUNTO PARTICULAR (DSCTO)</option>
	<option value="0000000006">ONOMASTICO</option>
 
    ';    
}
if ($_POST["elegido"]=='02') {
    $options= '
	<option value="T">TODOS</option>
    <option value="0000000002">SALUD</option>
    <option value="0000000003">ASUNTO PERSONAL</option>
    <option value="0000000004">ASUNTO PARTICULAR</option>
 
    ';    
}
if ($_POST["elegido"]=='03') {
    $options= '
    <option value="0000000001">COMISION</option>
    ';    
}
if ($_POST["elegido"]=='04') {
	$temp="";
	$sql_guardar1="select Codigo,Nombre from tbltipomotivo;";
 
$res1 =mysql_query($sql_guardar1,$enlace); 

while ($reg = mysql_fetch_array($res1))
               {$temp.=' <option value="'.$reg[0].'">'.$reg[1].'</option> ';  }
    $options='
	<option value="T">TODOS</option> ';   
	
	$options.=$temp; 
}
echo $options;    
?>
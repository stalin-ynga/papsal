<?php
function conexion()
{
//$enlace=mysql_connect("localhost","root","105811");
$enlace=mysqli_connect("localhost","root","");
return $enlace;
}
?>

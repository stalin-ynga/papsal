<?php
require("mysql.php");
//Realizado por: Learning With You!
/***  En nuestro caso usamos una tabla llamada "Usuarios" con 2 campos: id y nombre_usuario ***/

function comprobar_disponibilidad($name)		
//Esta pequeña funcion usa la clase mysql.php para conectarse a la base de datos y realizar la consulta
{
        $mysql = new mysql();
        $mysql->query("SELECT * FROM tblusuario WHERE Usser='".$name."'"); 
        if ($mysql->num_rows() > 0)
              return false;
        else
                return true;
}

if ($_POST['user'] != "")						   //Si el campo usuario tiene algo
{
    if (!comprobar_disponibilidad($_POST['user'])) // Usuario resgistrado
    {
        echo "0";
    }
    else											  // Usuario No registrado
    {
        echo "1";
    }
}
?>

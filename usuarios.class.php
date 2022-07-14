<?php
class Usuarios
{
    public function  __construct() {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'dbpap';

        mysql_connect($dbhost, $dbuser, $dbpass);

        mysql_select_db($dbname);
    }

    public function buscarUsuario($nombreUsuario){
        $datos = array();

        $sql = "SELECT NombreCom FROM tblusuario
                WHERE estado='A' and NombreCom LIKE '%$nombreUsuario%'";


        $resultado = mysql_query(utf8_decode($sql));

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['NombreCom']);
        }

        return $datos;
    }


 public function buscarArea($nombreUsuario){
        $datos = array();

        $sql = "SELECT Nombre FROM tblarea
                WHERE Nombre LIKE '%$nombreUsuario%'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['Nombre']);
        }

        return $datos;
    }
public function buscarMotivo($nombreUsuario){
        $datos = array();

        $sql = "SELECT Nombre FROM tbltipomotivo
                WHERE Nombre LIKE '%$nombreUsuario%'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['Nombre']);
        }

        return $datos;
    }
public function buscarAuto($nombreUsuario){
        $datos = array();

        $sql = "SELECT DISTINCT(Modelo) FROM tblauto
                WHERE Modelo LIKE '%$nombreUsuario%'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['Modelo']);
        }

        return $datos;
    }
	
	public function buscarCondi($nombreUsuario){
        $datos = array();

        $sql = "SELECT Nombre FROM tblcondicion
                WHERE Nombre LIKE '%$nombreUsuario%'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['Nombre']);
        }

        return $datos;
    }
	
	public function buscarAcceso($nombreUsuario){
        $datos = array();

        $sql = "SELECT Descripcion FROM tblacceso
                WHERE Descripcion LIKE '%$nombreUsuario%'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['Descripcion']);
        }

        return $datos;
    }
	public function buscarMarca($nombreUsuario){
        $datos = array();

        $sql = "SELECT DISTINCT(Marca) FROM tblauto
                WHERE Marca LIKE '%$nombreUsuario%'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['Marca']);
        }

        return $datos;
    }
	
	public function buscarTipo($nombreUsuario){
        $datos = array();

        $sql = "SELECT Distinct(Tipo) FROM tblauto
                WHERE Tipo LIKE '%$nombreUsuario%'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['Tipo']);
        }

        return $datos;
    }
	public function buscarPlaca($nombreUsuario){
        $datos = array();

        $sql = "SELECT Placa FROM tblauto
                WHERE Placa LIKE '%$nombreUsuario%'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['Placa']);
        }

        return $datos;
    }
	
	public function buscarJefe($nombreUsuario){
        $datos = array();

        $sql = "SELECT NombreCom FROM tblusuario
                WHERE NombreCom LIKE '%$nombreUsuario%' AND Acceso='0000000002'
                ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['NombreCom']);
        }

        return $datos;
    }
}


<?php

$cod="";

$cod=$_GET['cod'];

include_once 'usuarios.class.php';

$usuario = new Usuarios();

if($cod==1){
echo json_encode($usuario->buscarUsuario( utf8_encode( $_GET['term']) ) ) ;
}

if($cod==2){
echo json_encode($usuario->buscarArea($_GET['term']));
}

if($cod==3){
echo json_encode($usuario->buscarCondi($_GET['term']));
}

if($cod==4){
echo json_encode($usuario->buscarAcceso($_GET['term']));
}

if($cod==5){
echo json_encode($usuario->buscarTipo($_GET['term']));
}

if($cod==6){
echo json_encode($usuario->buscarAuto($_GET['term']));
}

if($cod==7){
echo json_encode($usuario->buscarMarca($_GET['term']));
}

if($cod==8){
echo json_encode($usuario->buscarTipo($_GET['term']));
}

if($cod==9){
echo json_encode($usuario->buscarPlaca($_GET['term']));
}

if($cod==10){
echo json_encode($usuario->buscarJefe($_GET['term']));
}
if($cod==11){
echo json_encode($usuario->buscarMotivo($_GET['term']));
}

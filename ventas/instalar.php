<?php

include_once "config.php";
include_once "entidades/usuario.php";

$usuario = new Usuario();
$usuario->usuario="jchejo";
$usuario->clave=$usuario->encriptarClave("admin123");
$usuario->nombre="jesus";
$usuario->apellido="chejo";
$usuario->correo="chejojesus@gmail.com";
$usuario->insertar();

?>
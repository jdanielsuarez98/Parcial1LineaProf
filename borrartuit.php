<?php

require_once "libs/php/tools_daniel.php";
require_once "libs/php/db_daniel.php";

LimpiarEntradas();
IniciarSesionSegura();
MostrarErrores();

if(!$_SESSION['UsuarioConectado'])
{
    header("location:index.php");
}
$id=$_GET["id"];

ConexionDB()->query("DELETE FROM `mensajes` WHERE `Id`=$id");

header("location:index.php");
?>
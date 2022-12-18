<?php
session_start();
require dirname(__DIR__,2)."/vendor/autoload.php";
use Fct\Usuarios;
use Fct\Imagenes;
use Fct\Viviendas;

if(!isset($_SESSION['usuario'])){
    header("Location:../index.php");
}
if(!isset($_POST)){
header("loaction:index.php");
}

if(isset($_POST['id'])){
    (new Viviendas)->delete($_POST['id']);
    $_SESSION['mensaje']="Vivienda ".$_POST['id']." borrada con éxito!";
    header('Location:index.php');
    die();

}
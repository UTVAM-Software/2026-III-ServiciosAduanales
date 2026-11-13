<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once("cliente/modelo.php");
require_once("helpers/html.php");


$accion = $_POST['accion'] ?? $_GET['accion'] ?? 'listar';
if($accion == 'listar') {
    $mc = new Cliente();
    $ctes = $mc->all();
    $vista = "cliente/vista/listar.php";
    include("vista/template.base.php");
} else if ($accion == 'mostrar') {

} else if ($accion == 'nuevo') {

} else if ($accion == 'modificar') {

} else if ($accion == 'eliminar') {

}

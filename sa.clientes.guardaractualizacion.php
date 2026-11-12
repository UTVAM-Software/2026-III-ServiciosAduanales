<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once("sa.basedatos.php");

$cnn = conectar();
$id = $_GET["id"];

$query = "
    UPDATE cliente SET
    nombre = '" . $_POST["nombre"] . "',
    razon_social = ' " . $_POST["razon_social"] . " ',
    rfc = '" . $_POST["rfc"] . "'
    WHERE id = $id;
    ";

$cnn->query($query);

header("location: sa.clientes.detalle.php?id=$id");

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once("sa.basedatos.php");

$cnn = conectar();
$query = "
    INSERT INTO cliente (nombre, razon_social, rfc)
    VALUES ('" . $_POST["nombre"] . "', ' " . $_POST["razon_social"] . " ', '" . $_POST["rfc"] . "');
    ";

$cnn->query($query);

$query = "SELECT LAST_INSERT_ID()";
$resultado = $cnn->query($query);
$registros = $resultado->fetch_all();
$id = $registros[0][0];

header("location: sa.clientes.detalle.php?id=$id");

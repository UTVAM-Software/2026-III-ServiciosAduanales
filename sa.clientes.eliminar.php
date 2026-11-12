<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once("sa.basedatos.php");

$cnn = conectar();
$id = $_GET["id"];

$query = "
    DELETE FROM cliente WHERE id = $id;
    ";
$cnn->query($query);

header("location: sa.clientes.php?id=$id");

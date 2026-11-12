<?php

require_once("sa.cliente.modelo.php");


$accion = $_POST['accion'] ?? $_GET['accion'] ?? 'listar';
if($accion == 'listar') {
    $mc = ModeloCliente();
    $ctes = $mc->all();
    
} else if ($accion == 'mostrar') {

} else if ($accion == 'nuevo') {

} else if ($accion == 'modificar') {

} else if ($accion == 'eliminar') {

}

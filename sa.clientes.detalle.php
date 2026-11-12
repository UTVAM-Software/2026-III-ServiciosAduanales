<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once("sa.basedatos.php");
require_once("sa.html.php");

$cnn = conectar();
$id = $_GET["id"];

$query = "SELECT * FROM cliente WHERE id = '$id' ";
$resultado = $cnn->query($query);
$cliente = $resultado->fetch_all(MYSQLI_ASSOC)[0];

$regs = $cnn->query("SELECT * FROM medio_contacto WHERE cliente_id = $id;");
$medios_contacto = $regs->fetch_all(MYSQLI_ASSOC);
$regs = $cnn->query("SELECT * FROM edificio WHERE cliente_id = $id;");
$edificios = $regs->fetch_all(MYSQLI_ASSOC);

try {
$regs = $cnn->query(
    "
    SELECT * FROM pedido p
    LEFT JOIN edificio salida on p.edificio_id_sale = salida.id
    LEFT JOIN edificio llegada on p.edificio_id_llega = llegada.id
    LEFT JOIN proveedor pr on p.proveedor_id = pr.id
    LEFT JOIN servicio s on s.pedido_num_pedido = p.num_pedido
    WHERE p.cliente_id = $id;
    "
);
$pedidos = $regs->fetch_all();
} catch (Exception $e) {
    echo "<br />$e";
    $pedidos = [];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Aduanales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css" />
    <link rel="shortcut icon" href="sa.icon.png" type="image/png" />
</head>

<body>

    <?php AddHeader(); ?>

    <main class="container">

        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a class="btn-solid theme-secondary" href="sa.clientes.php?id=<?php echo $id; ?>">
                <i class="bi bi-list-columns-reverse"></i>
                Listado de Clientes
            </a>
            <a class="btn-solid theme-warning" href="sa.clientes.actualizar.php?id=<?php echo $id; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path
                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                </svg>
                Actualizar Cliente
            </a>
            <a class="btn-solid theme-danger" href="sa.clientes.eliminar.php?id=<?php echo $id; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path
                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                </svg>
                Eliminar Cliente
            </a>
        </div>

        <h1>Clientes <small class="fg-4"><?php echo $cliente["nombre"]; ?></small></h1>

        <form method="post" action="sa.clientes.guardarnuevo.php">
            <fieldset disabled="disabled">
                <div class="row">
                    <div class="col mb-3 form-floating">
                        <label for="nombre">Nombre:</label>
                        <input value="<?php echo $cliente["nombre"] ?>" type="text" name="nombre" id="nombre"
                            class="form-control" placeholder=" " />
                    </div>
                    <div class="col mb-3 form-floating">
                        <label for="razon_social">Razon Social:</label>
                        <input value="<?php echo $cliente["razon_social"] ?>" type="text" name="razon_social"
                            id="razon_social" class="form-control" placeholder=" " />
                    </div>
                    <div class="col mb-3 form-floating">
                        <label for="rfc">RFC:</label>
                        <input value="<?php echo $cliente["rfc"] ?>" type="text" name="rfc" id="rfc"
                            class="form-control" placeholder=" " />
                    </div>
                </div>
            </fieldset>
        </form>

        <div class="row">
            <div class="col">
                <h2>Medios de Contacto</h2>
                <ul class="list-group">
                    <?php foreach ($medios_contacto as $mc) { ?>
                        <li class="list-group-item">
                            <?php
                            if ($mc["tipo"] == 'whats app') {
                                echo '<i class="bi bi-whatsapp"></i>';
                            } else if ($mc["tipo"] == 'facebook') {
                                echo '<i class="bi bi-facebook"></i>';
                            } else if ($mc["tipo"] == 'instagram') {
                                echo '<i class="bi bi-instagram"></i>';
                            } else if ($mc["tipo"] == 'messenger') {
                                echo '<i class="bi bi-messenger"></i>';
                            } else if ($mc["tipo"] == 'telefono') {
                                echo '<i class="bi bi-telephone-fill"></i>';
                            } else if ($mc["tipo"] == 'correo') {
                                echo '<i class="bi bi-envelope-at-fill"></i>';
                            }
                            echo " " . $valor;
                            ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col">
                <h2>Almacenes y Oficinas</h2>
                <div class="border rounded overflow-hidden">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Edificio</th>
                                <th>Tipo</th>
                                <th>Dirección</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach ($edificios as $ed) {
                                ?>
                                <tr>
                                    <td><?php echo $ed["nombre"]; ?></td>
                                    <td class="text-capitalize"><?php echo $ed["tipo"]; ?></td>
                                    <td>
                                        <?php echo $ed["calle"]; ?>
                                        <?php echo $ed["num_ext"]; ?>
                                        <?php echo $ed["num_int"] ? " (Int. " . $ed["num_int"] . ")" : ""; ?>,
                                        <br />
                                        <?php echo $ed["colonia"]; ?>, <br />
                                        <?php echo $ed["municipio"]; ?>, <?php echo $ed["estado"]; ?>, <br />
                                        <?php echo $ed["pais"]; ?><br />
                                        C.P. <?php echo $ed["cp"]; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h2>Pedidos</h2>

        <div class="border rounded overflow-hidden">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Núm. Pedido</th>
                        <th>Núm. Servicio</th>
                        <th>INCOTERM</th>
                        <th>Proveedor</th>
                        <th>Salida</th>
                        <th>Llegada</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach($pedidos as $p) {
                        ?>
                        <tr>
                            <td><?php echo $p[0]; ?></td>
                            <td><?php echo $p[35]; ?></td>
                            <td><?php echo $p[1]; ?></td>
                            <td><?php echo $p[34]; ?></td>
                            <td data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<?php echo $p["10"]; ?> <?php echo $p["13"]; ?> <?php echo $p["12"] ? " (Int. " . $p["12"] . ")" : ""; ?>, <br /> <?php echo $p["11"]; ?>, <br /> <?php echo $p["14"]; ?>, <?php echo $p["15"]; ?>, <br /> <?php echo $p["17"]; ?><br /> C.P. <?php echo $p["16"]; ?>"><?php echo $p[8]; ?></td>
                            <td data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<?php echo $p["23"]; ?> <?php echo $p["26"]; ?> <?php echo $p["25"] ? " (Int. " . $p["25"] . ")" : ""; ?>, <br /> <?php echo $p["24"]; ?>, <br /> <?php echo $p["27"]; ?>, <?php echo $p["28"]; ?>, <br /> <?php echo $p["30"]; ?><br /> C.P. <?php echo $p["29"]; ?>"><?php echo $p[21]; ?></td>
                        </tr>
                        <?php
                    }?>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>

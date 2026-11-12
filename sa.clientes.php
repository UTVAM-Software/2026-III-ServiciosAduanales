<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once("sa.basedatos.php");
require_once("sa.html.php");

$cnn = conectar();
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
            <a class="btn-solid theme-secondary" href="sa.clientes.nuevo.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg>
                Agregar Cliente
            </a>
        </div>

        <h1>Clientes</h1>

        <?php
        try {
            $resultado = $cnn->query("SELECT * FROM cliente ORDER BY rfc;");
            $registros = $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            echo $e;
        }
        ?>
        <div class="border rounded overflow-hidden">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Razon Social</th>
                        <th>RFC</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    try {
                        foreach ($registros as $registro) {
                            ?>
                            <tr>
                                <td>
                                    <a href="sa.clientes.detalle.php?id=<?php echo $registro["id"]; ?>">
                                        <?php echo $registro["nombre"]; ?>
                                    </a>
                                </td>
                                <td><?php echo $registro["razon_social"]; ?></td>
                                <td><?php echo $registro["rfc"]; ?></td>
                                <th class="text-end">
                                    <a class="btn-solid theme-warning"
                                        href="sa.clientes.actualizar.php?id=<?php echo $registro["id"]; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                        Actualizar
                                    </a>
                                    <a class="btn-solid theme-danger" href="sa.clientes.eliminar.php?id=<?php echo $registro["id"]; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                        </svg>
                                        Eliminar
                                    </a>
                                </th>
                            </tr>
                            <?php

                        }
                    } catch (Exception $e) {
                        echo $e;
                    }
                    ?>
                </tbody>

            </table>
        </div>

    </main>
</body>

</html>

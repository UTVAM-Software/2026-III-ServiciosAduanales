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

        <h1>Clientes <small class="fg-4">Nuevo</small></h1>

        <form method="post" action="sa.clientes.guardaractualizacion.php?id=<?php echo $id; ?>">
            <fieldset>
            <div class="row">
                <div class="col mb-3 form-floating">
                    <label for="nombre">Nombre:</label>
                    <input value="<?php echo $cliente["nombre"]; ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder=" " />
                </div>
                <div class="col mb-3 form-floating">
                    <label for="razon_social">Razon Social:</label>
                    <input value="<?php echo $cliente["razon_social"]; ?>" type="text" name="razon_social" id="razon_social" class="form-control" placeholder=" " />
                </div>
                <div class="col mb-3 form-floating">
                    <label for="rfc">RFC:</label>
                    <input value="<?php echo $cliente["rfc"]; ?>" type="text" name="rfc" id="rfc" class="form-control" placeholder=" " />
                </div>
            </div>
            </fieldset>
            <button type="submit" class="col btn-solid theme-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-floppy-fill" viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                    <path
                        d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                </svg>
                Guardar
            </button>
        </form>

    </main>

</body>

</html>

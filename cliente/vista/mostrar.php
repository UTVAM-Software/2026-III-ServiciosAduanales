<div class="btn-group float-end" role="group" aria-label="Basic example">
    <a class="btn-solid theme-secondary" href="clientes.php">
        <i class="bi bi-list-columns-reverse"></i>
        Listado de Clientes
    </a>
    <a class="btn-solid theme-warning" href="clientes.php?accion=actualizar&id=<?php echo $cte->id; ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill"
            viewBox="0 0 16 16">
            <path
                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
        </svg>
        Actualizar Cliente
    </a>
    <a class="btn-solid theme-danger" href="clientes.php?accion=eliminar&id=<?php echo $cte->id; ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill"
            viewBox="0 0 16 16">
            <path
                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
        </svg>
        Eliminar Cliente
    </a>
</div>

<h1>Clientes <small class="fg-4"><?php echo $cte; ?></small></h1>

<form method="post" action="">
    <fieldset disabled="disabled">
        <div class="row">
            <div class="col mb-3 form-floating">
                <label for="nombre">Nombre:</label>
                <input value="<?php echo $cte->nombre; ?>" type="text" name="nombre" id="nombre"
                    class="form-control" placeholder=" " />
            </div>
            <div class="col mb-3 form-floating">
                <label for="razon_social">Razon Social:</label>
                <input value="<?php echo $cte->razon_social; ?>" type="text" name="razon_social" id="razon_social"
                    class="form-control" placeholder=" " />
            </div>
            <div class="col mb-3 form-floating">
                <label for="rfc">RFC:</label>
                <input value="<?php echo $cte->rfc; ?>" type="text" name="rfc" id="rfc" class="form-control"
                    placeholder=" " />
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
            <?php foreach ($pedidos as $p) {
                ?>
                <tr>
                    <td><?php echo $p[0]; ?></td>
                    <td><?php echo $p[35]; ?></td>
                    <td><?php echo $p[1]; ?></td>
                    <td><?php echo $p[34]; ?></td>
                    <td data-bs-toggle="tooltip" data-bs-html="true"
                        data-bs-title="<?php echo $p["10"]; ?> <?php echo $p["13"]; ?> <?php echo $p["12"] ? " (Int. " . $p["12"] . ")" : ""; ?>, <br /> <?php echo $p["11"]; ?>, <br /> <?php echo $p["14"]; ?>, <?php echo $p["15"]; ?>, <br /> <?php echo $p["17"]; ?><br /> C.P. <?php echo $p["16"]; ?>">
                        <?php echo $p[8]; ?></td>
                    <td data-bs-toggle="tooltip" data-bs-html="true"
                        data-bs-title="<?php echo $p["23"]; ?> <?php echo $p["26"]; ?> <?php echo $p["25"] ? " (Int. " . $p["25"] . ")" : ""; ?>, <br /> <?php echo $p["24"]; ?>, <br /> <?php echo $p["27"]; ?>, <?php echo $p["28"]; ?>, <br /> <?php echo $p["30"]; ?><br /> C.P. <?php echo $p["29"]; ?>">
                        <?php echo $p[21]; ?></td>
                </tr>
                <?php
            } ?>
        </tbody>
    </table>
</div>

<?php
require_once("helpers/basedatos.php");

class Edificio extends Modelo
{
    public function __construct($id = 0, $nombre = "", $tipo = "", $calle = "", $colonia = "", $num_int = "", $num_ext = "", $municipio = "", $estado = "", $cp = "", $pais = "", $cliente_id = 0, $proveedor_id = 0)
    {
        parent::__construct($id, [
            "nombre" => $nombre,
            "tipo" => $tipo,
            "calle" => $calle,
            "colonia" => $colonia,
            "num_int" => $num_int,
            "num_ext" => $num_ext,
            "municipio" => $municipio,
            "estado" => $estado,
            "cp" => $cp,
            "pais" => $pais,
            "cliente_id" => $cliente_id,
            "proveedor_id" => $proveedor_id
        ], "edificio");
    }
    public function __toString()
    {
        return $this->nombre;
    }
}

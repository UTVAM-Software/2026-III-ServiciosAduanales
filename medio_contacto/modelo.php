<?php
require_once("helpers/basedatos.php");

class MedioContacto extends Modelo
{
    public function __construct($id = 0, $cliente_id = 0, $proveedor_id = 0, $tipo = "", $valor = "")
    {
        parent::__construct($id, [
            "cliente_id" => $cliente_id,
            "proveedor_id" => $proveedor_id,
            "tipo" => $tipo,
            "valor" => $valor
        ], "medio_contacto");
    }
    public function __toString()
    {
        return $this->tipo . ": " . $this->valor;
    }
}

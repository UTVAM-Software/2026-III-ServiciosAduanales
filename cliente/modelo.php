<?php
require_once("helpers/basedatos.php");
require_once("edificio/modelo.php");
require_once("medio_contacto/modelo.php");

class Cliente extends Modelo {
    public function __construct($id=0, $nombre="", $rfc="", $razon_social="") {
        parent::__construct($id, ["nombre" => $nombre, "rfc" => $rfc, "razon_social" => $razon_social], "cliente");
    }
    public function __toString() {
        return $this->nombre;
    }
    public function edificios() {
        $edificio = new Edificio();
        return $edificio->all("cliente_id = $this->id");
    }
    public function medios_contacto() {
        $medio_contacto = new MedioContacto();
        return $medio_contacto->all("cliente_id = $this->id");
    }
}

<?php
require_once("sa.basedatos.php");

class ModeloCliente {
    private $bd;
    private $id;
    private $nombre;
    private $rfc;
    private $razon_social;
    public function __construct() {
        $this->bd = new BD();
        $this->id = 0;
        $this->nombre = "";
        $this->rfc = "";
        $this->razon_social = "";
    }
    public function save() {
        if ($this->id == 0) {
            $this->bd->insertar("cliente", "nombre, rfc, razon_social", "'$this->nombre', '$this->rfc', '$this->razon_social'");
            $res = $this->bd->query("SELECT LAST_INSERT_ID() as id")->fetch_all(MYSQLI_ASSOC);
            $this->id = $res[0]['id'];
        } else {
            $this->bd->modificar("cliente", "nombre='$this->nombre', rfc='$this->rfc', razon_social='$this->razon_social'", "id=$this->id");
        }
    }
    public function delete() {
        if ($this->id != 0) {
            $this->bd->eliminar("cliente", "id=$this->id");
            $this->id = 0;
            $this->nombre = "";
            $this->rfc = "";
            $this->razon_social = "";
        }
    }
}

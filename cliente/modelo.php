<?php
require_once("helpers/basedatos.php");

class Cliente {
    private $bd;
    public $id;
    public $nombre;
    public $rfc;
    public $razon_social;
    public function __construct($id=0, $nombre="", $rfc="", $razon_social="") {
        $this->bd = new BD();
        $this->id = $id;
        $this->nombre = $nombre;
        $this->rfc = $rfc;
        $this->razon_social = $razon_social;
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
    public function get($id) {
        $res = $this->bd->seleccionar("cliente", "*", "id=$id");
        if (count($res) > 0) {
            $this->id = $res[0]['id'];
            $this->nombre = $res[0]['nombre'];
            $this->rfc = $res[0]['rfc'];
            $this->razon_social = $res[0]['razon_social'];
        } else {
            throw new Exception("No se encontro el cliente $id");
        }
    }
    public function all()
    {
        $res = $this->bd->seleccionar("cliente", "*");
        $clientes = [];
        foreach ($res as $row) {
            $clientes[] = new Cliente($row['id'], $row['nombre'], $row['rfc'], $row['razon_social']);
        }
        return $clientes;
    }
}

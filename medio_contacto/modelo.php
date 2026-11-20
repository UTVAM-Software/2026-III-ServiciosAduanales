<?php
require_once("helpers/basedatos.php");

class MedioContacto
{
    private $bd;
    public $id;
    public $cliente_id;
    public $proveedor_id;
    public $tipo;
    public $valor;
    public function __construct($id = 0, $cliente_id = 0, $proveedor_id = 0, $tipo = "", $valor = "")
    {
        $this->bd = new BD();
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->proveedor_id = $proveedor_id;
        $this->tipo = $tipo;
        $this->valor = $valor;
    }
    public function save()
    {
        if ($this->id == 0) {
            $this->bd->insertar("medio_contacto", "cliente_id, proveedor_id, tipo, valor", "'$this->cliente_id', '$this->proveedor_id', '$this->tipo', '$this->valor'");
            $res = $this->bd->query("SELECT LAST_INSERT_ID() as id")->fetch_all(MYSQLI_ASSOC);
            $this->id = $res[0]['id'];
        } else {
            $this->bd->modificar("medio_contacto", "cliente_id=$this->cliente_id, proveedor_id=$this->proveedor_id, tipo='$this->tipo', valor='$this->valor'", "id=$this->id");
        }
    }
    public function delete()
    {
        if ($this->id != 0) {
            $this->bd->eliminar("medio_contacto", "id=$this->id");
            $this->id = 0;
            $this->cliente_id = 0;
            $this->proveedor_id = 0;
            $this->tipo = "";
            $this->valor = "";
        }
    }
    public function get($id)
    {
        $res = $this->bd->seleccionar("medio_contacto", "*", "id=$id");
        if (count($res) > 0) {
            $this->id = $res[0]['id'];
            $this->cliente_id = $res[0]['cliente_id'];
            $this->proveedor_id = $res[0]['proveedor_id'];
            $this->tipo = $res[0]['tipo'];
            $this->valor = $res[0]['valor'];
        } else {
            throw new Exception("No se encontro el cliente $id");
        }
    }
    public function all($filtro = "1 = 1")
    {
        $res = $this->bd->seleccionar("medio_contacto", "*", $filtro);
        $medios_contacto = [];
        foreach ($res as $row) {
            $medios_contacto[] = new MedioContacto($row['id'], $row['cliente_id'], $row['proveedor_id'], $row['tipo'], $row['valor']);
        }
        return $medios_contacto;
    }
    public function __toString()
    {
        return $this->tipo . ": " . $this->valor;
    }
}

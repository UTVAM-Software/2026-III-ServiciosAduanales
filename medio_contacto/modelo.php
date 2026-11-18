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
            $this->bd->eliminar("cliente", "id=$this->id");
            $this->id = 0;
            $this->nombre = "";
            $this->rfc = "";
            $this->razon_social = "";
        }
    }
    public function get($id)
    {
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
    public function __toString()
    {
        return $this->nombre;
    }
}

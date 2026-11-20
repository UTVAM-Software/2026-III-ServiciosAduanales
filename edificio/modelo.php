<?php
require_once("helpers/basedatos.php");

class Edificio
{
    private $bd;
    public $id;
    public $nombre;
    public $tipo;
    public $calle;
    public $colonia;
    public $num_int;
    public $num_ext;
    public $municipio;
    public $estado;
    public $cp;
    public $pais;
    public $cliente_id;
    public $proveedor_id;
    public function __construct($id = 0, $nombre = "", $tipo = "", $calle = "", $colonia = "", $num_int = "", $num_ext = "", $municipio = "", $estado = "", $cp = "", $pais = "", $cliente_id = 0, $proveedor_id = 0)
    {
        $this->bd = new BD();
        $this->id = $id;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->calle = $calle;
        $this->colonia = $colonia;
        $this->num_int = $num_int;
        $this->num_ext = $num_ext;
        $this->municipio = $municipio;
        $this->estado = $estado;
        $this->cp = $cp;
        $this->pais = $pais;
        $this->cliente_id = $cliente_id;
        $this->proveedor_id = $proveedor_id;
    }
    public function save()
    {
        if ($this->id == 0) {
            $this->bd->insertar("edificio", "nombre, tipo, calle, colonia, num_int, num_ext, municipio, estado, cp, pais, cliente_id, proveedor_id", "'$this->nombre', '$this->tipo', '$this->calle', '$this->colonia', '$this->num_int', '$this->num_ext', '$this->municipio', '$this->estado', '$this->cp', '$this->pais', '$this->cliente_id', '$this->proveedor_id'");
            $res = $this->bd->query("SELECT LAST_INSERT_ID() as id")->fetch_all(MYSQLI_ASSOC);
            $this->id = $res[0]['id'];
        } else {
            $this->bd->modificar("edificio", "nombre='$this->nombre', tipo='$this->tipo', calle='$this->calle', colonia='$this->colonia', num_int='$this->num_int', num_ext='$this->num_ext', municipio='$this->municipio', estado='$this->estado', cp='$this->cp', pais='$this->pais', cliente_id='$this->cliente_id', proveedor_id='$this->proveedor_id'", "id=$this->id");
        }
    }
    public function delete()
    {
        if ($this->id != 0) {
            $this->bd->eliminar("edificio", "id=$this->id");
            $this->id = 0;
            $this->nombre = "";
            $this->tipo = "";
            $this->calle = "";
            $this->colonia = "";
            $this->num_int = "";
            $this->num_ext = "";
            $this->municipio = "";
            $this->estado = "";
            $this->cp = "";
            $this->pais = "";
            $this->cliente_id = 0;
            $this->proveedor_id = 0;
        }
    }
    public function get($id)
    {
        $res = $this->bd->seleccionar("edificio", "*", "id=$id");
        if (count($res) > 0) {
            $this->id = $res[0]['id'];
            $this->nombre = $res[0]['nombre'];
            $this->tipo = $res[0]['tipo'];
            $this->calle = $res[0]['calle'];
            $this->colonia = $res[0]['colonia'];
            $this->num_int = $res[0]['num_int'];
            $this->num_ext = $res[0]['num_ext'];
            $this->municipio = $res[0]['municipio'];
            $this->estado = $res[0]['estado'];
            $this->cp = $res[0]['cp'];
            $this->pais = $res[0]['pais'];
            $this->cliente_id = $res[0]['cliente_id'];
            $this->proveedor_id = $res[0]['proveedor_id'];
        } else {
            throw new Exception("No se encontro el edificio $id");
        }
    }
    public function all($filtro = "1 = 1")
    {
        $res = $this->bd->seleccionar("edificio", "*", $filtro);
        $edificios = [];
        foreach ($res as $row) {
            $edificios[] = new Edificio($row['id'], $row['nombre'], $row['tipo'], $row['calle'], $row['colonia'], $row['num_int'], $row['num_ext'], $row['municipio'], $row['estado'], $row['cp'], $row['pais'], $row['cliente_id'], $row['proveedor_id']);
        }
        return $edificios;
    }
    public function __toString()
    {
        return $this->nombre;
    }
}

<?php

class BD
{
    static private $cnn = null;
    public function __construct()
    {
        $this->conectar();
    }
    public function conectar()
    {
        if (self::$cnn == null) {
            try {
                self::$cnn = mysqli_connect('10.5.0.5', "root", "password123", "servicios_aduanales");
            } catch (Exception $e) {
                echo "<br />$e";
            }
        }
        return self::$cnn;
    }
    public function query($query)
    {
        $this->conectar();
        try {
            return self::$cnn->query($query);
        } catch (Exception $e) {
            echo "<br />$e";
            echo "<br />$query";
        }
    }
    public function insertar($tabla, $campos, $valores)
    {
        $this->conectar();
        $query = "
        INSERTO INTO $tabla ($campos) VALUES ($valores);
        ";
        $this->query($query);
    }

    public function seleccionar($tabla, $campos, $filtro = "1=1")
    {
        $this->conectar();
        $query = "
            SELECT $campos FROM $tabla WHERE $filtro;
        ";
        $resultado = $this->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function eliminar($tabla, $filtro = "1=1")
    {
        $this->conectar();
        $query = "
            DELETE FROM $tabla WHERE $filtro;
        ";
        $this->query($query);
    }

    public function modificar($tabla, $campos_valores, $filtro = "1=1")
    {
        $this->conectar();
        $query = "
            UPDATE $tabla SET $campos_valores WHERE $filtro;
        ";
        $this->query($query);
    }

}

abstract class Modelo
{
    protected $bd;
    public $id;

    /**
     * Summary of atributos
     * @var Arreglo asociativo con los atributos del modelo:
     *
     * $this->$atributos["nombre_atributo"] = valor_atributo
     *
     * $this->$atributos["nombre"] = "Ruben";
     * $this->$atributos["apaterno"] = "Ramirez";
     * $this->$atributos["amaterno"] = "Gonzalez";
     * $this->$atributos["edad"] = 30;
     * $this->$atributos["sexo"] = "M";
     */
    protected $atributos;
    protected $tabla;
    public function __construct($id = 0, $attr = [], $tabla = "")
    {
        $this->bd = new BD();
        $this->id = $id;
        $this->set_atributos($attr);
        $this->tabla = $tabla;
    }
    private function set_atributos($attr)
    {
        foreach ($attr as $key => $value) {
            if ($key != "id") {
                $this->atributos[$key] = $value;
            }
        }
    }
    public function save()
    {
        if ($this->id == 0) {
            $this->bd->insertar($this->tabla, implode(', ', array_keys($this->atributos)), "'" . implode("', '", $this->atributos) . "'");
            $res = $this->bd->query("SELECT LAST_INSERT_ID() as id")->fetch_all(MYSQLI_ASSOC);
            $this->id = $res[0]['id'];
        } else {
            $set = [];
            foreach ($this->atributos as $key => $value) {
                $set[] = "$key='$value'";
            }
            $this->bd->modificar($this->tabla, implode(', ', $set), "id=$this->id");
        }
    }
    public function delete()
    {
        if ($this->id != 0) {
            $this->bd->eliminar($this->tabla, "id=$this->id");
            $this->id = 0;
            foreach ($this->atributos as $key => $value) {
                $this->atributos[$key] = "";
            }
        }
    }
    public function get($id)
    {
        $res = $this->bd->seleccionar($this->tabla, "*", "id=$id");
        if (count($res) > 0) {
            $this->id = $res[0]['id'];
            $this->set_atributos($res[0]);
        } else {
            throw new Exception("No se encontro el " . $this->tabla . " $id");
        }
    }
    public function all($filtro = "1 = 1")
    {
        $res = $this->bd->seleccionar($this->tabla, "*", $filtro);
        $objetos = [];
        foreach ($res as $row) {
            $objetos[] = new static(...$row);
        }
        return $objetos;
    }
    public function __get($name)
    {
        if (array_key_exists($name, $this->atributos)) {
            return $this->atributos[$name];
        }
        throw new Exception("Atributo $name no existe en " . $this->tabla);
    }
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->atributos)) {
            $this->atributos[$name] = $value;
        } else {
            throw new Exception("Atributo $name no existe en " . $this->tabla);
        }
    }
    public abstract function __toString();
}

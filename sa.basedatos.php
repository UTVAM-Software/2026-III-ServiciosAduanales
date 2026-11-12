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
        return self::$cnn->query($query);
    }
    public function insertar($tabla, $campos, $valores)
    {
        $this->conectar();
        $query = "
        INSERTO INTO $tabla ($campos) VALUES ($valores);
        ";
        self::$cnn->query($query);
    }

    public function seleccionar($tabla, $campos, $filtro = "1=1")
    {
        $this->conectar();
        $query = "
            SELECT $campos FROM $tabla WHERE $filtro;
        ";
        $resultado = self::$cnn->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function eliminar($tabla, $filtro = "1=1")
    {
        $this->conectar();
        $query = "
            DELETE FROM $tabla WHERE $filtro;
        ";
        self::$cnn->query($query);
    }

    public function modificar($tabla, $campos_valores, $filtro = "1=1")
    {
        $this->conectar();
        $query = "
            UPDATE $tabla SET $campos_valores WHERE $filtro;
        ";
        self::$cnn->query($query);
    }

}

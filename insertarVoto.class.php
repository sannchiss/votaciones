<?php

include_once 'conexion/conexion.php';

class insertarVoto extends conexion
{
    public function __construct()
    {
        parent::__construct();
    }


    public function insertarVoto($query)
    {
        $resultado = parent::insertar($query);
        return $resultado;
    }


    public function obtenerDatosVotos($query)
    {
        $resultado = parent::obtenerDatos($query);

        if ($resultado) {
            return $resultado;
        }

        return $resultado;
    }
        

}
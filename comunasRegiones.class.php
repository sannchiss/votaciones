<?php
require_once 'conexion/conexion.php';

class ComunasRegiones extends conexion
{
    public function __construct()
    {
        parent::__construct();
    }


    public function obtenerRegiones()
    {
        $query = "SELECT region_id, region_nombre FROM regiones";
        $resultado = parent::obtenerDatos($query);
        return $resultado;

    }


    public function obtenerComunas($id_region)    
    {
        $query = "SELECT p.provincia_id, c.comuna_nombre FROM provincias p 
        INNER JOIN comunas c WHERE p.region_id = $id_region AND p.provincia_id = c.provincia_id";
        $resultado = parent::obtenerDatos($query);      
        return $resultado;

    }

}
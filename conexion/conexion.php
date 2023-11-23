<?php

class conexion
{
    private $_SERVER;
    private $_USER;
    private $_PASS;
    private $_DB;

    private $conexion;

    public function __construct() {
        $parametros = $this->datosDeConexion()['conexion'];
        $this->_SERVER = $parametros['server'];
        $this->_USER = $parametros['user'];
        $this->_PASS = $parametros['password'];
        $this->_DB = $parametros['database'];

        $this->conexion = new mysqli($this->_SERVER, $this->_USER, $this->_PASS, $this->_DB);

        if ($this->conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->conexion->connect_errno . ") " . $this->conexion->connect_error;
        }
        
    }

    private function datosDeConexion()
    {
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion .'/' . '/config'); 
        return json_decode($jsondata, true);
        
    }

    private function convertirUTF8($array)
    {
        array_walk_recursive($array, function(&$item, $key){
            if(mb_detect_encoding($item, 'UTF-8', true) !== true){
                $item = utf8_encode($item);
            }
        });
        return $array;
    }


    public function obtenerDatos($query)    {
        $resultado = $this->conexion->query($query);
        if ($resultado) {
            return $this->convertirUTF8($resultado->fetch_all(MYSQLI_ASSOC));
        }
        return $resultado;  

    }

    public function insertar($query)    {
        $resultado = $this->conexion->query($query);
        return $resultado;
    }

}
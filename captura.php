<?php

include_once 'conexion/conexion.php';
include_once 'insertarVoto.class.php';

/**
 * En este archivo se inserta el voto y se valida el rut
 * 
 */


// get data json ajax
 $data = $_POST['data'];

 // convert to string
 $data = json_encode($data);

 // convert to array
 $data = json_decode($data, true);

 $gestion = new insertarVoto();

 $validarRut = array();
$queryValidarRut = "SELECT rut FROM votaciones.registros WHERE rut = '".$data['rut']."'";
$validarRut = $gestion->obtenerDatosVotos($queryValidarRut);


// validate array
 if(!empty($validarRut)) {
     echo json_encode(
         array(
            'mensaje' => 'Rut ya registrado',
            'icono' => 'error')
     );



 } else {

    //query
    $getToday = date('Y-m-d');

    $queryInsertar = "INSERT INTO votaciones.registros (`nombrecompleto`, `alias`, `rut`, `email`, `region`, `comuna`, `candidato`, `nosotros`, `fecharegistro`) 
            VALUES 
            ('" . $data['name'] . "','" . $data['alias'] . "','" . $data['rut'] . "','" . $data['email'] . "','" . $data['region'] . "','" . $data['comuna'] . "','" . $data['candidato'] . "','" . $data['check'] . "', '" . $getToday . "')";

    $resultado = $gestion->insertarVoto($queryInsertar);


    if ($resultado) {
        echo json_encode(
            array(
                'mensaje' => 'Registro exitoso',
                'icono' => 'success'
                
                )
        );
    } else {
        echo json_encode(
            array(
                'mensaje' => 'Error al registrar',
                'icono' => 'error'
                
                )
        );
    }

}

?>
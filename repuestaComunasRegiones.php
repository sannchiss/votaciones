<?php

include_once 'comunasRegiones.class.php';

$comunasRegiones = new ComunasRegiones();

if (!empty($_POST['regionLoad'])) {

    $regiones = $comunasRegiones->obtenerRegiones();

    foreach ($regiones as $region) {
        echo '<option value="' . $region['region_id'] . '">' . $region['region_nombre'] . '</option>';
    }       


}
else

if (!empty($_POST['region'])) {
    $id_region = $_POST['region'];    

    $comunas = $comunasRegiones->obtenerComunas($id_region);

    foreach ($comunas as $comuna) {
        echo '<option value="'.$comuna['comuna_nombre'].'">'.$comuna['comuna_nombre'].'</option>';
    }
    
}
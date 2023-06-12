<?php

require_once '../conectores/dbConnection.php';
require_once '../clases/Seleccion.php';
header('Content-Type: application/json');
$seleccion1 = new Seleccion();
$selecciones=array();
$selecciones=$seleccion1->listarEnJSON();


;
?>
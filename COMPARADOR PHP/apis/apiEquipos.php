<?php

require_once '../conectores/dbConnection.php';
require_once '../clases/Equipo.php';
header('Content-Type: application/json');
$equipo1 = new Equipo();
$equipos=array();
$equipos=$equipo1->listarEnJSON();


?>
<?php

require_once '../conectores/dbConnection.php';
require_once '../clases/Jugador.php';
header('Content-Type: application/json');
$jugador1 = new Jugador();
$jugadores=array();
$jugadores=$jugador1->JugadorHasSeleccionJSON();
?>
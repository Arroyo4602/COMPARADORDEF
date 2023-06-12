<?php
require_once '../conectores/dbConnection.php';
require_once '../clases/Equipo.php';
header('Content-Type: application/json');
$equipoHasLiga1 = new Equipo();
$equipoHasLigas=array();
$equipoHasLigas=$equipoHasLiga1->EquipoHasLigaJSON();

?>
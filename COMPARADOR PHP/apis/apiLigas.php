<?php

require_once '../conectores/dbConnection.php';
require_once '../clases/Liga.php';
header('Content-Type: application/json');
$liga1 = new Liga();
$ligas=array();
$ligas=$liga1->listarEnJSON();

?>
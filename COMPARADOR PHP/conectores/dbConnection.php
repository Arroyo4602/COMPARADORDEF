<?php

class DBCON
{
    public function __construct()
    {

    }

    public function getCon()
    {
        $conexion = mysqli_connect("localhost","root","","fifa");
        if (!$conexion) {
            die("La conexion ha fallado " . mysqli_connect_error());
        }

        return $conexion;
    }

}

?>
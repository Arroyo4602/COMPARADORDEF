<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once "../Jugador.php";
        require_once "../Seleccion.php";
        require_once "../dbConnection.php";
        
        $jugadores=array();
        $jugador=new Jugador();
        $jugadores=$jugador->listar();

        $selecciones=array();
        $seleccion=new Seleccion();
        $selecciones=$seleccion->listar();

    ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
        <select name="jugador">
            <option></option>
            <?php
                foreach ($jugadores as $jugador) {
                    echo "<option>".$jugador->getNombre()."</option>";
                }
            ?>
        </select>
        <select name="seleccion">
            <option></option>
            <?php
                foreach ($selecciones as $seleccion) {
                    echo "<option>".$seleccion->getNombre()."</option>";
                }
            ?>
        </select>
        <input type="submit" value="Asignar">
    </form>

    <?php
        if(isset($_POST) && !empty($_POST)){
            $Jugador=$_POST["jugador"];
            $seleccion=$_POST["seleccion"];

            echo $Jugador;
            echo $seleccion;

            $jugador=new Jugador();
            $jugador->setNombre($Jugador);
            $idplayer=$jugador->IDpeticion();

            $Seleccion=new Seleccion();
            $Seleccion->setNombre($seleccion);
            echo $Seleccion->toString();
            

            $idSeleccion=$Seleccion->cogerID();
            echo $idSeleccion;
            
            $jugador->setIdseleccion($idSeleccion);
            $jugador->setId_jugador($idplayer);

            $jugador->insertarJugadorSeleccion();
        }
    ?>
</body>
</html>
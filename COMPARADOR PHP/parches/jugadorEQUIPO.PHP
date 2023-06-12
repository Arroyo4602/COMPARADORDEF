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
        require_once "../clases/Jugador.php";
        require_once "../clases/Equipo.php";
        require_once "../conectores/dbConnection.php";
        
        $jugadores=array();
        $jugador=new Jugador();
        $jugadores=$jugador->listar();

        $equipos=array();
        $equipo=new Equipo();
        $equipos=$equipo->listar();

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
        <select name="equipo">
            <option></option>
            <?php
                foreach ($equipos as $equipo) {
                    echo "<option>".$equipo->getNombre()."</option>";
                }
            ?>
        </select>
        <input type="submit" value="Asignar">
    </form>

    <?php
        if(isset($_POST) && !empty($_POST)){
            $Jugador=$_POST["jugador"];
            $Equipo=$_POST["equipo"];
            echo $Jugador;
            echo $Equipo;
            $jugador=new Jugador();
            $jugador->setNombre($Jugador);
            $idplayer=$jugador->IDpeticion();
            $equipo=new Equipo();
            $equipo->setNombre($Equipo);
            $idequipo=$equipo->cogerID();
            
            $jugador->setIdequipo($idequipo);
            $jugador->setId_jugador($idplayer);

            $jugador->insertarJugadorEquipo();
        }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario jugador</title>
    <link rel="stylesheet" href="../css/formularioJugador.css">
</head>

<body>

    <form action="formularioJugador.php" method="post" enctype="multipart/form-data">
        <ul>
            <li><label for="nombre">Nombre: </label><input type="text" name="nombre"></li>
            <li><label for="edad">Edad: </label><input type="number" name="edad"></li>
            <li><label for="dorsal">Dorsal: </label><input type="number" name="dorsal"></li>
            <li><label for="posicion">Posicion: </label><input type="text" name="posicion"></li>
            <li><label for="posicion">Goles: </label><input type="number" name="goles"></li>
            <li><label for="posicion">Asistencias: </label><input type="number" name="asistencias"></li>
            <li><label for="posicion">Minutos: </label><input type="number" name="minutos"></li>
            <li><label for="posicion">Valor: </label><input type="number" name="valor"></li>
            <li><label>Equipo: </label>
                <select name="equipo">
                    <?php
                    //Select de equipos 
                    require_once "../conectores/dbConnection.php";
                    require_once "../clases/Equipo.php";
                    //Se crea un array de equipos y se rellena con los equipos de la base de datos
                    $equipos = array();
                    $equipo = new Equipo();
                    $equipos = $equipo->listar();
                    foreach ($equipos as $equipo) {
                        echo "<option value='" . $equipo->getId_equipo() . "'>" . $equipo->getNombre() . "</option>";
                    }

                    ?>
                </select>
            </li>
            <li><label>Seleccion: </label>
                <select name="seleccion">
                    <option value="0">0</option>
                    <?php
                    //Select de selecciones
                    require_once "../conectores/dbConnection.php";
                    require_once "../clases/Seleccion.php";
                    //Se crea un array de selecciones y se rellena con las selecciones de la base de datos
                    $selecciones = array();
                    $seleccion = new Seleccion();
                    $selecciones = $seleccion->listar();
                    foreach ($selecciones as $seleccion) {
                        echo "<option value='" . $seleccion->getId_seleccion() . "'>" . $seleccion->getNombre() . "</option>";
                    }
                    ?>
                </select>
            </li>
            <li><label for="foto">Foto: </label><input type="file" name="foto"></li>
            <li><input type="submit" value="Enviar" id="envio"></li>
        </ul>
    </form>

    <?php
    //Coger los datos del formulario y meterlos en la base de datos
    require_once "../conectores/dbConnection.php";
    require_once "../clases/Jugador.php";
    require_once "../clases/Equipo.php";
    require_once "../clases/Seleccion.php";
    //Se crea un objeto jugador y se le asignan los valores del formulario
    $jugador = new Jugador();
    $jugador->setNombre($_POST["nombre"]);
    $jugador->setEdad($_POST["edad"]);
    $jugador->setDorsal($_POST["dorsal"]);
    $jugador->setPosicion($_POST["posicion"]);
    $jugador->setGoles($_POST["goles"]);
    $jugador->setAsistencias($_POST["asistencias"]);
    $jugador->setMinutos($_POST["minutos"]);
    $jugador->setValor($_POST["valor"]);
    $jugador->setFoto($_FILES["foto"]);
    //Se inserta el jugador en la base de datos
    $jugador->insertar();
    //Despues de insertar el jugador se inserta en la tabla jugador_has_equipo y jugador_has_seleccion
    $jugador->setIdequipo($_POST["equipo"]);
    $jugador->setIdseleccion($_POST["seleccion"]);
    //Se le asigna el id del jugador que se ha insertado en la tabla intermedia
    //reasignandole el id que le ha dado la base de datos
    $jugador->setId_jugador($jugador->IDpeticion());
    //Se inserta en las tablas intermedias
    $jugador->insertarJugadorEquipo();
    $jugador->insertarJugadorSeleccion();
    ?>

</body>

</html>
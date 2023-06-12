<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccion</title>
    <link rel="stylesheet" href="../css/formularioJugador.css">
</head>
<body>
    <form action="formularioSeleccion.php" method="post" enctype="multipart/form-data">
        <ul>
            <li><label for="nombre">Nombre: </label><input type="text" name="nombre"></li>
            <li><label for="foto">Foto: </label><input type="file" name="foto"></li>
            <li><input type="submit" value="Enviar" id="envio"></li>
        </ul>
    </form>

    <?php
        require_once "dbConnection.php";   
        require_once "Seleccion.php";
        $seleccion=new Seleccion();
        $seleccion->setNombre($_POST["nombre"]);
        $seleccion->setFoto($_FILES["foto"]); 
        $seleccion->insertar();
    ?>
</body>
</html>
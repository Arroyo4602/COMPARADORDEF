<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecciones</title>
    <link rel="stylesheet" href="../css/listas.css">
</head>
<body>
    <div id=general>
        <?php
            require 'Seleccion.php';
            require 'dbConnection.php';
            $seleccion=new Seleccion();
            $selecciones[]=$seleccion->listar();
            foreach($selecciones as $seleccion){
                foreach($seleccion as $seleccion){
                    echo "<div>";
                    echo $seleccion->getNombre();
                    echo "</div>";
                    echo "<div>";
                    echo "<img src=img/".$seleccion->getFoto().">";
                    echo "</div>";  
                }
            }
            
        ?>
    </div>
</body>
</html>
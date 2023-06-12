<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/quiz.css">
   
</head>

<body>
    <?php
    require_once 'includes/header.php';
    ?>


    <div>
        <h1 id="pregunta">¿Quién tiene más </h1>
    </div>


    <div >
        <h2 id="puntos1">Puntos: </h2>
        <h2 id="record">HighScore: 0</h2>
    </div>

    <div id="general">
        <a id="jugador1">
            <img src="" id="foto1">
        </a>
        <a id="igual">
            Igual
        </a>
        <a id="jugador2">
            <img id="foto2" src="img/">
        </a>

    </div>
    <script src="scripts/quiz.js"></script>
</body>

</html>
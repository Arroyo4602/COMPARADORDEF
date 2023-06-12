<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparador de competiciones, jugadores...</title>
    <link rel="shortcut icon" href="ImagenesYaInsertadas/logoComparador2.png">
    <link rel="stylesheet" href="css/principal.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <?php
    require_once "conectores/dbConnection.php";
    require_once "clases/Jugador.php";
    require_once "clases/Equipo.php";
    require_once "clases/Liga.php";
    require_once "clases/Seleccion.php";
    $jugadores = array();
    $jugador = new Jugador();
    $jugadores = $jugador->listar();
    $selecciones = array();
    $seleccion = new Seleccion();
    $selecciones = $seleccion->listar();
    $equipos = array();
    $equipo = new Equipo();
    $equipos = $equipo->listar();
    $idEquipo = $jugador->jugadorHasEquipo();
    $idSeleccion = $jugador->jugadorHasSeleccion();
    $nombreEquipo = "";
    $nombreSeleccion = "";
    $equipoURl = 0;
    $ligaURl = 0;
    $seleccionURl = 0;
    $posicionURL=0;
    $idEquipoURL=0;
    $idSeleccionURL=0;


    $opcion=0;

    if (isset($_GET['equipo']) && !empty($_GET['equipo'])) {
        $equipoURl = $_GET['equipo'];
        $equipo=new Equipo();
        $equipo->setNombre($equipoURl);
        $idEquipoURL=$equipo->cogerID();
    }

    if (isset($_GET['liga']) && !empty($_GET['liga'])) {
        $ligaURl = $_GET['liga'];
    }   

    if (isset($_GET['seleccion']) && !empty($_GET['seleccion'])) {
        $seleccionURl = $_GET['seleccion'];
        $sel=new Seleccion();
        $sel->setNombre($seleccionURl);
        $idSeleccionURL=$sel->cogerID();
    }

    if (isset($_GET['posicion']) && !empty($_GET['posicion'])) {
        $posicionURL = $_GET['posicion'];    
    }

    if (isset($_GET['opcion']) && !empty($_GET['opcion'])) {
        $opcion = $_GET['opcion'];
    }
    
    ?>
    <nav>
        <div id="header">
            <ul class="nav">
                <li><a href="">Ligas</a>
                    <ul>
                        <li><a href="">Top 5</a>
                            <ul>
                                <li id="premier"><a href="index.php?liga=4">Premier League</a>
                                    <ul>
                                        <?php
                                        foreach ($equipos as $equipo) {
                                            $idliga = $equipo->cogerIdLiga($equipo->getId_equipo());
                                            if ($idEquipo != $equipo->getId_Equipo() && $idliga == 4) {
                                                $nombreEquipo = $equipo->getNombre();
                                                echo "<li><a href='index.php?equipo=" . $nombreEquipo . "'>" . $nombreEquipo . "</a></li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li id="santander"><a href="index.php?liga=2">Liga Santander</a>
                                    <ul>
                                        <?php
                                        foreach ($equipos as $equipo) {
                                            $idliga = $equipo->cogerIdLiga($equipo->getId_equipo());
                                            if ($idEquipo != $equipo->getId_Equipo() && $idliga == 2) {
                                                $nombreEquipo = $equipo->getNombre();
                                                echo "<li><a href='index.php?equipo=" . $nombreEquipo . "'>" . $nombreEquipo . "</a></li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li id="Serie"><a href="index.php?liga=5">Serie A</a>
                                    <ul>
                                        <?php
                                        foreach ($equipos as $equipo) {
                                            $idliga = $equipo->cogerIdLiga($equipo->getId_equipo());
                                            if ($idEquipo != $equipo->getId_Equipo() && $idliga == 5) {
                                                $nombreEquipo = $equipo->getNombre();
                                                echo "<li><a href='index.php?equipo=" . $nombreEquipo . "'>" . $nombreEquipo . "</a></li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li id="Bundesliga"><a href="index.php?liga=1">Bundesliga</a>
                                    <ul>
                                        <?php
                                        foreach ($equipos as $equipo) {
                                            $idliga = $equipo->cogerIdLiga($equipo->getId_equipo());
                                            if ($idEquipo != $equipo->getId_Equipo() && $idliga == 1) {
                                                $nombreEquipo = $equipo->getNombre();
                                                echo "<li><a href='index.php?equipo=" . $nombreEquipo . "'>" . $nombreEquipo . "</a></li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li id="Ligue"><a href="index.php?liga=3">Ligue 1</a>
                                    <ul>
                                        <?php

                                        foreach ($equipos as $equipo) {
                                            $idliga = $equipo->cogerIdLiga($equipo->getId_equipo());
                                            if ($idEquipo != $equipo->getId_Equipo() && $idliga == 3) {
                                                $nombreEquipo = $equipo->getNombre();
                                                echo "<li><a href='index.php?equipo=" . $nombreEquipo . "'>" . $nombreEquipo . "</a></li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                </li>
            </ul>
            <li><a href="">Nacionalidad</a>
                <ul>
                    <?php
                    foreach ($selecciones as $sele) {
                        if ($idSeleccion != $sele->getId_seleccion()) {
                            $nombreSeleccion = $sele->getNombre();
                            echo "<li><a href='index.php?seleccion=" . $nombreSeleccion . "'>" . $nombreSeleccion . "</a></li>";
                        } else {
                            $nombreSeleccion = "";
                        }
                    }
                    ?>

                </ul>
            </li>
            <li><a href="">Posicion</a>
                <ul>
                    <li><a href="index.php?posicion=Portero">Portero</a></li>
                    <li><a href="index.php?posicion=LI">LI</a></li>
                    <li><a href="index.php?posicion=CAI">CAI</a></li>
                    <li><a href="index.php?posicion=DFC">DFC</a></li>
                    <li><a href="index.php?posicion=LD">LD</a></li>
                    <li><a href="index.php?posicion=CAD">CAD</a></li>
                    <li><a href="index.php?posicion=MCD">MCD</a></li>
                    <li><a href="index.php?posicion=MI">MI</a></li>
                    <li><a href="index.php?posicion=MC">MC</a></li>
                    <li><a href="index.php?posicion=MD">MD</a></li>
                    <li><a href="index.php?posicion=MCO">MCO</a></li>
                    <li><a href="index.php?posicion=SD">SD</a></li>
                    <li><a href="index.php?posicion=EI">EI</a></li>
                    <li><a href="index.php?posicion=DC">DC</a></li>
                    <li><a href="index.php?posicion=ED">ED</a></li>
                </ul>
            </li>
            <li><a href="">Ordenador por</a>
                <ul>
                    <li><a id="opcion1">Goles</a></li>
                    <li><a id="opcion2">Asistencias</a></li>
                    <li><a id="opcion3">Minutos</a></li>
                    <li><a id="opcion4">Valor</a></li>
                </ul>
            </li>
            </ul>
        </div>
    </nav>
    <section>
        <div id="general">
            <?php
            require_once "conectores/dbConnection.php";
            require_once "clases/Jugador.php";
            require_once "clases/Equipo.php";
            require_once "clases/Liga.php";
            require_once "clases/Seleccion.php";
            //Se crea un array de jugadores y se rellena con los jugadores de la base de datos
            $jugadores = array();
            $jugador = new Jugador();
            $jugadores = $jugador->listar();

            //Se crea un array de equipos y se rellena con los equipos de la base de datos
            $selecciones = array();
            $seleccion = new Seleccion();
            $selecciones = $seleccion->listar();

            //Se crea un array de equipos y se rellena con los equipos de la base de datos
            $equipos = array();
            $equipo = new Equipo();
            $equipos = $equipo->listar();
            $ligas = array();
            $liga = new Liga();
            $ligas = $liga->listar();
            //Se recorren el array de los jugadores de la base de datos para mostrar los datos de cada uno
            if ($ligaURl == 0 && $equipoURl == 0 && $seleccionURl == 0 && $posicionURL == 0 && $opcion==0) {
                foreach ($jugadores as $jugador) {

                    //Se guarda el id del equipo y de la seleccion
                    $idEquipo = $jugador->jugadorHasEquipo();
                    $idSeleccion = $jugador->jugadorHasSeleccion();
                    $idequipo = 0;
                    //Se inicialzan las variables que contendran las fotos de los equipos y de las selecciones
                    $fotoEquipo = "";
                    $fotoSeleccion = "";
                    $fotoLiga = "";
                    //Se recorren los arrays de equipos y selecciones para buscar el equipo y la seleccion que coincida con el id del jugador 
                    //y se guarda la foto de ese equipo y de esa seleccion en el caso de que tenga
                    foreach ($selecciones as $seleccion) {
                        if ($idSeleccion == $seleccion->getId_seleccion()) {
                            $fotoSeleccion = $seleccion->getFoto();
                        }
                    }

                    foreach ($equipos as $equipo) {
                        if ($idEquipo == $equipo->getId_Equipo()) {
                            $fotoEquipo = $equipo->getFoto();
                            $idequipo = $equipo->getId_Equipo();
                        }
                    }

                    //Se guarda el id de la liga en una variable y se recorre el array de ligas para buscar la liga que coincida 
                    //con el id del equipo
                    $idliga = $equipo->cogerIdLiga($idequipo);

                    foreach ($ligas as $liga) {
                        if ($idliga == $liga->getId_liga()) {
                            $fotoLiga = $liga->getFoto();
                        }
                    }

                    //Muestra de datos
                    echo "<div id='estadisticas'>";
                    echo "<div id='uno'>Foto</div>";
                    echo "<div id='uno'>Nombre</div>";
                    echo "<div id='uno'>Equipo</div>";
                    echo "<div id='uno'>Nacionalidad</div>";
                    echo "<div id='uno'>Liga</div>";
                    echo "<div id='uno'>Edad</div>";
                    echo "<div id='uno'>Posición</div>";
                    echo "<div id='uno'>Goles</div>";
                    echo "<div id='uno'>Asistencias</div>";
                    echo "<div id='uno'>Minutos</div>";
                    echo "<div id='uno'>Valor</div>";

                    echo "<div id='perfil'><img src='img/" . $jugador->getFoto() . "'></div>";
                    echo "<div id='dos'>" . $jugador->getNombre() . "</div>";
                    echo "<div id='equipo'><img src='img/" . $fotoEquipo . "'></div>";
                    echo "<div id='seleccion'><img src='img/" . $fotoSeleccion . "'></div>";    
                    echo "<div id='liga'><img src='img/" . $fotoLiga . "'></div>";
                    echo "<div id='dos'>" . $jugador->getEdad() . "</div>";
                    echo "<div id='dos'>" . $jugador->getPosicion() . "</div>";
                    echo "<div id='dos'>" . $jugador->getGoles() . "</div>";
                    echo "<div id='dos'>" . $jugador->getAsistencias() . "</div>";
                    echo "<div id='dos'>" . $jugador->getMinutos() . "</div>";
                    echo "<div id='dos'>" . $jugador->getValor() . " Millones</div>";
                    echo "</div>";
                }
            } else if($ligaURl!=0){
                foreach ($jugadores as $jugador) {
                    //Se guarda el id del equipo y de la seleccion
                    $idEquipo = $jugador->jugadorHasEquipo();
                    $idSeleccion = $jugador->jugadorHasSeleccion();
                    $ligamuestra = new Liga();
                    $ligamuestra->setId_liga($ligaURl);
                    $equipo = new Equipo();
                    $equipo->setId_equipo($idEquipo);
                    $ligaJugador = $equipo->cogerIdLiga($idEquipo);
                    if ($ligaURl == $ligaJugador) {


                        $idequipo = 0;
                        //Se inicialzan las variables que contendran las fotos de los equipos y de las selecciones
                        $fotoEquipo = "";
                        $fotoSeleccion = "";
                        $fotoLiga = "";


                        //Se recorren los arrays de equipos y selecciones para buscar el equipo y la seleccion que coincida con el id del jugador 
                        //y se guarda la foto de ese equipo y de esa seleccion en el caso de que tenga
                        foreach ($selecciones as $seleccion) {
                            if ($idSeleccion == $seleccion->getId_seleccion()) {
                                $fotoSeleccion = $seleccion->getFoto();
                            }
                        }

                        foreach ($equipos as $equipo) {
                            if ($idEquipo == $equipo->getId_Equipo()) {
                                $fotoEquipo = $equipo->getFoto();
                                $idequipo = $equipo->getId_Equipo();
                            }
                        }

                        //Se guarda el id de la liga en una variable y se recorre el array de ligas para buscar la liga que coincida 
                        //con el id del equipo
                        $idliga = $equipo->cogerIdLiga($idequipo);

                        foreach ($ligas as $liga) {
                            if ($idliga == $liga->getId_liga()) {
                                $fotoLiga = $liga->getFoto();
                            }
                        }

                        //Muestra de datos
                        echo "<div id='estadisticas'>";
                        echo "<div id='uno'>Foto</div>";
                        echo "<div id='uno'>Nombre</div>";
                        echo "<div id='uno'>Equipo</div>";
                        echo "<div id='uno'>Nacionalidad</div>";
                        echo "<div id='uno'>Liga</div>";
                        echo "<div id='uno'>Edad</div>";
                        echo "<div id='uno'>Posición</div>";
                        echo "<div id='uno'>Goles</div>";
                        echo "<div id='uno'>Asistencias</div>";
                        echo "<div id='uno'>Minutos</div>";
                        echo "<div id='uno'>Valor</div>";

                        echo "<div id='perfil'><img src='img/" . $jugador->getFoto() . "'></div>";
                        echo "<div id='dos'>" . $jugador->getNombre() . "</div>";
                        echo "<div id='equipo'><img src='img/" . $fotoEquipo . "'></div>";
                        echo "<div id='seleccion'><img src='img/" . $fotoSeleccion . "'></div>";
                        echo "<div id='liga'><img src='img/" . $fotoLiga . "'></div>";
                        echo "<div id='dos'>" . $jugador->getEdad() . "</div>";
                        echo "<div id='dos'>" . $jugador->getPosicion() . "</div>";
                        echo "<div id='dos'>" . $jugador->getGoles() . "</div>";
                        echo "<div id='dos'>" . $jugador->getAsistencias() . "</div>";
                        echo "<div id='dos'>" . $jugador->getMinutos() . "</div>";
                        echo "<div id='dos'>" . $jugador->getValor() . " Millones</div>";
                        echo "</div>";
                    }
                }
            }else if($idEquipoURL!=0){
                foreach ($jugadores as $jugador) {
                    //Se guarda el id del equipo y de la seleccion
                    $idEquipo = $jugador->jugadorHasEquipo();
                    $idSeleccion = $jugador->jugadorHasSeleccion();
                    
                    

                    $equipo = new Equipo();
                    $equipo->setId_equipo($idEquipo);
                    $ligaJugador = $equipo->cogerIdLiga($idEquipo);

                    if ($idEquipoURL == $idEquipo) {


                        $idequipo = 0;
                        //Se inicialzan las variables que contendran las fotos de los equipos y de las selecciones
                        $fotoEquipo = "";
                        $fotoSeleccion = "";
                        $fotoLiga = "";


                        //Se recorren los arrays de equipos y selecciones para buscar el equipo y la seleccion que coincida con el id del jugador 
                        //y se guarda la foto de ese equipo y de esa seleccion en el caso de que tenga
                        foreach ($selecciones as $seleccion) {
                            if ($idSeleccion == $seleccion->getId_seleccion()) {
                                $fotoSeleccion = $seleccion->getFoto();
                            }
                        }

                        foreach ($equipos as $equipo) {
                            if ($idEquipo == $equipo->getId_Equipo()) {
                                $fotoEquipo = $equipo->getFoto();
                                $idequipo = $equipo->getId_Equipo();
                            }
                        }

                        //Se guarda el id de la liga en una variable y se recorre el array de ligas para buscar la liga que coincida 
                        //con el id del equipo
                        $idliga = $equipo->cogerIdLiga($idequipo);

                        foreach ($ligas as $liga) {
                            if ($idliga == $liga->getId_liga()) {
                                $fotoLiga = $liga->getFoto();
                            }
                        }

                        //Muestra de datos
                        echo "<div id='estadisticas'>";
                        echo "<div id='uno'>Foto</div>";
                        echo "<div id='uno'>Nombre</div>";
                        echo "<div id='uno'>Equipo</div>";
                        echo "<div id='uno'>Nacionalidad</div>";
                        echo "<div id='uno'>Liga</div>";
                        echo "<div id='uno'>Edad</div>";
                        echo "<div id='uno'>Posición</div>";
                        echo "<div id='uno'>Goles</div>";
                        echo "<div id='uno'>Asistencias</div>";
                        echo "<div id='uno'>Minutos</div>";
                        echo "<div id='uno'>Valor</div>";

                        echo "<div id='perfil'><img src='img/" . $jugador->getFoto() . "'></div>";
                        echo "<div id='dos'>" . $jugador->getNombre() . "</div>";
                        echo "<div id='equipo'><img src='img/" . $fotoEquipo . "'></div>";
                        echo "<div id='seleccion'><img src='img/" . $fotoSeleccion . "'></div>";
                        echo "<div id='liga'><img src='img/" . $fotoLiga . "'></div>";
                        echo "<div id='dos'>" . $jugador->getEdad() . "</div>";
                        echo "<div id='dos'>" . $jugador->getPosicion() . "</div>";
                        echo "<div id='dos'>" . $jugador->getGoles() . "</div>";
                        echo "<div id='dos'>" . $jugador->getAsistencias() . "</div>";
                        echo "<div id='dos'>" . $jugador->getMinutos() . "</div>";
                        echo "<div id='dos'>" . $jugador->getValor() . " Millones</div>";
                        echo "</div>";
                    }
                }
            }else if($idSeleccionURL!=0){
                foreach ($jugadores as $jugador) {
                    //Se guarda el id del equipo y de la seleccion
                    $idEquipo = $jugador->jugadorHasEquipo();
                    $idSeleccion = $jugador->jugadorHasSeleccion();
                    
                    

                    $equipo = new Equipo();
                    $equipo->setId_equipo($idEquipo);
                    $ligaJugador = $equipo->cogerIdLiga($idEquipo);

                    if ($idSeleccionURL == $idSeleccion) {
                        $idequipo = 0;
                        //Se inicialzan las variables que contendran las fotos de los equipos y de las selecciones
                        $fotoEquipo = "";
                        $fotoSeleccion = "";
                        $fotoLiga = "";


                        //Se recorren los arrays de equipos y selecciones para buscar el equipo y la seleccion que coincida con el id del jugador 
                        //y se guarda la foto de ese equipo y de esa seleccion en el caso de que tenga
                        foreach ($selecciones as $seleccion) {
                            if ($idSeleccion == $seleccion->getId_seleccion()) {
                                $fotoSeleccion = $seleccion->getFoto();
                            }
                        }

                        foreach ($equipos as $equipo) {
                            if ($idEquipo == $equipo->getId_Equipo()) {
                                $fotoEquipo = $equipo->getFoto();
                                $idequipo = $equipo->getId_Equipo();
                            }
                        }

                        //Se guarda el id de la liga en una variable y se recorre el array de ligas para buscar la liga que coincida 
                        //con el id del equipo
                        $idliga = $equipo->cogerIdLiga($idequipo);

                        foreach ($ligas as $liga) {
                            if ($idliga == $liga->getId_liga()) {
                                $fotoLiga = $liga->getFoto();
                            }
                        }

                        //Muestra de datos
                        echo "<div id='estadisticas'>";
                        echo "<div id='uno'>Foto</div>";
                        echo "<div id='uno'>Nombre</div>";
                        echo "<div id='uno'>Equipo</div>";
                        echo "<div id='uno'>Nacionalidad</div>";
                        echo "<div id='uno'>Liga</div>";
                        echo "<div id='uno'>Edad</div>";
                        echo "<div id='uno'>Posición</div>";
                        echo "<div id='uno'>Goles</div>";
                        echo "<div id='uno'>Asistencias</div>";
                        echo "<div id='uno'>Minutos</div>";
                        echo "<div id='uno'>Valor</div>";

                        echo "<div id='perfil'><img src='img/" . $jugador->getFoto() . "'></div>";
                        echo "<div id='dos'>" . $jugador->getNombre() . "</div>";
                        echo "<div id='equipo'><img src='img/" . $fotoEquipo . "'></div>";
                        echo "<div id='seleccion'><img src='img/" . $fotoSeleccion . "'></div>";
                        echo "<div id='liga'><img src='img/" . $fotoLiga . "'></div>";
                        echo "<div id='dos'>" . $jugador->getEdad() . "</div>";
                        echo "<div id='dos'>" . $jugador->getPosicion() . "</div>";
                        echo "<div id='dos'>" . $jugador->getGoles() . "</div>";
                        echo "<div id='dos'>" . $jugador->getAsistencias() . "</div>";
                        echo "<div id='dos'>" . $jugador->getMinutos() . "</div>";
                        echo "<div id='dos'>" . $jugador->getValor() . " Millones</div>";
                        echo "</div>";
                    }
                }

            }else if($posicionURL!=0){
                foreach ($jugadores as $jugador) {
                    //Se guarda el id del equipo y de la seleccion
                    $idEquipo = $jugador->jugadorHasEquipo();
                    $idSeleccion = $jugador->jugadorHasSeleccion();
                    
                    $equipo = new Equipo();
                    $equipo->setId_equipo($idEquipo);
                    $ligaJugador = $equipo->cogerIdLiga($idEquipo);
                  

                    if ($posicionURL == $jugador->getPosicion()) {
                        $idequipo = 0;
                        //Se inicialzan las variables que contendran las fotos de los equipos y de las selecciones
                        $fotoEquipo = "";
                        $fotoSeleccion = "";
                        $fotoLiga = "";
                        foreach ($selecciones as $seleccion) {
                            if ($idSeleccion == $seleccion->getId_seleccion()) {
                                $fotoSeleccion = $seleccion->getFoto();
                            }
                        }

                        foreach ($equipos as $equipo) {
                            if ($idEquipo == $equipo->getId_Equipo()) {
                                $fotoEquipo = $equipo->getFoto();
                                $idequipo = $equipo->getId_Equipo();
                            }
                        }

                        //Se guarda el id de la liga en una variable y se recorre el array de ligas para buscar la liga que coincida 
                        //con el id del equipo
                        $idliga = $equipo->cogerIdLiga($idequipo);

                        foreach ($ligas as $liga) {
                            if ($idliga == $liga->getId_liga()) {
                                $fotoLiga = $liga->getFoto();
                            }
                        }

                        //Muestra de datos
                        echo "<div id='estadisticas'>";
                        echo "<div id='uno'>Foto</div>";
                        echo "<div id='uno'>Nombre</div>";
                        echo "<div id='uno'>Equipo</div>";
                        echo "<div id='uno'>Nacionalidad</div>";
                        echo "<div id='uno'>Liga</div>";
                        echo "<div id='uno'>Edad</div>";
                        echo "<div id='uno'>Posición</div>";
                        echo "<div id='uno'>Goles</div>";
                        echo "<div id='uno'>Asistencias</div>";
                        echo "<div id='uno'>Minutos</div>";
                        echo "<div id='uno'>Valor</div>";

                        echo "<div id='perfil'><img src='img/" . $jugador->getFoto() . "'></div>";
                        echo "<div id='dos'>" . $jugador->getNombre() . "</div>";
                        echo "<div id='equipo'><img src='img/" . $fotoEquipo . "'></div>";
                        echo "<div id='seleccion'><img src='img/" . $fotoSeleccion . "'></div>";
                        echo "<div id='liga'><img src='img/" . $fotoLiga . "'></div>";
                        echo "<div id='dos'>" . $jugador->getEdad() . "</div>";
                        echo "<div id='dos'>" . $jugador->getPosicion() . "</div>";
                        echo "<div id='dos'>" . $jugador->getGoles() . "</div>";
                        echo "<div id='dos'>" . $jugador->getAsistencias() . "</div>";
                        echo "<div id='dos'>" . $jugador->getMinutos() . "</div>";
                        echo "<div id='dos'>" . $jugador->getValor() . " Millones</div>";
                        echo "</div>";
                    }
                }

            }
                
            ?>
        </div>
    </section>
    <!-- <?php include 'includes/footer.php'; ?>-->
    <script src="scripts/index.js"></script>
</body>

</html>
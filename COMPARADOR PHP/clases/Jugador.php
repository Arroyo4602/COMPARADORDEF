<?php
//Clase para los Jugadores
class Jugador{
   //Atributos
    private $id_jugador;
    private $nombre;
    private $edad;
    private $foto;
    private $dorsal;
    private $posicion;
    private $goles;
    private $asistencias;
    private $minutos;
    private $valor;
    private $idequipo;
    private $idseleccion;
    
    //Constructor vacío
    public function __construct(){
        
    }
      
    //Constructor con ID
    public function JugadorID($id_jugador,$nombre,$edad,$foto,$dorsal,$posicion,$goles,$asistencias,$minutos,$valor,$idequipo,$idseleccion){
        $this->id_jugador=$id_jugador;
        $this->nombre=$nombre;
        $this->edad=$edad;
        $this->foto=$foto;
        $this->dorsal=$dorsal;
        $this->posicion=$posicion;
        $this->goles=$goles;
        $this->asistencias=$asistencias;
        $this->minutos=$minutos;
        $this->valor=$valor;
        $this->idequipo=$idequipo;
        $this->idseleccion=$idseleccion;
    }
    
      
    //Constructor sin ID
    public function Jugador($nombre,$edad,$foto,$dorsal,$posicion,$goles,$asistencias,$minutos,$valor,$idequipo,$idseleccion){
        $this->nombre=$nombre;
        $this->edad=$edad;
        $this->foto=$foto;
        $this->dorsal=$dorsal;
        $this->posicion=$posicion;
        $this->goles=$goles;
        $this->asistencias=$asistencias;
        $this->minutos=$minutos;
        $this->valor=$valor;
        $this->idequipo=$idequipo;
        $this->idseleccion=$idseleccion;
    }
    
   

    //metodos get y set
    public function getId_jugador(){
        return $this->id_jugador;
    }
    public function setId_jugador($id_jugador){
        $this->id_jugador=$id_jugador;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function getEdad(){
        return $this->edad;
    }
    public function setEdad($edad){
        $this->edad=$edad;
    }
    public function getFoto(){
        return $this->foto;
    }
    public function setFoto($foto){
        $this->foto=$foto;
    }
    public function getDorsal(){
        return $this->dorsal;
    }
    public function setDorsal($dorsal){
        $this->dorsal=$dorsal;
    }
    public function getPosicion(){
        return $this->posicion;
    }
    public function setPosicion($posicion){
        $this->posicion=$posicion;
    }
    
    public function getGoles(){
        return $this->goles;
    }
    public function setGoles($goles){
        $this->goles=$goles;
    }
    public function getAsistencias(){
        return $this->asistencias;
    }
    public function setAsistencias($asistencias){
        $this->asistencias=$asistencias;
    }
    public function getMinutos(){
        return $this->minutos;
    }
    public function setMinutos($minutos){
        $this->minutos=$minutos;
    }
    public function getValor(){
        return $this->valor;
    }
    public function setValor($valor){
        $this->valor=$valor;
    }
    public function getIdequipo(){
        return $this->idequipo;
    }
    public function setIdequipo($idequipo){
        $this->idequipo=$idequipo;
    }
    public function getIdseleccion(){
        return $this->idseleccion;
    }
    public function setIdseleccion($idseleccion){
        $this->idseleccion=$idseleccion;
    }


    //metodo toString
    public function toString(){
        return "Id_jugador: " . $this->id_jugador . 
            " Nombre: " . $this->nombre . 
            " Edad: " . $this->edad . 
            " Foto: " . $this->foto . 
            " Dorsal: " . $this->dorsal . 
            " Posicion: " . $this->posicion .
            " Goles: " . $this->goles .
            " Asistencias: " . $this->asistencias .
            " Minutos: " . $this->minutos .
            " Valor: " . $this->valor;

            
    }

    //Funcion para guardar la foto en la carpeta imagenes del servidor
    public function guardarFoto(){
       //Asignacion por variables el nombre de la foto, el tipo,la ruta temporal, y el destino
        $nombreFoto=$this->foto["name"];
        $tipoFoto=$this->foto["type"];
        $rutaFoto=$this->foto["tmp_name"];
        $destino="img/".$nombreFoto;
        //Utilización de la función move_uploaded_file para mover la foto de su ubicación temporal a su ubicación final
        move_uploaded_file($rutaFoto,$destino);
        //Si la operación es exitosa, la función imprime "Foto guardada correctamente", de lo contrario, imprime "La foto no se ha podido guardar"
        if(file_exists($destino)){
            echo "Foto guardada correctamente";
        }else{
            echo "La foto no se ha podido guardar";
        }
       
    }

    public function listarEnJSON(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM jugador";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta");
        }
        mysqli_stmt_execute($stmt);
        $resultado=mysqli_stmt_get_result($stmt);
        $jugadores=array();
        while($fila=mysqli_fetch_assoc($resultado)){
            $jugadores[]=$fila;
        }
        echo json_encode($jugadores);
        return $jugadores;
    }
   
    public function insertar(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión a la base de datos
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $DB=new DBCON();
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para insertar un registro en la tabla "jugador", con los valores a insertar
        $sql="INSERT INTO jugador (nombre,edad,foto,dorsal,posicion,goles,asistencias,minutos,valor) VALUES (?,?,?,?,?,?,?,?,?)";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se utiliza la función "mysqli_stmt_bind_param" para vincular los valores que se van a insertar en la consulta preparada. 
        //El primer argumento es el objeto de la consulta preparada, el segundo es una cadena que indica el tipo de datos que se van a insertar 
        // y los siguientes argumentos son las variables que contienen los valores a insertar
        mysqli_stmt_bind_param($stmt, "sssssssss",$this->nombre,$this->edad,$this->foto['name'],$this->dorsal,$this->posicion,$this->goles,$this->asistencias,$this->minutos,$this->valor);
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        //Si la ejecución de la consulta es exitosa, se llama a la función "guardarFoto" para guardar la foto en el servidor y
        //se imprime un mensaje indicando que ha sido insertado correctamente. Si la ejecución de la consulta falla, se imprime un mensaje de error
        if(mysqli_stmt_execute($stmt)){
            $this->guardarFoto();
            echo "Jugador insertado correctamente";
        }else{
            echo "Error al insertar el jugador: " . mysqli_stmt_error($stmt);
        }
       //Finalmente, se cierra la consulta preparada y la conexión a la base de datos
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }

    //Función para consultar una base de datos MySQL y devolver un array de objetos de la clase "Jugador".
    public function listar(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión 
        //a la base de datos, se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $DB=new DBCON();
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para recoger todos los registro de la tabla "jugador"
        $sql="SELECT * FROM jugador";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado=mysqli_stmt_get_result($stmt);
        //Se inicializa un array vacío llamado "$jugadores" y se itera sobre cada fila del resultado usando un bucle "while"
        $jugadores=array();
        while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            //Se crea un objeto "Jugador" para cada fila y se establecen sus propiedades a partir de los valores
            //de la fila. El objeto "Jugador" se agrega al array "$jugadores".
            $jugador=new Jugador();
            $jugador->setId_jugador($fila['id_jugador']);
            $jugador->setNombre($fila['nombre']);
            $jugador->setEdad($fila['edad']);
            $jugador->setFoto($fila['foto']);
            $jugador->setDorsal($fila['dorsal']);
            $jugador->setPosicion($fila['posicion']);
            $jugador->setGoles($fila['goles']);
            $jugador->setAsistencias($fila['asistencias']);
            $jugador->setMinutos($fila['minutos']);
            $jugador->setValor($fila['valor']);
            $jugadores[]=$jugador;
        }
        //Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos. 
        //El array "$jugadores" se devuelve como resultado de la función.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        return $jugadores;
    }
    public function JugadorHasSeleccionJSON(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM jugador_has_seleccion";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta");
        }
        mysqli_stmt_execute($stmt);
        $resultado=mysqli_stmt_get_result($stmt);
        $jugadores=array();
        while($fila=mysqli_fetch_assoc($resultado)){
            $jugadores[]=$fila;
        }
        echo json_encode($jugadores);
        return $jugadores;
    }

    public function JugadorHasEquipoJSON(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM jugador_has_equipo";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta");
        }
        mysqli_stmt_execute($stmt);
        $resultado=mysqli_stmt_get_result($stmt);
        $jugadores=array();
        while($fila=mysqli_fetch_assoc($resultado)){
            $jugadores[]=$fila;
        }
        echo json_encode($jugadores);
        return $jugadores;
    }

    public function listarPorGoles(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM jugador order by goles desc";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado=mysqli_stmt_get_result($stmt);
        //Se inicializa un array vacío llamado "$jugadores" y se itera sobre cada fila del resultado usando un bucle "while"
        $jugadores=array();
        while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            //Se crea un objeto "Jugador" para cada fila y se establecen sus propiedades a partir de los valores
            //de la fila. El objeto "Jugador" se agrega al array "$jugadores".
            $jugador=new Jugador();
            $jugador->setId_jugador($fila['id_jugador']);
            $jugador->setNombre($fila['nombre']);
            $jugador->setEdad($fila['edad']);
            $jugador->setFoto($fila['foto']);
            $jugador->setDorsal($fila['dorsal']);
            $jugador->setPosicion($fila['posicion']);
            $jugador->setGoles($fila['goles']);
            $jugador->setAsistencias($fila['asistencias']);
            $jugador->setMinutos($fila['minutos']);
            $jugador->setValor($fila['valor']);
            $jugadores[]=$jugador;
        }
        //Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos. 
        //El array "$jugadores" se devuelve como resultado de la función.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        return $jugadores;
    }

    public function listarPorAsistencias(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM jugador order by asistencias desc";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado=mysqli_stmt_get_result($stmt);
        //Se inicializa un array vacío llamado "$jugadores" y se itera sobre cada fila del resultado usando un bucle "while"
        $jugadores=array();
        while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            //Se crea un objeto "Jugador" para cada fila y se establecen sus propiedades a partir de los valores
            //de la fila. El objeto "Jugador" se agrega al array "$jugadores".
            $jugador=new Jugador();
            $jugador->setId_jugador($fila['id_jugador']);
            $jugador->setNombre($fila['nombre']);
            $jugador->setEdad($fila['edad']);
            $jugador->setFoto($fila['foto']);
            $jugador->setDorsal($fila['dorsal']);
            $jugador->setPosicion($fila['posicion']);
            $jugador->setGoles($fila['goles']);
            $jugador->setAsistencias($fila['asistencias']);
            $jugador->setMinutos($fila['minutos']);
            $jugador->setValor($fila['valor']);
            $jugadores[]=$jugador;
        }
        //Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos. 
        //El array "$jugadores" se devuelve como resultado de la función.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        return $jugadores;
    }

    public function ordenarPorMinutos(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM jugador order by minutos desc";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado=mysqli_stmt_get_result($stmt);
        //Se inicializa un array vacío llamado "$jugadores" y se itera sobre cada fila del resultado usando un bucle "while"
        $jugadores=array();
        while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            //Se crea un objeto "Jugador" para cada fila y se establecen sus propiedades a partir de los valores
            //de la fila. El objeto "Jugador" se agrega al array "$jugadores".
            $jugador=new Jugador();
            $jugador->setId_jugador($fila['id_jugador']);
            $jugador->setNombre($fila['nombre']);
            $jugador->setEdad($fila['edad']);
            $jugador->setFoto($fila['foto']);
            $jugador->setDorsal($fila['dorsal']);
            $jugador->setPosicion($fila['posicion']);
            $jugador->setGoles($fila['goles']);
            $jugador->setAsistencias($fila['asistencias']);
            $jugador->setMinutos($fila['minutos']);
            $jugador->setValor($fila['valor']);
            $jugadores[]=$jugador;
        }
        //Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos. 
        //El array "$jugadores" se devuelve como resultado de la función.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        return $jugadores;
    }

    public function ordenarPorValor(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM jugador order by valor desc";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado=mysqli_stmt_get_result($stmt);
        //Se inicializa un array vacío llamado "$jugadores" y se itera sobre cada fila del resultado usando un bucle "while"
        $jugadores=array();
        while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            //Se crea un objeto "Jugador" para cada fila y se establecen sus propiedades a partir de los valores
            //de la fila. El objeto "Jugador" se agrega al array "$jugadores".
            $jugador=new Jugador();
            $jugador->setId_jugador($fila['id_jugador']);
            $jugador->setNombre($fila['nombre']);
            $jugador->setEdad($fila['edad']);
            $jugador->setFoto($fila['foto']);
            $jugador->setDorsal($fila['dorsal']);
            $jugador->setPosicion($fila['posicion']);
            $jugador->setGoles($fila['goles']);
            $jugador->setAsistencias($fila['asistencias']);
            $jugador->setMinutos($fila['minutos']);
            $jugador->setValor($fila['valor']);
            $jugadores[]=$jugador;
        }
        //Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos. 
        //El array "$jugadores" se devuelve como resultado de la función.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        return $jugadores;
    }

    public function insertarJugadorEquipo(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión a la base de datos
        $DB=new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para insertar un registro en la tabla "jugador_has_equipo", con los valores a insertar
        $sql="INSERT INTO jugador_has_equipo (id_jugador,id_equipo) VALUES (?,?)";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt=mysqli_prepare($conexion,$sql);
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se utiliza la función "mysqli_stmt_bind_param" para vincular los valores que se van a insertar en la consulta preparada.
        mysqli_stmt_bind_param($stmt, "ii",$this->id_jugador,$this->idequipo);
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        if(mysqli_stmt_execute($stmt)){
            echo "Jugador insertado correctamente";
        }else{
            echo "Error al insertar el jugador: " . mysqli_stmt_error($stmt);
        }
        //Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }

    //Metodo para insertar el idjugador asociado a su seleccion en la tabla jugador_has_seleccion
    public function insertarJugadorSeleccion(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión a la base de datos
        $DB=new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para insertar un registro en la tabla "jugador_has_seleccion", con los valores a insertar
        $sql="INSERT INTO jugador_has_seleccion (id_jugador,id_seleccion) VALUES (?,?)";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt=mysqli_prepare($conexion,$sql);
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se utiliza la función "mysqli_stmt_bind_param" para vincular los valores que se van a insertar en la consulta preparada.
        mysqli_stmt_bind_param($stmt, "ii",$this->id_jugador,$this->idseleccion);
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        if(mysqli_stmt_execute($stmt)){
            echo "Jugador insertado correctamente";
        }else{
            echo "Error al insertar el jugador: " . mysqli_stmt_error($stmt);
        }
        //Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

    }

    //Metodo para coger el id del jugador que se ha insertado en la tabla jugador 
    public function IDpeticion(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja 
        //la conexión a la base de datos
        $DB=new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para recoger un registro de la tabla "jugador"
        $sql="SELECT * FROM jugador WHERE nombre='$this->nombre'";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado=mysqli_stmt_get_result($stmt);
        //Se guardan los resultados en un array asociativo llamado "$fila" 
        $fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC);
        //Se devuelve el id del jugador
        return $fila['id_jugador'];
    }
    
    //Metodo para coger el id de la seleccion de un Jugador
    public function jugadorHasSeleccion(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja
        //la conexión a la base de datos
        $DB=new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para recoger un registro de la tabla "jugador_has_seleccion"
        $sql="SELECT * FROM jugador_has_seleccion WHERE id_jugador='$this->id_jugador'";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado=mysqli_stmt_get_result($stmt);
        //Se guardan los resultados en un array asociativo llamado "$fila"
        $fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC);
        //Se devuelve el id de la seleccion si existe, si no devuelve 0
        if(isset($fila['id_seleccion'])){
            return $fila['id_seleccion'];
        }else{
            return 0;
        }
    }
    
    //Metodo para coger el id del equipo de un Jugador
    public function jugadorHasEquipo(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja
        //la conexión a la base de datos
        $DB=new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para recoger un registro de la tabla "jugador_has_equipo"
        $sql="SELECT * FROM jugador_has_equipo WHERE id_jugador='$this->id_jugador'";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado=mysqli_stmt_get_result($stmt);
        //Se guardan los resultados en un array asociativo llamado "$fila"
        $fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC);
        //Se devuelve el id del equipo si existe, si no devuelve 0
        if(isset($fila['id_equipo'])){
            return $fila['id_equipo'];
        }else{
            return 0;
        }
        
    }

    public function cargarJugador(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para recoger todos los registro de la tabla "jugador"
        $sql="SELECT * FROM jugador where id_jugador='$this->id_jugador'";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        mysqli_stmt_execute($stmt);
        //Se devuelve el jugador 
        $resultado=mysqli_stmt_get_result($stmt);
        $fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC);
        $aux=new Jugador();
        $aux->id_jugador=$fila['id_jugador'];
        $aux->nombre=$fila['nombre'];
        $aux->edad=$fila['edad'];
        $aux->foto=$fila['foto'];
        $aux->dorsal=$fila['dorsal'];
        $aux->posicion=$fila['posicion'];
        $aux->goles=$fila['goles'];
        $aux->asistencias=$fila['asistencias'];
        $aux->minutos=$fila['minutos'];
        $aux->valor=$fila['valor'];
       
        return $aux;
       
    }
}
?>
<?php
//Clase para los Equipos 
class Equipo
{
    //Atributos
    private $id_equipo;
    private $nombre;
    private $foto;


    //Constructor vacío
    public function __construct()
    {
    }
    //Constructor con ID
    public function IDEquipo($id_equipo, $nombre, $foto)
    {
        $this->id_equipo = $id_equipo;
        $this->nombre = $nombre;
        $this->foto = $foto;
    }

    //Constructor sin ID
    public function Equipo($nombre, $foto)
    {
        $this->nombre = $nombre;
        $this->foto = $foto;
    }



    //metodos get y set
    public function getId_equipo()
    {
        return $this->id_equipo;
    }
    public function setId_equipo($id_equipo)
    {
        $this->id_equipo = $id_equipo;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getFoto()
    {
        return $this->foto;
    }
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }


    //metodo toString
    public function __toString()
    {
        return "Id equipo: " . $this->id_equipo . " Nombre: " . $this->nombre . " Foto: " . $this->foto;
    }

    //Funcion para guardar la foto en la carpeta imagenes del servidor
    public function guardarFoto()
    {

        //Asignacion por variables el nombre de la foto, el tipo,la ruta temporal, y el destino
        $nombreFoto = $this->foto["name"];
        $tipoFoto = $this->foto["type"];
        $rutaFoto = $this->foto["tmp_name"];
        $destino = "img/" . $nombreFoto;
        //Utilización de la función move_uploaded_file para mover la foto de su ubicación temporal a su ubicación final
        move_uploaded_file($rutaFoto, $destino);
        //Si la operación es exitosa, la función imprime "Foto guardada correctamente", de lo contrario, imprime "La foto no se ha podido guardar"
        if (file_exists($destino)) {
            echo "Foto guardada correctamente";
        } else {
            echo "La foto no se ha podido guardar";
        }
    }


    public function insertar()
    {
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión a la base de datos
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $DB = new DBCON();
        $conexion = $DB->getCon();
        //Se prepara una consulta SQL para insertar un registro en la tabla "equipo", con dos valores a insertar: el nombre y la foto del equipo
        $sql = "INSERT INTO equipo (nombre,foto) VALUES (?,?)";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        $stmt = mysqli_prepare($conexion, $sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se utiliza la función "mysqli_stmt_bind_param" para vincular los valores que se van a insertar en la consulta preparada. 
        //El primer argumento es el objeto de la consulta preparada, el segundo es una cadena que indica el tipo de datos que se van a insertar 
        //(en este caso, dos cadenas de texto), y los siguientes argumentos son las variables que contienen los valores a insertar
        mysqli_stmt_bind_param($stmt, "ss", $this->nombre, $this->foto['name']);
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        //Si la ejecución de la consulta es exitosa, se llama a la función "guardarFoto" para guardar la foto del equipo en el servidor y
        //se imprime un mensaje indicando que el equipo ha sido insertado correctamente. Si la ejecución de la consulta falla, se imprime un mensaje de error
        if (mysqli_stmt_execute($stmt)) {
            $this->guardarFoto();
            echo "Equipo insertado correctamente";
        } else {
            echo "Error al insertar el equipo: " . mysqli_stmt_error($stmt);
        }
        //Finalmente, se cierra la consulta preparada y la conexión a la base de datos
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }

    //Función para consultar una base de datos MySQL y devolver un array de objetos de la clase "Jugador".
    public function listar()
    {
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión a la base de datos
        $DB = new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion = $DB->getCon();
        //Se prepara una consulta SQL para seleccionar todos los registros de la tabla "equipo"
        $sql = "SELECT * FROM equipo";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt = mysqli_prepare($conexion, $sql);
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        if (!$stmt) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        mysqli_stmt_execute($stmt);
        //Se obtiene el resultado de la consulta con la función "mysqli_stmt_get_result", y se almacena en la variable "$resultado"
        $resultado = mysqli_stmt_get_result($stmt);
        //Se crea un array vacío para almacenar los equipos que se obtengan de la base de datos
        $equipos = array();
        //Se utiliza un ciclo "while" para recorrer todos los registros obtenidos de la base de datos
        //En cada iteración, se crea un nuevo objeto de la clase "Equipo", se asignan los valores de los atributos del objeto con los valores obtenidos 
        //de la base de datos
        while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            //Se crea un nuevo objeto de la clase "Equipo" para cada fila y se establecen sus propiedades a partir de los valores
            //de la fila. El objeto "Equipo" se agrega al array "$equipos".
            $equipo = new Equipo();
            $equipo->setId_equipo($fila['id_equipo']);
            $equipo->setNombre($fila['nombre']);
            $equipo->setFoto($fila['foto']);
            $equipos[] = $equipo;
        }
        //Finalmente, se cierra la consulta preparada y la conexión a la base de datos
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        //Se retorna el array "$equipos"
        return $equipos;
    }

    public function listarEnJSON(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM Equipo";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta");
        }
        mysqli_stmt_execute($stmt);
        $resultado=mysqli_stmt_get_result($stmt);
        $equipos=array();
        while($fila=mysqli_fetch_assoc($resultado)){
            $equipos[]=$fila;
        }
        echo json_encode($equipos);
        return $equipos;
    }

    public function EquipoHasLigaJSON(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM equipo_has_liga";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta");
        }
        mysqli_stmt_execute($stmt);
        $resultado=mysqli_stmt_get_result($stmt);
        $equipos=array();
        while($fila=mysqli_fetch_assoc($resultado)){
            $equipos[]=$fila;
        }
        echo json_encode($equipos);
        return $equipos;
    }
    
    //Función para consultar la base de datos y coger el id de la liga a la que pertenece un equipo
    public function cogerIdLiga($idEquipo)
    {
        //Se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión a la base de datos
        $DB = new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion = $DB->getCon();
        //Se prepara una consulta SQL para seleccionar el id de la liga a la que pertenece un equipo
        $sql = "SELECT id_liga FROM equipo_has_liga WHERE id_equipo=$idEquipo";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt = mysqli_prepare($conexion, $sql);
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        if (!$stmt) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        mysqli_stmt_execute($stmt);
        //Se obtiene el resultado de la consulta con la función "mysqli_stmt_get_result", y se almacena en la variable "$resultado"
        $resultado = mysqli_stmt_get_result($stmt);
        //Se guardan los resultados en un array asociativo llamado "$fila"
        $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
        //Se guarda el id de la liga en la variable "$id_liga"
        if($fila!=null){
            $id_liga = $fila['id_liga'];
        }
        else{
            $id_liga=null;
        }
        
        ///Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        //Se retorna el id de la liga
        return $id_liga;    
    }

    public function cogerID()
    {
        $DB = new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion = $DB->getCon();
        //Se prepara una consulta SQL para recoger un registro de la tabla "jugador"
        $sql = "SELECT * FROM equipo WHERE nombre='$this->nombre'";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt = mysqli_prepare($conexion, $sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        mysqli_stmt_execute($stmt);
        //Se llama a "mysqli_stmt_get_result()" para obtener el resultado en formato de array asociativo.
        $resultado = mysqli_stmt_get_result($stmt);
        //Se guardan los resultados en un array asociativo llamado "$fila" 
        $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
        //Se devuelve el id del jugador
        return $fila['id_equipo'];

    }

}


?>
<?php
//Clase para las Selecciones
class Seleccion
{
    //Atributos
    private $id_seleccion;
    private $nombre;
    private $foto;

    //constructor vacio
    public function __construct()
    {
    }
    public function Seleccion($id_seleccion, $nombre, $foto)
    {
        $this->id_seleccion = $id_seleccion;
        $this->nombre = $nombre;
        $this->foto = $foto;
    }
   

    //metodos get y set
    public function getId_seleccion()
    {
        return $this->id_seleccion;
    }
    public function setId_seleccion($id_seleccion)
    {
        $this->id_seleccion = $id_seleccion;
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

    //metodo to String
    public function toString()
    {
        return "Id_seleccion: " . $this->id_seleccion . " Nombre: " . $this->nombre . " Foto: " . $this->foto;
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

    public function insertar(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión a la base de datos
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $DB=new DBCON();
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para insertar un registro en la tabla "jugador", con los valores a insertar
        $sql="INSERT INTO seleccion (nombre,foto) VALUES (?,?)";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se utiliza la función "mysqli_stmt_bind_param" para vincular los valores que se van a insertar en la consulta preparada. 
        //El primer argumento es el objeto de la consulta preparada, el segundo es una cadena que indica el tipo de datos que se van a insertar 
        // y los siguientes argumentos son las variables que contienen los valores a insertar
        mysqli_stmt_bind_param($stmt,"ss",$this->nombre,$this->foto["name"]);
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        //Si la ejecución de la consulta es exitosa, se llama a la función "guardarFoto" para guardar la foto en el servidor y
        //se imprime un mensaje indicando que ha sido insertado correctamente. Si la ejecución de la consulta falla, se imprime un mensaje de error
        if(mysqli_stmt_execute($stmt)){
            $this->guardarFoto();
            echo "Equipo insertado correctamente";
        }else{
            echo "Error al insertar el equipo: " . mysqli_stmt_error($stmt);
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
        //Se prepara una consulta SQL para recoger todos los registro de la tabla "seleccion"
        $sql="SELECT * FROM seleccion";
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
        //Se inicializa un array vacío llamado "$selecciones" y se itera sobre cada fila del resultado usando un bucle "while"
        $selecciones=array();
        while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            //Se crea un objeto "Seleccion" para cada fila y se establecen sus propiedades a partir de los valores
            //de la fila. El objeto "Seleccion" se agrega al array "$selecciones".
            $seleccion=new Seleccion();
            $seleccion->setId_seleccion($fila["id_seleccion"]);
            $seleccion->setNombre($fila["nombre"]);
            $seleccion->setFoto($fila["foto"]);
            $selecciones[]=$seleccion;
        }
        //Finalmente, se cierra la sentencia preparada y se cierra la conexión a la base de datos. 
        //El array "$selecciones" se devuelve como resultado de la función.
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        return $selecciones;
    }
    public function listarEnJSON(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM seleccion";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta");
        }
        mysqli_stmt_execute($stmt);
        $resultado=mysqli_stmt_get_result($stmt);
        $selecciones=array();
        while($fila=mysqli_fetch_assoc($resultado)){
            $selecciones[]=$fila;
        }
        echo json_encode($selecciones);
        return $selecciones;
    }
    public function cogerID(){
        $DB=new DBCON();
        //Se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $conexion=$DB->getCon();
        
        //Se prepara una consulta SQL para recoger un registro de la tabla "jugador"
        $sql="SELECT * FROM seleccion WHERE nombre='$this->nombre'";    
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
        return $fila['id_seleccion'];
        
    }
}       
?>
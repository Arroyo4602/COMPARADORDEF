<?php
//Clase para las Ligas
class Liga
{
    //Atributos
    private $id_liga;
    private $nombre;
    private $foto;

    //Constructor vacío
    public function __construct()
    {
    }

    //Constructor con ID
    public function IDLiga($id_liga, $nombre, $foto)
    {
        $this->id_liga = $id_liga;
        $this->nombre = $nombre;
        $this->foto = $foto;
    }
    
    //Constructor sin ID
    public function Liga($nombre, $foto)
    {  
        $this->nombre = $nombre;
        $this->foto = $foto;
    }

    //metodos get y set
    public function getId_liga()
    {
        return $this->id_liga;
    }
    public function setId_liga($id_liga)
    {
        $this->id_liga = $id_liga;
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
        return "Id_liga: " . $this->id_liga . " Nombre: " . $this->nombre . " Foto: " . $this->foto;
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
        //Se prepara una consulta SQL para insertar un registro en la tabla "liga", con los valores a insertar
        $sql="INSERT INTO liga (nombre,foto) VALUES (?,?)";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        //Si la preparación de la consulta falla, se imprime un mensaje de error y se detiene la ejecución del programa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se utiliza la función "mysqli_stmt_bind_param" para vincular los valores que se van a insertar en la consulta preparada. 
        //El primer argumento es el objeto de la consulta preparada, el segundo es una cadena que indica el tipo de datos que se van a insertar 
        // y los siguientes argumentos son las variables que contienen los valores a insertar
        mysqli_stmt_bind_param($stmt, "ss",$this->nombre,$this->foto['name']);
        //se ejecuta la consulta preparada con la función "mysqli_stmt_execute". 
        //Si la ejecución de la consulta es exitosa, se llama a la función "guardarFoto" para guardar la foto en el servidor y
        //se imprime un mensaje indicando que ha sido insertado correctamente. Si la ejecución de la consulta falla, se imprime un mensaje de error
        if(mysqli_stmt_execute($stmt)){
            $this->guardarFoto();
            echo "Liga insertado correctamente";
        }else{
            echo "Error al insertar la Liga: " . mysqli_stmt_error($stmt);
        }
        //Finalmente, se cierra la consulta preparada y la conexión a la base de datos
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }
    //Función para consultar una base de datos MySQL y devolver un array de objetos de la clase "Liga".
    public function listar(){
        //En primer lugar, se crea una nueva instancia de la clase "DBCON", que es una clase que maneja la conexión 
        //a la base de datos, se obtiene la conexión a la base de datos y se almacena en la variable "$conexion"
        $DB=new DBCON();
        $conexion=$DB->getCon();
        //Se prepara una consulta SQL para seleccionar todos los registros de la tabla "liga"
        $sql="SELECT * FROM liga";
        //Se utiliza la función "mysqli_prepare" para preparar la consulta, y se verifica si la preparación fue exitosa
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }
        //Se ejecuta la consulta preparada con la función "mysqli_stmt_execute".
        mysqli_stmt_execute($stmt);
        //Se utiliza la función "mysqli_stmt_get_result" para obtener el resultado de la consulta preparada
        $resultado=mysqli_stmt_get_result($stmt);
        //Se crea un array vacío para almacenar los objetos de la clase "Liga"
        $ligas=array();
        //Se utiliza la función "mysqli_fetch_array" para obtener los registros de la consulta y almacenarlos en un array asociativo
        while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            //Se crea un objeto de la clase "Liga" y se asignan los valores de los registros a los atributos del objeto
            $liga=new Liga();
            $liga->setId_liga($fila["id_liga"]);
            $liga->setNombre($fila["nombre"]);
            $liga->setFoto($fila["foto"]);
            //Se agrega el objeto de la clase "Liga" al array de objetos
            $ligas[]=$liga;
        }
        //Finalmente, se cierra la consulta preparada y la conexión a la base de datos
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        //Se retorna el array de objetos de la clase "Liga"
        return $ligas;
    }

    public function listarEnJSON(){
        $DB=new DBCON();
        $conexion=$DB->getCon();
        $sql="SELECT * FROM liga";
        $stmt=mysqli_prepare($conexion,$sql);
        if(!$stmt){
            die("Error al preparar la consulta");
        }
        mysqli_stmt_execute($stmt);
        $resultado=mysqli_stmt_get_result($stmt);
        $ligas=array();
        while($fila=mysqli_fetch_assoc($resultado)){
            $ligas[]=$fila;
        }
        echo json_encode($ligas);
        return $ligas;
    }
   
}
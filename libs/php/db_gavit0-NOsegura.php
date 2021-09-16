<?php
    //Aqui funcionalidades utilitarias
    //Para usar estaclasee: require_once "libs/php/libreria_gavit0.php"

    //Crea y retorna la conexion a la db
    function ConexionDB(){
        $servername = "localhost";
        $database = "secure_db";
        $username= "root";
        $password = "";

        $sql = "mysql:host=$servername;dbname=$database;";
        $dsn_Options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
        //Create a new connection to the MySQL database using PDO, $my_Db_Connection
        try {
            $my_Db_Connection = new PDO($sql, $username,$password,$dsn_Options);
            return $my_Db_Connection;
        } catch (PDOException $error) {
            echo 'Connection error: '.$error->getMessage();
            return NULL;
        }

        
        function RegistrarUsuarioDB($my_Db_Connection, $Usuario, $Clave, $Nombre, $Apellido){
            
        }
    }
?>
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

        
        function RegistrarUsuarioDB($my_Db_Connection, $NOMBRE, $APELLIDO,$FECHA_NACIMIENTO,$FOTO,$CANTIDAD_HIJOS,$COLOR,$USUARIO,$CLAVE,){
            $my_Insert_Statement =
                $my_Db_Connection->prepare("INSERT INTO `usuarios`(`NOMBRE`,`APELLIDO`,`FECHA_NACIMIENTO`,`FOTO`,`CANTIDAD_HIJOS`,`COLOR`,`USUARIO`,`CLAVE`)" .
                "VALUES (:NOMBRE,:APELLIDO,:FECHA_NACIMIENTO,:FOTO,:CANTIDAD_HIJOS,:COLOR,:USUARIO,:CLAVE)");

            $my_Insert_Statement->bindParam(':NOMBRE',$NOMBRE);
            $my_Insert_Statement->bindParam(':APELLIDO',$APELLIDO);
            $my_Insert_Statement->bindParam(':FECHA_NACIMIENTO',$FECHA_NACIMIENTO);
            $my_Insert_Statement->bindParam(':FOTO',$FOTO);
            $my_Insert_Statement->bindParam(':CANTIDAD_HIJOS',$CANTIDAD_HIJOS);
            $my_Insert_Statement->bindParam(':COLOR',$COLOR);
            $my_Insert_Statement->bindParam(':USUARIO',$USUARIO);
            $my_Insert_Statement->bindParam(':CLAVE',$CLAVE);

            if ($my_Insert_Statement->execute()) {
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }
?>
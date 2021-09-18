<?php
    function ConexionDB(){
        $servername = "localhost";
        $database = "secure_db";
        $username = "root";
        $password = "123456";

        $sql = "mysql:host=$servername; dbname=$database;";
        $dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        
        try {
            $my_db_Connection = new PDO($username, $password, $dsn_Options);
            return $my_db_Connection;
        } catch (PDOException $error) {
            echo 'Connection error '. $error->getMessage();
            return NULL;
        }
    }

    function RegistrarUsuarioDB($my_db_Connection, $Usuario, $Clave, $Nombre, $Apellido, $Correo, $FNacimiento, $Cedula, $Hijos, $EstadoCivil){
        $Token = '';
        $my_Insert_Statement = 
            $my_db_Connection->prepare("INSERT INTO `usuarios`(`Usuario`, `Clave`, `Token`, `Nombre`, `Apellido`, `Correo`,'FNacimiento','Cedula','Hijos','EstadoCivil')" .
                "VALUES ('$Usuario', '$Clave', '$Token','$Nombre', '$Apellido', '$Correo', '$FNacimiento','$Cedula','$Hijos','$EstadoCivil')");
        if ($my_Insert_Statement->execute()) {
            //echo "Nuevo Usuario Creado";
            return TRUE;
        }else{
            //echo "No se pudo crear Usuario";
            return FALSE;
        }   
    }

    function ValidarLoginDB($my_db_Connection, $usuario, $clave){
        $token = '';
        $my_Select_Statement = 
            $my_db_Connection->prepare("SELECT `Usuario` FROM `usuarios` WHERE `Usuario`='$usuario' and `Clave`='$clave'");
            
            $my_Select_Statement->execute([]);
        $user = $my_Select_Statement ->fetch();
        if($user){
            $token = md5(time() . $usuario);
        }
        echo $token;
        return $token;
    } 

?>
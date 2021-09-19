<?php
    function ConexionDB(){
        $servername = "localhost";
        $database = "mensajes";
        $username = "root";
        $password = "123456";

        $sql = "mysql:host=$servername; dbname=$database;";
        $dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        
        try {
            $my_Db_Connection = new PDO($sql,$username, $password, $dsn_Options);
            return $my_Db_Connection;
        } catch (PDOException $error) {
            echo 'Connection error '. $error->getMessage();
            return NULL;
        }
    }

    function RegistrarUsuarioDB($my_Db_Connection,$usuario,$clave,$nombre,$apellido,$nacimiento,$cantidad_hijos,$color,$foto){

        $my_Insert_Statement=
            $my_Db_Connection->prepare("INSERT INTO usuarios (Usuario,Clave,Nombre,Apellido,FNacimiento,Hijos,Color,Foto)".
            "VALUES (:Usuario, :Clave,  :Nombre, :Apellido, :FNacimiento, :Hijos, :Color,:Foto)");
        $my_Insert_Statement->bindParam(':Usuario',$usuario);
        $my_Insert_Statement->bindParam(':Clave',$clave);
        $my_Insert_Statement->bindParam(':Nombre',$nombre);
        $my_Insert_Statement->bindParam(':Apellido',$apellido);
        $my_Insert_Statement->bindParam(':FNacimiento',$nacimiento);
        $my_Insert_Statement->bindParam(':Hijos',$cantidad_hijos);
        $my_Insert_Statement->bindParam(':Color',$color);
        $my_Insert_Statement->bindParam(':Foto',$foto);

        if ($my_Insert_Statement->execute()) {
            echo "Nuevo Usuario Creado";
            return TRUE;
        }else{
            echo "No se pudo crear Usuario";
            return FALSE;
        }   
    }

    function publicarTuit($my_Db_Connection,$usuario,$tuit){
        $my_Insert_Statement=
            $my_Db_Connection->prepare("INSERT INTO mensajes (Usuario,tuit)".
            "VALUES (:Usuario, :tuit)");
        $my_Insert_Statement->bindParam(':Usuario',$usuario);
        $my_Insert_Statement->bindParam(':tuit',$tuit);
        if ($my_Insert_Statement->execute()) {
            return TRUE;
        }else{
            echo "No se pudo compartir";
            return FALSE;
        }   
    }


    function BorrarTuit($my_Db_Connection,$Id){
        $my_Delete_Statement=
            $my_Db_Connection->prepare("DELETE FROM `mensajes` WHERE `Id`=$Id");

            $my_Delete_Statement->execute(['Id'=>$Id]);

        if ($my_Delete_Statement->execute()) {
            '<script>alert("Eliminado")</script>';
            return TRUE;
        }else{
            echo "No se pudo compartir";
            return FALSE;
        }   
    }

    function MostrarTuits($my_Db_Connection){
        $lista_tuits = [];

        try {
            $my_Select_Statement = 
            $my_Db_Connection->prepare("SELECT `Id`,`Usuario`,`tuit` FROM `mensajes`");
            $my_Select_Statement->execute([]);
            $lista_tuits = $my_Select_Statement-> fetchAll();
            ;
        } catch (\Throwable $th) {
            
        }

        return $lista_tuits;
    }

    function ActualizarUsuariosDB($my_Db_connetion,$usuario,$nombre,$apellido,$nacimiento,$cantidad_hijos,$color,$foto){

        $my_Insert_Statement=
            $my_Db_connetion->prepare("UPDATE `usuarios` SET `Nombre`=:Nombre,`Apellido`=:Apellido,".
             "`FNacimiento`=:FNacimiento,`Foto`=:Foto,`Hijos`=:Hijos,`Color`=:Color WHERE `Usuario`=:Usuario");
        $my_Insert_Statement->bindParam(':Usuario',$usuario);
        $my_Insert_Statement->bindParam(':Nombre',$nombre);
        $my_Insert_Statement->bindParam(':Apellido',$apellido);
        $my_Insert_Statement->bindParam(':FNacimiento',$nacimiento);
        $my_Insert_Statement->bindParam(':Hijos',$cantidad_hijos);
        $my_Insert_Statement->bindParam(':Color',$color);
        $my_Insert_Statement->bindParam(':Foto',$foto);

        if($my_Insert_Statement->execute()){

            return true;

        }else{

            return false;

        }

    }
    //listar usuarios
    function ListarDatosDB($ConexionDB,$usuario)
    {
        $datos=[];
        $my_Select_Statement=
            $ConexionDB->prepare("SELECT `Nombre`, `Apellido`, `FNacimiento`, `Foto`, `Hijos`,`Color`, `Usuario` FROM `usuarios` WHERE `Usuario`=:usuario");
            $my_Select_Statement->execute([':usuario'=>$usuario]); 
            $datos=$my_Select_Statement->fetchAll();
            return $datos;
    }


    function ValidarLoginDB($my_Db_Connection, $usuario, $clave){
        $my_Select_Statement = 
            $my_Db_Connection->prepare("SELECT `Usuario` FROM `usuarios` WHERE `Usuario`='$usuario' and `Clave`='$clave'");
            
            $my_Select_Statement->execute(['Usuario'=>$usuario,'Clave'=>$clave]);
        $user = $my_Select_Statement->fetch();
        if($user){
            return true;
        }

        return false;

    } 
    function ListarUsuarios($my_Db_Connection){
        $lista_usuario = [];

        try {
            $my_Select_Statement = 
            $my_Db_Connection->prepare("SELECT `Usuario`,`Nombre`,`Apellido` FROM `usuarios`");
            $my_Select_Statement->execute([]);
            $lista_usuario = $my_Select_Statement-> fetchAll();
            ;
        } catch (\Throwable $th) {
            
        }

        return $lista_usuario;
    }
?>
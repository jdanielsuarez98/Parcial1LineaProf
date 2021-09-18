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
    function ActualizarUsuariosDB($my_Db_Connection,$Usuario,$Nombre, $Apellido,$FNacimiento,$Color,$Hijos,$Foto){

        $my_Insert_Statement=
            $my_Db_Connection->prepare("UPDATE usuarios SET Nombre=:Nombre, Apellido=:Apellido,".
             "`FNacimiento`=:FNacimiento,`Color`=:Color,`Hijos`=:Hijos,`Foto`=:Foto, WHERE `Usuario`=:Usuario");
             
        $my_Insert_Statement->bindParam(':Usuario',$Usuario);
        $my_Insert_Statement->bindParam(':Nombre',$Nombre);
        $my_Insert_Statement->bindParam(':Apellido',$Apellido);
        $my_Insert_Statement->bindParam(':Nacimiento',$FNacimiento);
        $my_Insert_Statement->bindParam(':Hijos',$Hijos);
        $my_Insert_Statement->bindParam(':Color',$Color);
        $my_Insert_Statement->bindParam(':Foto',$Foto);

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
        // $token = '';
        $my_Select_Statement = 
            $my_Db_Connection->prepare("SELECT `Usuario` FROM `usuarios` WHERE `Usuario`='$usuario' and `Clave`='$clave'");

            echo "SELECT `Usuario` FROM `usuarios` WHERE `Usuario`='$usuario' and `Clave`='$clave'";
            
            $my_Select_Statement->execute(['Usuario'=>$usuario,'Clave'=>$clave]);
        $user = $my_Select_Statement->fetch();
        if($user){
            return true;
            // echo 'Si loggeo en ValidarLoginDB ';
            // $token = md5(time() . $usuario);
        }
        // echo $token;
        return false;
        // return $token;
    } 
    /**
     * Retorna un listado de usuarios registrados
     * 
     * @param @$my_Db_Connection: Objeto conexion
     * 
     * @return Lista de usuarios disponibles
     */
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
    /**
     * Envia un mensaje de un usuario a otro
     * 
     * @param @$my_Db_Connection : Objeto conexion
     * @param $usuario_origen
     * @param $usuario_destino
     * @param $texto
     * 
     * @return Lista de usuarios disponibles
     */
    function EnviarMensaje($my_Db_Connection,$usuario_origen,$usuario_destino,$texto){
        $lista_usuario = [];

        try {
            $my_Insert_Statement = 
            $my_Db_Connection->prepare("INSERT INTO `mensajes`(`Id`,`Usuario_origen`,`Usuario_destino`,`Texto`)".
            "VALUES (':Usuario_origen',':Apellido',':Apellido' )");
            
            $my_Insert_Statement ->bindParams(':Usuario_origen', $usuario_origen);
            $my_Insert_Statement ->bindParams(':Usuario_destino', $usuario_destino);
            $my_Insert_Statement ->bindParams(':Texto', $texto);

            if ($my_Insert_Statement->execute()) {
                //echo "Nuevo Usuario Creado";
                return TRUE;
            }else{
                //echo "No se pudo crear Usuario";
                return FALSE;
            }   

        } catch (\Throwable $th) {
            
        }

        return $lista_usuario;
    }
    function ListarMensajesRecibidos($my_Db_Connection){
        
    }
    function ListarMensajesEnviados(){
        
    }
    function BorrarMensaje(){
        
    }

?>
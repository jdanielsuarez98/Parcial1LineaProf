<?php

    require_once "libs/php/tools_daniel.php";
    require_once "libs/php/db_daniel.php";

    LimpiarEntradas();
    IniciarSesionSegura();
    MostrarErrores();
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //cerrar sesion
    if(isset($_POST['btnCerrarSesion']))
    {
        $_SESSION = array();
            if (ini_get("session.use_cookies")) {

                $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
            }

            // Finalmente, destruir la sesión.
            session_destroy();
            header('Location:index.php');
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //actualizar usuario
    if(isset($_POST['btnActualizar']))
    {
        header('Location:registro.php');
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //crear tuits
    if(isset($_POST['btnCrearTuit']))
    {
        //header('Location:registro.php');
        //$id_usuario = $_POST['txtUsuario'];
        $tuit =$_POST['txtTuit'];
        
        $CONN=ConexionDB();
        if ($CONN !=NULL)
        {
          //  RegistrarTuitsDB($CONN,$usuario,$clave);  
        }   

        echo '<script>alert("Usuario Registrado")</script>';
        echo '<script>window.location.href="index.php"; </script>';
    }
    

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // sesion abierta
    if (isset($_SESSION['UsuarioConectado']))
    {
    $CONN = ConexionDB();
    if($CONN!=NUll)
    {
        $datos=ListarDatosDB($CONN,$_SESSION['UsuarioConectado']);
        foreach ($datos as $key => $value) {
            
            echo '<body style="background-color:'.$value['Color'].'">';
            echo '<body id="body">';
            echo '<h3>APLICATIVO</h3>';
            echo 'Bienvenido a su cuenta, '.'<b>'.$value['Usuario'].'</b>'.'!';
            echo '<br><br>';
            echo '<b>'.'Nombre: '.'</b>'.$value['Nombre'].'<br>';
            echo '<b>'.'Apellido: '.'</b>'.$value['Apellido'].'<br>';
            echo '<b>'.'Fecha de Nacimiento: '.'</b>'.$value['FNacimiento'].'<br>';
            echo '<b>'.'Cantidad de Hijos: '.'</b>'.$value['Hijos'].'<br>';
            echo '<b>'.'Foto:'.'</b>'.'<br><img height="300" src="images/' . $value["Foto"] . '"><br><br>';
            }
            echo '<form method="post">
            <button name="btnCerrarSesion" values="Cerrar Sesion">Cerrar Sesión</button>
            <button name="btnActualizar" values="Actualizar Datos">Actualizar Datos</button>
            <button name="btnCrearTuits" values="Crear Tuits">Crear Tuits</button>
            </form>
        </body>';
            if(isset($_POST['btnCrearTuits'])){
                echo '<form method="post">
                <label for="txtTuit">Escribe un Tuit: </label><br>
                <input type="text" name="txtTuit" id="txtTuit" pattern="[A-Za-z9-0]"><br><br>

                <button name="btnEnviarTuits" values="Guardar">Guardar</button>
                <button name="btnCancelarTuit" values="Cancelar">Cancelar</button>


            </form>';
                if(isset($_POST['btnEnviarTuits'])){
                //    RegistrarTuitsDB($CONN,$value['Usuario'],$tuit,$fecha_tuit);
                }
                if(isset($_POST['btnCancelar'])){
                    exit();
                }
            }
        }
        exit();
    }
    else 
    {
        echo '<h3>APLICATIVO</h3>';

        echo '<a href="registro.php"><button>Registrarse</button></a><br><br>';
        echo '<a href="login.php"><button>Iniciar Sesión</button></a><br>';
    }

?>




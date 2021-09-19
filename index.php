
<?php
    $colorr = '';
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
    ?>
    <div>
    <div style="height: 100%; width:20%; float:left; padding: 5px; background-color: #AECBDE;">
<?php
            //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            // sesion abierta
            if (isset($_SESSION['UsuarioConectado']))
            {
            $CONN = ConexionDB();
            if($CONN!=NUll)
            {
                $datos=ListarDatosDB($CONN,$_SESSION['UsuarioConectado']);
                foreach ($datos as $key => $value) {
                    global $colorr;
                    $colorr = $value["Color"];
                echo'
                    <div style="height:90%; padding: 15px;background-color: '.$value["Color"].' ">
                    <h3>Chat General</h3>
                    Bienvenido <b>'.$value["Usuario"].' !</b>
                    <br><br>
                    <b>Nombre: </b>'.$value["Nombre"].' <br>
                    <b>Apellido: </b>'.$value["Apellido"].'<br>
                    <b>Fecha de Nacimiento: </b>'.$value["FNacimiento"].'<br>
                    <b>Cantidad de Hijos: </b>'.$value["Hijos"].'<br>
                    <b>Foto:</b><br><img height=100" src="./uploaded_files/'.$value["Foto"].' "><br><br>';
                 } ?>
            <?php
              echo '  
                <form method="post">
                    <button name="btnCerrarSesion" values="Cerrar Sesion">Cerrar Sesión</button>
                    <button name="btnActualizar" values="Actualizar Datos">Actualizar Datos</button>
                    </form>
                    </div>';
            ?>
    
        <?php
                }
            }
            else 
            {

                echo '<h3>Por favor ingresa para poder usar tu cuenta</h3>';

                echo '<a href="registro.php"><button>Registrarse</button></a><br><br>';
                echo '<a href="login.php"><button>Iniciar Sesión</button></a><br>';

            }

    ?>
    </div>
    <div style="height:100%; width:77.5%; padding:10px;float:right; background-color: #C2C8CA ">
    <?php 
    if(isset($_SESSION['UsuarioConectado']))
    {
    
    ?>
        <!-- Realizacion de Tuits -->
        <form method="post">
            <label for="txtTuit">Haz un Tuit ahora!!: </label><br>
            <input type="text" name="txtTuit" id="txtTuit" pattern="[A-Za-z9-0]"><br><br>

            <button name="btnTuit" values="Guardar">Guardar</button>
            <button name="btnCancelarTuit" values="Cancelar">Cancelar</button>

        </form>
        <?php
            if(isset($_POST['btnTuit'])){
                $usuario = $_SESSION['UsuarioConectado'];
                $tuit = $_POST['txtTuit'];

                $CONN=ConexionDB();
                if ($CONN !=NULL)
                {
                    publicarTuit($CONN,$usuario,$tuit); 

                }
            }  
            if(isset($_POST['btnCancelar'])){
                exit();
            }
        }
        else {
            echo 'Inicia sesion para poder comentar en el chat general';
        }
        $tuitss = MostrarTuits($CONN);
        //foreach ($tuitss as $key => $value) {
        $registros=$base->query("SELECT Id FROM mensaje")->fetchAll(PDO::FETCH_OBJ);
        foreach($registros as $tuits){ 
            
            if ($value["Usuario"] == $_SESSION['UsuarioConectado']) {
                echo '<form " method="post">'.
               // $value["Usuario"].' Comment: '.  $value["tuit"].'
                $tuits -> 
                '<a href="db_daniel.php?borrar=id=<?php echo $tuits->Id?> name="btnBorrarTuit">Borrar</a>
                </form>';
                
            }
            else {
                echo $value["Usuario"].' Comment: '.  $value["tuit"].'<br><br>';
            }

            if (isset($_POST["borrar"])) {
                borrarTuit($CONN,$value["Id"]);
                
            }
        }

    ?>
    </div>
</div>

<?php 
                    if ($_SESSION["rol_cc"] == 1) {
                        ?>href="Actualizar_Empleados?editar=<?php echo $ID_PERSONA; ?> ">
                        <?php
                            if(isset($_GET['editar'])){
                                include("Crud_Actualizar_Empleado.php");
                            }
                    }
                    ?>
                <font color="blue">Actualizar</font></a></td>
                </tr>
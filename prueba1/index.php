<div>
    
    <div style="width: 20%;height: 100%;float:left">
        <?php 
            session_start();
            if (isset($_SESSION['UsuarioConectado']) && $_SESSION['UsuarioConectado'] != null) {
                echo
                '<br>'.$_SESSION['UsuarioConectado']['Nombre'].
                '<br>'.$_SESSION['UsuarioConectado']['Apellido'].
                '<br>'.$_SESSION['UsuarioConectado']['Hijos'].
                '<br>'.$_SESSION['UsuarioConectado']['FechaNacimiento'].
                '<br>'.$_SESSION['UsuarioConectado']['Usuario'].
                '<p><img src="../images/'.$_SESSION['UsuarioConectado']['Imagen'].'"></p>';
                echo '<br><a href="registro.php">Actualiza tus Datos</a><br><br>';
                echo '<form method="post"><input type="submit" name="btnsalir" value="Cerrar Sesion"></form>';
            }
            else {
                echo "Usted no se ha logueado<br>";
                echo'<a href="./registro.php">Registrarse<a><br>';
                echo '<a href="./login.php">Iniciar Sesion<a>';
            }
        ?> 
        
    </div> 
    <div style="width: 80%;height: 100%;float:right;">
    <?php 
        $usu = NULL;
        if (isset($_SESSION['UsuarioConectado']) && $_SESSION['UsuarioConectado'] != null ) {
    ?> 
        <form method="post">
            <label for="txtMensaje"> Que piensas </label>
            <input type="text" name="txtMensaje" id="txtMensaje">
            <input type="submit" name="btnTuit" value="Tuit!">
        </form>
    <?php 
            if(isset($_SESSION['tuits'])== FALSE){
                $_SESSION['tuits'] = [];
            }
            
            $usu = $_SESSION['UsuarioConectado'];
            if(isset($_POST['btnTuit'])){
                $tuit = [
                    'id' => time(),
                    'texto' => $_POST['txtMensaje'],
                    'usuario' => $usu
                ];
        
                array_push($_SESSION['tuits'],$tuit);
            }
        }
        else {
            echo '<h2>Por favor logueate para poder realizar tuits<h2>';
        }

         
        if(isset($_SESSION['tuits']))
        foreach($_SESSION['tuits'] as $tuit){
            echo '<div> '. $tuit['texto'] .' </div>';
    
            if (isset($usu) && $usu['Usuario'] == $tuit['usuario']['Usuario']) {
                echo '
                <form method="post">
                    <input type="submit" name="delete" value="'. $tuit['id'] .'">
                </form>'
                ;
            }
        }         
    ?> 
    </div>
</div>


<?php 
    
    if(isset($_POST['btnsalir'])){
        //destruir todas las variables de sesion
        $_SESSION = array(); 

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finalmente, destruir la sesión.
        $_SESSION['UsuarioConectado'] = [];
        //session_destroy();
        header("Location: registro.php");
        exit();
    }

    function Limpieza($text){
        // $text = str_replace('<script>','',$text);
        // $text = htmlspecialchars($text);
        // return $text;
    }

    if (isset($_POST['delete'])) {
        $idt = -1;
        foreach ($_SESSION['tuits'] as $key => $tuit) {
            if ($tuit['id']== $_POST['delete']) {
                $idt = $key;
                break;
            }
        }
        unset($_SESSION['tuits'][$idt]);
    }

    ?>
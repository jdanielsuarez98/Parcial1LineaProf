
<form method="post">
    <label for="txtMensaje"> Que piensas </label>
    <input type="text" name="txtMensaje" id="txtMensaje">
    <input type="submit" name="btnTuit" value="Tuit!">
    <input type="submit" name="btnsalir" value="Cerrar Sesion">
</form>
<a href="./registro.php">Registrarse<a><br>
<a href="./login.php">Iniciar Sesion<a>


<?php 
    session_start();
    if (isset($_SESSION['UsuarioConectado'])) {
        echo
        '<br>'.$_SESSION['UsuarioConectado']['Nombre'].
        '<br>'.$_SESSION['UsuarioConectado']['Apellido'].
        '<br>'.$_SESSION['UsuarioConectado']['Hijos'].
        '<br>'.$_SESSION['UsuarioConectado']['FechaNacimiento'].
        '<br>'.$_SESSION['UsuarioConectado']['Usuario'].
        '<p><img src="../images/'.$_SESSION['UsuarioConectado']['Imagen'].'"></p>';
        echo '<a href="registro.php">Actualizar</a>';
    }
    else {
        echo "Usted no se ha logueado";
    }

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

    ?>
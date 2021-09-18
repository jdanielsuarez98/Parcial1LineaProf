
<?php

    require_once "libs/php/tools_daniel.php";
    require_once "libs/php/db_daniel.php";
    MostrarErrores();
    IniciarSesionSegura();
    LimpiarEntradas();


    $tipoMensaje = "";
    $mensaje = "";

    function ValidarLogin(){
        // global $tipoMensaje, $mensaje;
        $txtUsuario = $_POST['txtUsuario'];
        $txtClave = md5($_POST['txtClave']);
        $btnIngresar = $_POST['btnIngresar'];
        unset($_SESSION['UsuarioConectado']);
        if(isset($btnIngresar) && $btnIngresar == 'Ingresar'){

            $conn = ConexionDB();
            if($conn != NULL){
                if(ValidarLoginDB($conn,$txtUsuario,$txtClave)){
                    $_SESSION['UsuarioConectado'] = $_POST['txtUsuario'];
                    header("Location: index.php");
                    exit();
                }
                else{
                    echo 'Usuario incorrecto';
                    // $tipoMensaje = "error";
                    // $mensaje .= 'Usuario no logueado';
                }
            }
        }
    }

    if(isset($_POST) && isset($_POST['btnIngresar'])){
        LimpiarEntradas();
        ValidarLogin();
    }

?>

<h1>Formulario de ingreso</h1>
<form method="post">
    <label for="txtUsuario"> Usuario </label>
    <input type="text" name="txtUsuario" id="txtUsuario">
    <br>
    <label for="txtClave"> Clave </label>
    <input type="password" name="txtClave" id="txtClave">
    <br>
    <input type="submit" name="btnIngresar" value="Ingresar">
</form>



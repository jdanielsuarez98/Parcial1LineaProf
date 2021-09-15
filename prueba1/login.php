<?php 
    session_start();
    if(isset($_SESSION['usuarios'])){
        if (isset($_POST['Ingresar'])) {
            $_SESSION['UsuarioConectado']=[];
            foreach ($_SESSION['usuarios'] as $user) {
                if ($_POST['txtNombre'] == $user['Usuario'] &&
                    $_POST['txtClave'] == $user['Clave']) 
                {
                    $_SESSION['UsuarioConectado'] = $user;
                    header("Location: index.php");
                    exit();
                }
            }
            if ($_SESSION['UsuarioConectado']==null) {
                echo "Credenciales Incorrectos";
            }
        }
        
    }
    else
    {
        header("Location: registro.php");
    }
?>

<form  method="post">
    <label for="txtNombre">Usuario:</label>
    <input type="text" id="txtNombre" name="txtNombre"><br><br>

    <label for="txtClave">Clave:</label>
    <input type="text" id="txtClave" name="txtClave"><br><br>

    <input type="submit" name="Ingresar" value="Ingresar">
    <a href="./registro.php">Registrarse<a>
    <a href="./index.php">Index<a>
</form>  

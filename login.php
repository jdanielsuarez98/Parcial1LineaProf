<?php
    session_start();

    function Limpieza($text){
        $text = str_replace('<script>','',$text);
        $text = htmlspecialchars($text);
        return $text;
    }

    if(isset($_SESSION['usuarios'])==false){
        $_SESSION['usuarios']=[];
    }

    if(isset($_POST['btnIngresar'])){
        foreach($_SESSION['usuarios'] as $usu)
        {
            if(
                $usu['Usuario'] == $_POST['txtUsuario'] &&
                $usu['Clave'] == $_POST['txtClave'] 
            ){
                $_SESSION['UsuarioConectado'] = $usu;
                header('Location: index.php');
                exit();
            }
        }
    }

?>

<form method="post">
    <label for="txtUsuario"> Usuario </label>
    <input type="text" name="txtUsuario" id="txtUsuario">
    <br>
    <label for="txtClave"> Clave </label>
    <input type="password" name="txtClave" id="txtClave">
    <br>
    <input type="submit" name="btnIngresar" value="Registrar">
</form>
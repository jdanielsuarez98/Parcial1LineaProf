<?php
    session_start();

    function Limpieza($text){
        $text = str_replace('<script>','',$text);
        $text = htmlspecialchars($text);
        return $text;
    }

    if(isset($_SESSION['usuarios'])==false){
        $_SESSION['usuarios'] = [];
    }
    if(isset($_POST['btnRegistrar'])){

        if(isset($_SESSION['UsuarioConectado'])){
            $usu = $_SESSION['UsuarioConectado'];
            $usu['Nombre'] = Limpieza($_POST['txtNombre']);
            $usu['Nacimiento'] = Limpieza($_POST['txtNacimiento']);
            $usu['Usuario'] = Limpieza($_POST['txtUsuario']);
            $usu['Clave'] = Limpieza($_POST['txtClave']);
            $_SESSION['UsuarioConectado'] = $usu;
            $id = -1;
            foreach ($_SESSION['usuarios'] as $Usuario) {
                $id += 1;
                if($Usuario['Usuario']== $usu['Usuario']){
                    break;
                }
            }
            $_SESSION['usuarios'][$id]=$usu;
        }
        else{
            $usu = [
                'Nombre' => Limpieza($_POST['txtNombre']),
                'Nacimiento' => Limpieza($_POST['txtNacimiento']),
                'Usuario' => Limpieza($_POST['txtUsuario']),
                'Clave' => Limpieza($_POST['txtClave']) ,
            ];
            array_push($_SESSION['usuarios'],$usu);
        }
    }



?>

<form method="post">
    <label for="txtNombre"> Nombre </label>
    <input type="text" name="txtNombre" id="txtNombre">
    <br>
    <label for="txtNacimiento"> Fecha:  </label>
    <input type="date" name="txtNacimiento" id="txtNacimiento"> 
    <br>
    <label for="txtUsuario"> Usuario </label>
    <input type="text" name="txtUsuario" id="txtUsuario">
    <br>
    <label for="txtClave"> Clave </label>
    <input type="password" name="txtClave" id="txtClave">
    <br>
    <input type="submit" name="btnRegistrar" value="Registrar">
</form>
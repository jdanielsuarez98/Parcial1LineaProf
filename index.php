<?php
    session_start();

    function Limpieza($text){
        // $text = str_replace('<script>','',$text);
        // $text = htmlspecialchars($text);
        // return $text;
    }

    if (isset($_POST['btnSalir'])) {
        unset($_SESSION['UsuarioConectado']);
    }  

    if(isset($_SESSION['tuits'])== FALSE){
        $_SESSION['tuits'] = [];
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

    $usu = NULL;
    if(isset($_SESSION['UsuarioConectado'])){
        $usu = $_SESSION['UsuarioConectado'];

        echo 'Nombre: ' . $usu['Nombre'] . '<br>';
        echo 'Usuario: ' . $usu['Usuario'] . '<br>';
        echo 'Fecha de Nacimiento: ' . $usu['Nacimiento'] . '<br>';
        echo '<a href="registro.php">Actualizar</a>';
        echo '<form method="post"><input type="submit" name="btnSalir" value="Salir"></form>';
    }
    else{
        echo '<a href="login.php">Login</a>' . '<br>';
        echo '<a href="registro.php">Registro</a>';
    }
    
    //gagagagagagagagagagaa
    if(isset($_POST['btnTuit'])){
        $tuit = [
            'id' => time(),
            'texto' => $_POST['txtMensaje'],
            'usuario' => $usu
        ];

        array_push($_SESSION['tuits'],$tuit);
    } 

    foreach($_SESSION['tuits'] as $tuit){
        echo '<div> '. $tuit['texto'] .' </div>';

        if (isset($usu) && $usu['Usuario']=$tuit['usuario']['Usuario']) {
            echo '
            <form method="post">
                <input type="submit" name="delete" value="'. $tuit['id'] .'">
            </form>'
            ;
        }
    }         
?>

<form method="post">
    <label for="txtMensaje"> Que piensas </label>
    <input type="text" name="txtMensaje" id="txtMensaje">
    <input type="submit" name="btnTuit" value="Tuit!">
</form>



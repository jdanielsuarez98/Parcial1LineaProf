<head></head>
<div>
    <h1>Mensajes</h1>
    <form method="post">
        <b> Enviar Mensajes </b><br>
        <label form = "lstUsuarios">Destinatario: </label>
        <select name="lstUsuarios" id="lstUsuarios">
            <?php
                $usuarios = ListarUsuarios($conn);

                foreach($usuarios as $key => $value){
                    echo '<option value="'. $value['Usuario'] .'">'.
                        $value['Nombre'] .' '. $value['Apellido'] .'</option>';
                }
            ?>
        </select>   
        <label for="txtMensaje"> Mensaje: </label>
        <input type="text" name="txtMensaje" id="txtMensaje">
        <input type="submit" name="btnMensaje" value="Enviar">
        <?php
            if(isset($_POST['btnMensaje'])){

               $usuario_origen =  $_SESSION['UserName'];     
               $usuario_destino = $_POST['lstUsuarios'];   
               $texto = $_POST['txtMensaje'];

               echo 'Origen' . $usuario_origen . '<br>';
               echo 'Destino' . $usuario_destino . '<br>';
               echo 'Texto' . $texto . '<br>';

               EnviarMensaje($conn,$usuario_origen,$usuario_destino,$texto);
            } 
        ?>
    </form>
    <br><br><br>
    <b> Mensajes Recibidos </b><br>
    <?php
        
    ?>
    <br><br><br>
    <b> Mensajes Enviados </b><br>
    <?php
        
    ?>
</div>

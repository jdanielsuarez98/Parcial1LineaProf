<form method="POST" enctype="multipart/form-data">
    <label for="txtNombre">Nombre:</label>
    <input type="text" id="txtNombre" name="txtNombre" required><br><br>
    <label for="txtApellido">Apellido:</label>
    <input type="text" id="txtApellido" name="txtApellido" required><br><br>
    <label for="txtHijos">Cantidad de Hijos:</label>
    <input type="number" id="txtHijos" name="txtHijos" required><br><br>
    <label for="txtFechaNacimiento">Usuario:</label>
    <input type="date" id="txtFechaNacimiento" name="txtFechaNacimiento" required><br><br>
    <label for="txtUsuario">Usuario:</label>
    <input type="text" id="txtUsuario" name="txtUsuario" required><br><br>
    <label for="txtClave">Clave:</label>
    <input type="password" id="txtClave" name="txtClave" required><br><br>

    Añadir imagen: <input name="archivo" id="archivo" type="file"/>
    <input type="Submit" name="Registrar" value="Registrar">

</form>  
<a href="./login.php">Login<a>
<a href="./index.php">Index<a>
 

<?php 
        
    // function Limpieza($text){
    //     $text = str_replace('<script>','',$text);
    //     $text = htmlspecialchars($text);
    //     return $text;
    // }

    session_start();

    if(!isset($_SESSION['usuarios']))
    {
        $usuarios = [
            'Nombre' => 'Daniel',
            'Apellido' => 'Morales',
            'Hijos' => '0',
            'FechaNacimiento' =>'04/09/2000',
            'Usuario' =>'dan',
            'Clave' => 'dan',
            'Imagen' => 'unnamed.jpg'];

        $_SESSION['usuarios'] = [$usuarios];
    }

    if(isset($_POST['Registrar']))
    {
           //Recogemos el archivo enviado por el formulario
   $archivo = $_FILES['archivo']['name'];
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivo']['type'];
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
     }
     else {
        //Si la imagen es correcta en tamaño y tipo
        //Se intenta subir al servidor
        if (move_uploaded_file($temp, '../images/'.$archivo)) {
            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            chmod('images/'.$archivo, 0777);
            //Mostramos el mensaje de que se ha subido co éxito
            echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
            //Mostramos la imagen subida
            echo '<p><img src="../images/'.$archivo.'"></p>';
            echo $archivo;
        }
        else {
           //Si no se ha podido subir la imagen, mostramos un mensaje de error
           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        }
      }
   }


    if($_SESSION['UsuarioConectado']!=null){
        $usuarios = $_SESSION['UsuarioConectado'];
        $usuarios['Nombre'] = $_POST['txtNombre'];
        $usuarios['Apellido'] = ['txtApellido'];
        $usuarios['Hijos'] = $_POST['txtHijos'];
        $usuarios['FechaNacimiento'] = $_POST['txtFechaNacimiento'];
        $usuarios['Usuario'] = $_POST['txtUsuario'];
        $usuarios['Clave'] = $_POST['txtClave'];
        $usuarios['Imagen'] = $archivo;
        $_SESSION['UsuarioConectado'] = $usuarios;
    }
    else{
        $usuarios =[
            'Nombre' => $_POST['txtNombre'],
            'Apellido' => $_POST['txtApellido'],
            'Hijos' => $_POST['txtHijos'],
            'FechaNacimiento' => $_POST['txtFechaNacimiento'],
            'Usuario' =>$_POST['txtUsuario'],
            'Clave' => $_POST['txtClave'],
            'Imagen' => $archivo];
        array_push($_SESSION['usuarios'],$usuarios);
    }
        
}
    
    
?>
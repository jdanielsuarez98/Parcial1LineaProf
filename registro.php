<?php
    require_once "libs/php/tools_daniel.php";
    require_once "libs/php/db_daniel.php";
    MostrarErrores();
    IniciarSesionSegura();
    LimpiarEntradas();

    //actualizar usuario
    if(isset($_POST['btnActualizar']) )
            {
                    $archivo = $_FILES['archivo']['name'];
                if(isset($archivo) && $archivo != ""){
                    $tipo = $_FILES['archivo']['type'];
                    $tamano = $_FILES['archivo']['size'];
                    $temp = $_FILES['archivo']['tmp_name']; 
    
                    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                        echo '<script>alert("Error. La extensión o el tamaño de los archivos no es correcta")</script>';
                    }
                    else {
                        //Imagen concuerda, Entra
                        if (move_uploaded_file($temp, './uploaded_files/'.$archivo)) {
                            //Permisos
                            $nombre = $_POST['txtNombre'];
                            $apellido = $_POST['txtApellido'];
                            $nacimiento = $_POST['txtNacimiento'];
                            $foto = $archivo;
                            $cantidad_hijos = $_POST['txtCantidadHijos'];
                            $color = ($_POST['colorPicker']);
                            $usuario = $_SESSION['UsuarioConectado'];
                            $CONN=ConexionDB();
                            if ($CONN !=NULL)
                            {
                                ActualizarUsuariosDB($CONN,$usuario,$nombre,$apellido,$nacimiento,$cantidad_hijos,$color,$foto);  
                             
                            }   

                         echo '<script>alert("Usuario Actualizado")</script>';
                         echo '<script>window.location.href="index.php"; </script>';
                        }
                        else {
                            echo '<script>alert("Error. credenciales incorrectas")</script>';
                        }
                    }
                }
                exit();
            }        
    
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //crear ususario
            if(isset($_POST['btnRegistrar']) )
            {
                $archivo = $_FILES['archivo']['name'];
                if(isset($archivo) && $archivo != ""){
                    $tipo = $_FILES['archivo']['type'];
                    $tamano = $_FILES['archivo']['size'];
                    $temp = $_FILES['archivo']['tmp_name']; 
    
                    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                        echo '<script>alert("Error. La extensión o el tamaño de los archivos no es correcta")</script>';
                    }
                    else {
                        //Imagen concuerda, Entra
                        if (move_uploaded_file($temp, './uploaded_files/'.$archivo)) {
                            //Permisos
                            $nombre = $_POST['txtNombre'];
                            $apellido = $_POST['txtApellido'];
                            $nacimiento = $_POST['txtNacimiento'];
                            $foto = $archivo;
                            $cantidad_hijos = $_POST['txtCantidadHijos'];
                            $color = $_POST['colorPicker'];
                            $usuario = $_POST['txtUsuario'];
                            $clave =md5($_POST['txtClave']);
                            
                            $CONN=ConexionDB();
                             if ($CONN !=NULL)
                             {
                                RegistrarUsuarioDB($CONN,$usuario,$clave,$nombre,$apellido,$nacimiento,$cantidad_hijos,$color,$foto); 

                             }   

                            echo '<script>alert("Usuario Registrado")</script>';
                            echo '<script>window.location.href="index.php"; </script>';
                        }
                        else {
                            echo '<script>alert("Error. credenciales incorrectas")</script>';
                        }
                    }
                }
            }
    
?>
<div align="left">
    <?php
        if(isset($_SESSION['UsuarioConectado']))
        {
            $registros=ConexionDB()->query("SELECT `Nombre`, `Apellido`, `FNacimiento`, `Foto`, `Hijos`,`Color` FROM `usuarios`WHERE Usuario='".$_SESSION['UsuarioConectado']."'")->fetchAll(PDO::FETCH_OBJ);
                        foreach($registros as $persona): 
            ?>
            <h3>ACTUALIZATE AQUI!!!</h3><br>
            <form method="post" enctype="multipart/form-data">
                <label for="txtNombre">Ingrese Su Nombre:</label>
                <input type="text" name="txtNombre" id="txtNombre" value="<?php echo $persona->Nombre ?>" required><br><br>

                <label for="txtApellido">Ingrese Su Apellido:</label>
                <input type="text" name="txtApellido" id="txtApellido" value="<?php echo $persona->Apellido ?>" required><br><br>

                <label for="txtNacimiento">Ingrese Su Fecha De Nacimiento:</label>
                <input type="date" name="txtNacimiento" id="txtNacimiento" value="<?php echo $persona->FNacimiento ?>" required><br><br>
                
                <label for="archivo">Foto:</label>
                <input type="file" name="archivo" id="archivo" accept="image/*" value="<?php echo $persona->Foto ?>" requerid/><br><br>

                <label for="colorPicker">Ingrese El Color que desea:</label>
                <input type="color" name="colorPicker" id="colorPicker" value="<?php echo $persona->Color ?>" required><br><br>

                <label for="txtCantidadHijos">Ingrese La cantidad De Hijos:</label>
                <input type="number" name="txtCantidadHijos" id="txtCantidadHijos" value="<?php echo $persona->Hijos ?>" required><br><br>

                <input type="submit" name="btnActualizar" Value="Actualizar">
            </form> 
    <?php 
            endforeach;
        }else{
    ?>
        <h3>REGISTRATE AQUI!!!</h3><br>
        <form method="post" enctype="multipart/form-data">
            <label for="txtNombre">Ingrese Su Nombre:</label>
            <input type="text" name="txtNombre" id="txtNombre" required><br><br>

            <label for="txtApellido">Ingrese Su Apellido:</label>
            <input type="text" name="txtApellido" id="txtApellido" required><br><br>

            <label for="txtNacimiento">Ingrese Su Fecha De Nacimiento:</label>
            <input type="date" name="txtNacimiento" id="txtNacimiento"required><br><br>
            
            <label for="archivo">Foto:</label>
            <input type="file" name="archivo" id="archivo" accept="image/*" requerid/><br><br>

            <label for="colorPicker">Ingrese El Color que desea:</label>
            <input type="color" name="colorPicker" id="colorPicker" required><br><br>

            <label for="txtCantidadHijos">Ingrese La cantidad De Hijos:</label>
            <input type="number" name="txtCantidadHijos" id="txtCantidadHijos" required><br><br>

            <label for="txtUsuario">Ingrese Su Usuario:</label>
            <input type="text" name="txtUsuario" id="txtUsuario" required><br><br>

            <label for="txtClave">Confirme Su Contraseña:</label>
            <input type="password" name="txtClave" id="txtClave"required><br><br><br>

            <input type="submit" name="btnRegistrar" Value="Registrarse">
        </form> 
    <?php
        }   
    ?>
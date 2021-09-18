<?php
    function MostrarErrores(){
        error_reporting(E_ALL);
        INI_SET('display_errors','1');
    }

    function LimpiarCadena($cadena){
        $patron = array('/<script>.*<\/script>/');
        $cadena = preg_replace($patron,'',$cadena);
        $cadena = htmlspecialchars($cadena);
        return $cadena;
    }

    function LimpiarEntradas(){
        if(isset($_POST)){
            foreach($_POST as $key => $value){
                $_POST[$key] = LimpiarCadena($value);
            }
        }
    }

    function IniciarSesionSegura(){
        
        if(ini_set('session.use,only_cookies',1)==FALSE){
            $action = "error";
            $error = "No puedo iniciar una sesion segura";
        }
    
        $cookieParams = session_get_cookie_params();
        $path = $cookieParams["path"];

        $secure = false;    
        $httponly = true;    
        $samesite = 'strict';  

        session_set_cookie_params([
            'lifetime' => $cookieParams["lifetime"],
            'path' => $path,
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => $secure,
            'httponly'=> $httponly,
            'samesite' => $samesite
        ]);
        
        session_start();
        session_regenerate_id(true);
    }
?>
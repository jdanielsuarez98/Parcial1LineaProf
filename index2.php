<?php
    //
    //
    if(ini_set('session.use,only_cookies',1)==FALSE){
        $action = "error";
        $error = "No puedo iniciar una segura(ini_set)";
    }

    $cookieParams = session_get_cookie_params();

    $secure = false;

    $httponly = true;

    $samesite = 'strict';

    $path = "/prueba2/";

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

?>
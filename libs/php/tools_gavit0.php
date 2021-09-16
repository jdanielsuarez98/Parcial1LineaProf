<?php

    //Aqui funcionalidades utilitarias
    //Para usar estaclasee: require_once "libs/php/libreria_gavit0.php"

    //Activa lña presentacion de errores
    function MostrarErrores(){
        error_reporting(E_ALL); //Comentar para no mostrar errores
        ini_set('display_errors','1');  //Comentar para no mostrar errores
    }

    //Limpieza de cadena de texto 
    function LimpiarCadena ($cadena){
        $patron = array('/<script>.*<\/script>/');
        $cadena = preg_replace($patron, '', $cadena);
        $cadena = htmlspecialchars($cadena);
        return $cadena;
    }

    //Limpieza de parametros de entrada
    function LimpiarEntradas(){
        if(isset($_POST)){
            foreach($_POST as $key => $value){
                $_POST[$key] = LimpiarCadena($value);
            }
        }
    }

?>
<?php

include('Cliente/Usuario.php');
require_once 'Persistencia/DB_connection.php';
require_once 'Persistencia/Data.php';
require_once 'SCRAP/liverpool.php';

$recursos_existentes = array('app', 'usuario');
$metodo = strtolower($_SERVER['REQUEST_METHOD']);



switch ($metodo) {
    case 'get':
        // Extraer segmento de la url
        if (isset($_GET['PATH_INFO']))
            $peticion = explode('/', $_GET['PATH_INFO']);
        else
            throw new ExcepcionApi(ESTADO_URL_INCORRECTA, utf8_encode("No se reconoce la petición"));
        //var_dump($peticion);
        // Obtener recurso
        $recurso = array_shift($peticion);
        

        // Comprobar si existe el recurso
        
        
        switch ($recurso) {
            case "app":
                echo "i es una manzana";
                break;
            case "usuario":
                Usuario::ejecutar($peticion);
                break;
            default :
                echo "i es un pastel";
                break;
        }
        //print $_GET['PATH_INFO'];
        break;

    case 'post':
//        var_dump($_POST['PATH_INFO']);
//        echo 'd';
//        var_dump($_GET['PATH_INFO']);
//        
        $peticion = explode('/', $_GET['PATH_INFO']);
       // var_dump($peticion);
        
        if (isset($_GET['PATH_INFO']))
            $peticion = explode('/', $_GET['PATH_INFO']);
        else
            throw new ExcepcionApi(ESTADO_URL_INCORRECTA, utf8_encode("No se reconoce la petición"));
        //var_dump($peticion);
        // Obtener recurso
        $recurso = array_shift($peticion);
        

        // Comprobar si existe el recurso
        
        
        switch ($recurso) {
            case "app":
                echo "i es una manzana";
                break;
            case "usuario":
                //call_user_func(array($recurso, $metodo), $peticion);
                Usuario::ejecutar($peticion);
                break;
            default :
                echo "i es un pastel";
                break;
        }
        // Procesar método post
        break;
    
    case 'put':
        // Procesar método put
        break;

    case 'delete':
        // Procesar método delete
        break;
    default:
        // Método no aceptado
}

<?php

include('Utility/Respuesta.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Zeus Ogarrio
 */
class Usuario extends Respuesta{
    
    public static function ejecutar($peticion)
    {
        switch ($peticion[0]) {
            case "getSource":
                (new self)->getSource();
                //self::login();
                break;
            case "getProductos":
                (new self)->getProductos();
                //self::login();
                break;
            default :
                echo "i es un pastel";
                break;
        }
        if ($peticion[0] == 'registro') {
            return self::registrar();
        } else if ($peticion[0] == 'login') {
            return self::loguear();
        } else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }
    
     public static function post($peticion)
    {
        if ($peticion[0] == 'registro') {
            return self::registrar();
        } else if ($peticion[0] == 'login') {
            return self::login();
        } else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }
    
    
    
    private function getSource() {
        $aux;
        $respuesta = array();
        $objLiverpool = new liverpool();
        $objectData = new Data();
       
        //Obtiene informacion de celulares 
       $aux  = $objLiverpool->scraping("https://www.liverpool.com.mx/tienda/samsung/cat4720042", "celular");
       $objectData->saveSource($aux);
       
       // Obtiene informacion de salas
       $aux2  = $objLiverpool->scraping("https://www.liverpool.com.mx/tienda/sof%C3%A1s-y-modulares/catst7612018", "sala");
       $objectData->saveSource($aux2);
       
       
       
       
        http_response_code(200);
        $this->estado = 1;
        
        $respuesta['estado'] = 'true';
       
        $respuesta =json_encode($respuesta);
        
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($respuesta);
        exit;
        
        return true;
        
    }
    


private function getProductos() {
        
        $respuesta = array();
        $objectData = new Data();
       
        // Recupera los productos desde la base de datos
       
        $respuesta = $objectData->getProductos();
       
       
       
       
        http_response_code(200);
        $this->estado = 1;
        
       
        $respuesta =json_encode($respuesta);
        
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($respuesta);
        exit;
        
        return true;
        
    }    
   
    
    
    
}


class mensaje{
   var $cabecera;
   var $cuerpo;
   var $status;
   var $profile;
   var $ID_USUARIO;
   var $ID_SESSION;
   var $estado;
   var $delegacion;
   //var $aux;
   
}




<?php

require_once("xml2json.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Respuesta
 *
 * @author Zeus Ogarrio
 */
class Respuesta {
    // Código de error
    public $estado;
    
    public function __construct($estado = 400)
    {
        $this->estado = $estado;
    }
    
    public function responderJSON($cuerpo)
    {
        
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($cuerpo, JSON_PRETTY_PRINT);
        exit;
    }
    
    public function responderXML($cuerpo)
    {
       

        header('Content-Type: text/xml');

        $xml = new SimpleXMLElement('<respuesta/>');
        self::parsearArreglo($cuerpo, $xml);
        print $xml->asXML();

        exit;
    }
    
    public function responderDirectXML($cuerpo)
    {
       

        header('Content-Type: text/xml');
        
        print $cuerpo;

        exit;
    }
    
    public function responderJSONfromXML($cuerpo)
    {
       header('Content-Type: application/json; charset=utf8');
       
       $jsonContents =  simplexml_load_string($cuerpo);
        echo json_encode($jsonContents, JSON_PRETTY_PRINT);
        exit;
    }
    
     public function parsearArreglo($data, &$xml_data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = 'item' . $key;
                }
                $subnode = $xml_data->addChild($key);
                self::parsearArreglo($value, $subnode);
            } else {
                $xml_data->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}

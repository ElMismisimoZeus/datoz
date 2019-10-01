<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'SCRAP.php';
/**
 * Description of liverpool
 *
 * @author Zeus Ogarrio
 */
class liverpool extends SCRAP{

    public $articulos;
    
    public function scraping($url,$articuloN){
        $articulos= array();


        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $html = curl_exec($ch);
        curl_close($ch);

        $dom = new DOMDocument();

        @$dom->loadHTML($html);

        $articulo;
        foreach($dom->getElementsByTagName('figure') as $link) {


            foreach($link->getElementsByTagName('figcaption') as $part){
                $articulo = array();
                 $aux = $part->getElementsByTagName('article');
                $articulo['nombre']= $articuloN;
                $articulo['descripcion']=$aux->item(0)->textContent;
                
                $auxP = $part->getElementsByTagName('p');
               
                if(sizeof($auxP->item)>0){
                    $articulo['precio']= $this->priceToFloat( $auxP->item(1)->textContent);
                }else{
                    $articulo['precio']= $this->priceToFloat( $auxP->item(0)->textContent);
                }

                // agregarlo al array
                $articulos[] =$articulo;
            }
        }

        return $articulos;
    }
        
}

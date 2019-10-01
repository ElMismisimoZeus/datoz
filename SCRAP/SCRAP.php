<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SCRAP
 *
 * @author Zeus Ogarrio
 */
abstract class  SCRAP {
    
    public abstract function scraping($url,$articulo);
    
    public function priceToFloat($s)
    {

        // remove everything except numbers and dot "."
        $s = preg_replace("/[^0-9\.]/", "", $s);

        // return float
        return (float) $s;
    }
}

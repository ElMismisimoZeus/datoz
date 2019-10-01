<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Data {
    
    function saveSource($data){
        $respuesta;
        
        
        $config = parse_ini_file('config/config.ini');
        $con = mysqli_connect($config['localhost'], $config['username'], $config['password'], $config['dbname']) or die ("Could not connect: " . mysqli_error());
        
        
        foreach($data as $row){
            $result = mysqli_query($con, "select * from PRODUCTO where DESCRIPCION='".$row['descripcion']."'");
            $rowsR = mysqli_fetch_assoc($result);
            if(sizeof($rowsR)==0){

                $query = "INSERT INTO PRODUCTO(NOMBRE, DESCRIPCION, PRECIO) VALUES('".$row['nombre'] ."','".$row['descripcion']."','".$row['precio']."' )";

                if(!mysqli_query($con, $query)) {
                    $estado_commit['scrap']='false';
                     echo $query;
                     echo mysqli_error($con);
                } else {
                    $estado_commit['acrap']='true';
                }
            }
        }
        
        
        

        return $respuesta;
    }
    
    
    
    function getProductos(){
        
        $datos= array();
        $config = parse_ini_file('config/config.ini');
        $con = mysqli_connect($config['localhost'], $config['username'], $config['password'], $config['dbname']) or die ("Could not connect: " . mysqli_error());
        
        
        $result = mysqli_query($con, "select * from PRODUCTO ");
        //var_dump($result);
        while ($fila = $result->fetch_assoc()) {
            $datos[]=$fila;
        }
        //$rowsR = mysqli_fetch_assoc($result);
        //var_dump($rowsR);
        

        return $datos;
    }
}
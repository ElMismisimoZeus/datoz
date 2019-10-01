<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB_connection
 *
 * @author mJuarez
 */
class DB_connection {
    //put your code here
    protected static $connection;
		
	//Crea una conexion a la bdatos	
	public function connect() {
		
		if(!isset(self::$connection)) {
			$config = parse_ini_file('config/config.ini');
			self::$connection = new mysqli($config['localhost'], $config['username'], $config['password'], $config['dbname']);
                        self::$connection->set_charset("utf8");
		}

		if(self::$connection === false ) {
			return false;
		} else {
                    return self::$connection;
                       // return true;
		}

		return self::$connection;
	}
        
       public function insertar($sql){
            $respuesta;
           
            $config = parse_ini_file('config/config.ini');
            $con = mysqli_connect($config['localhost'], $config['username'], $config['password'],$config['dbname']) or die ("Could not connect: " . mysql_error());
            
            
                if (!mysqli_query($con, $sql)) {
                    // gestion del error
                    // =====================    
                    //header('Content-Type: application/json');
                    //echo json_encode(array('id' => 0, 'repuesta' =>$sql, 'detalle' => mysql_error()));
                    $respuesta = array("idData" => 0, "estatus" =>'fail', "mensage" => 'error al insertar', "detalles" => mysql_error());

                } else {
                    $last_id = mysqli_insert_id($con);
                    //header('Content-Type: application/json');
                    $respuesta = array("idData" => $last_id, "estatus" =>"ok", "mensage" => 'correcto');
                }
                
            mysqli_close($con);
            
            return $respuesta;
       }

	//Query a la base de datos
	public function query($query) {
        
                $connection = $this -> connect();
                $result = $connection -> query($query);

                return $result;
        }

	//Consultas a la base de datos
	public function select($query) {
		$rows = array();
                $result = $this -> query($query);
                
                if($result === false) {
                        return false;
                }
                while ($row = $result -> fetch_assoc()) {
                        $rows[] = $row;
                }
                return $rows;
        }
        
        //Devolvemos los errores
        public function error() {
            $connection = $this -> connect();
            return $connection -> error;
        }

	public function quote($value) {
                $connection = $this -> connect();
                return "'" . $connection -> real_escape_string($value) . "'";
        }
}

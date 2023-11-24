<?php

class conexion{
    private $servidor="localhost";
    private $usuario="root";
    private $password="";
    private $db="viajerodb";
    private $con;
    private $msj;

    public function __construct(){
        try{
            $this->con = new PDO("mysql:host=$this->servidor;dbname=$this->db", $this->usuario, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            return "Error de conexion " . $e;
        }
        
    }
    public function probar($query){
        $this->con->exec($query);
        return $this->con->lastInsertId();
    }
    public function consulta($query){
        $sentencia = $this->con->prepare($query);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

}
?>

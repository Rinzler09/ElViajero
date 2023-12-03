<?php

class conexion{

    private $servidor="34.125.240.38";
    private $usuario="admin";
    private $password="Temporal1";
    private $db="viajerodb";
    private $con;
    private $msj;

    public function __construct(){
        try{
            $this->con = new PDO("mysql:host=$this->servidor;dbname=$this->db",$this->usuario,$this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            return "Error de conexion " . $e;
        }
    }

    public function probar($query){
        try {
            $this->con->exec($query);            
            return $this->con->lastInsertId();
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
    }
    
    public function consulta($query){
        $sentencia = $this->con->prepare($query);   
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
    
}

?>

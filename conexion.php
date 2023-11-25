<?php

class conexion{
    private $servidor="elviajero.ddns.net";
    private $usuario="admin";
    private $password="Temporal1";
    private $db="viajerodb";
    private $con;
    private $msj;

    public function __construct(){
        try{
            $this->con = new PDO("mysql:host=$this->servidor;dbname=$this->db", $this->usuario, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
           /*  return "Error de conexion " . $e; */
           throw new Exception("Error de conexion: " . $e->getMessage());
        }
        
    }
    public function probar($query){
        try {
            $this->con->exec($query);
            return $this->con->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Error al ejecutar consulta: " . $e->getMessage());
        }
        /* $this->con->exec($query);
        return $this->con->lastInsertId(); */
    }
    public function consulta($query){
        try {
            $sentencia = $this->con->prepare($query);
            $sentencia->execute();
            return $sentencia->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al realizar consulta: " . $e->getMessage());
        }
        /* $sentencia = $this->con->prepare($query);
        $sentencia->execute();
        return $sentencia->fetchAll(); */
    }

}
?>

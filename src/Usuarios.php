<?php
namespace Fct;

use Fct\Conexion;
use PDO;
use PDOException;

class Usuarios extends Conexion {
    private $id;
    private $nombre;
    private $email;
    private $password;

    public function __construct()
    {
        parent::__construct();
    }

    //un único usuario

    public function crearUser(){
        if($this->hayUsers()){
            return;
        }

        //solo crea un usuario, que será el admin
        
        $nombre="Francisco Ruiz";
        $email="f.ruizortega@outlook.es";
        $password="secret0";
        (new Usuarios)
        ->setNombre($nombre)
        ->setEmail($email)
        ->setPassword($password)
        ->create();
    
        
    
    }

    private function hayUsers(){
        $q="select * from users";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al comprobar si hay autos: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return ($stmt->rowCount());
    }

    public function create(){
        $q="INSERT INTO 
            users (nombre,email,password) 
            values(:n,:e,:p)";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':e'=>$this->email,
                ':p'=>$this->password,
                
            ]);
        }
        catch(PDOException $ex){
            die('Error al crear Usuarios: '.$ex->getMessage());
        }
        parent::$conexion=null;
    
    }

    public function readAllUsuarios(){
        $q="select * from users";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al leer todos los datos de users: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
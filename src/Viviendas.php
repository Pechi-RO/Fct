<?php
namespace Fct;

use Fct\Conexion;
use Faker\Factory;
use PDO;
use PDOException;

class Viviendas extends Conexion {
    private $id;
    private $nombre;
    private $descripcion;
    private $info;
    private $estado;
    private $tipo;
    
    public function __construct()
    {
        parent::__construct();
    }

    //faker
    public function crearViviendas(){
        if($this->hayViviendas()){
            return;
        }

        $faker=Factory::create('es_ES');
        $array_estado=['en venta','vendida','arras'];
        $array_tipo=['vivienda','local','terreno'];

        $nombre=$faker->name();
        $descripcion=$faker->text();
        $info=$faker->text();
        $estado=$faker->randomElement($array_estado,1);
        $tipo=$faker->randomElement($array_tipo,1);

        (new Viviendas)
        ->setNombre($nombre)
        ->setDescripcion($descripcion)
        ->setInfo($info)
        ->setEstado($estado)
        ->setTipo($tipo)
        ->create();
    
        
    
    }

    private function hayViviendas(){
        $q="select * from viviendas";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al comprobar si hay viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return ($stmt->rowCount());
    }

    public function create(){
        $q="INSERT INTO 
            Viviendas (nombre,descripcion,info,estado,tipo) 
            values(:n,:d,:i,:e,:t)";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':d'=>$this->descripcion,
                ':i'=>$this->info,
                ':e'=>$this->estado,
                ':t'=>$this->tipo,               
            ]);
        }
        catch(PDOException $ex){
            die('Error al crear Viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
    
    }
    public function read($id){
            $q="select *
                from viviendas
                WHERE id=:i
                ";
            $stmt=parent::$conexion->prepare($q);
            try{
                $stmt->execute([
                    ":i"=>$id
                ]);
            }
            catch(PDOException $ex){
                die('Error al leer todos los datos de la vivienda '.$id.': '.$ex->getMessage());
            }
            parent::$conexion=null;
            return $stmt;
        
    }

    public function readAllViviendas(){
        $q="select * from viviendas";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al leer todos los datos de viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of info
     */ 
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set the value of info
     *
     * @return  self
     */ 
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }
}
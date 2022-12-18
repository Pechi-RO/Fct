<?php
namespace Fct;

use Fct\Conexion;
use Faker\Factory;
use PDO;
use PDOException;
use Fct\Viviendas;

class Imagenes extends Conexion {
    private $id;
    private $nombre;
    private $vivienda_id;
    private $orden;
    private $dir;
    
    public function __construct()
    {
        parent::__construct();
    }

    //faker
    
    public function crearImagenes(){
        
        if($this->hayImagenes()){
            return;
        }
        
        $faker=Factory::create('es_ES');
        
        $todasViviendas=(new Viviendas)->readAllViviendas();
        $actual_link = "http://$_SERVER[HTTP_HOST]/mi_php/FCT";

        
        foreach($todasViviendas as $item){
            for($i=0;$i<3;$i++){
                 $vivienda_id=$item->id;
            //$nombre=$faker->image($actual_link."img/vivendas", 640, 480, null, false);
            //no creamos $dir con faker
            $nombre=$faker->imageUrl();
            $orden=$faker->numberBetween(0,10);
            (new Imagenes)
            ->setNombre($nombre)
            ->setVivienda_id($vivienda_id)
            ->setOrden($orden)
            ->create();
            }
        }
        
    }
    public function isImagen($tipo){

        $tiposBuenos=[
            'image/jpeg',
            'image/bmp',
            'image/png',
            'image/webp',
            'image/gif',
            'image/svg-xml',
            'image/x-icon'
        ];
        return in_array($tipo, $tiposBuenos);
    }

    private function hayImagenes(){
        $q="select * from imagenes";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al comprobar si hay imagenes: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return ($stmt->rowCount());
    }

    public function readAllImagenes(){
        $q="select * from imagenes ORDER BY vivienda_id DESC,orden ASC";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al leer todos los datos de imagenes: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(){
        $q="INSERT INTO 
            imagenes (nombre,vivienda_id,orden,dir) 
            values(:n,:v_id,:o,:d)";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':v_id'=>$this->vivienda_id,
                ':o'=>$this->orden,
                ':d'=>$this->dir,
            ]);
        }
        catch(PDOException $ex){
            die('Error al crear Imagenes: '.$ex->getMessage());
        }
        parent::$conexion=null;
    
    }



    public function read($id){
        $q="select *,
        (SELECT MAX(orden) FROM imagenes where vivienda_id=:i) as max
            from imagenes
            WHERE vivienda_id=:i
            ORDER BY orden ASC
            ";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ":i"=>$id
            ]);
        }
        catch(PDOException $ex){
            die('Error al leer todos las imagenes de la vivienda '.$id.': '.$ex->getMessage());
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
     * Get the value of vivienda_id
     */ 
    public function getVivienda_id()
    {
        return $this->vivienda_id;
    }

    /**
     * Set the value of vivienda_id
     *
     * @return  self
     */ 
    public function setVivienda_id($vivienda_id)
    {
        $this->vivienda_id = $vivienda_id;

        return $this;
    }

    /**
     * Get the value of orden
     */ 
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set the value of orden
     *
     * @return  self
     */ 
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get the value of dir
     */ 
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Set the value of dir
     *
     * @return  self
     */ 
    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    }
}
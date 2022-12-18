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
    private $zona;
    private $precio;


    
    public function __construct()
    {
        parent::__construct();
    }

    //faker
    public function crearViviendas(){
        if($this->hayViviendas()){
            return;
        }

        for($i=0;$i<50;$i++){
             $faker=Factory::create('es_ES');
        $array_estado=['en venta','vendida','arras'];
        $array_tipo=['vivienda','local','terreno'];
        $array_zona=['Villaines','Huercal','Centro','Pescaderia','Afueras'];

        $nombre=$faker->name();
        $descripcion=$faker->text();
        $info=$faker->text();
        $estado=$faker->randomElement($array_estado,1);
        $tipo=$faker->randomElement($array_tipo,1);
        $zona=$faker->randomElement($array_zona,1);
        $precio=$faker->numberBetween(40000,300000);


        (new Viviendas)
        ->setNombre($nombre)
        ->setDescripcion($descripcion)
        ->setInfo($info)
        ->setEstado($estado)
        ->setTipo($tipo)
        ->setZona($zona)
        ->setPrecio($precio)
        ->create();
        }

       
    
        
    
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

    public function getTipos(){
        $q="SELECT DISTINCT tipo from viviendas";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al leer todos los tipos de viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getZonas(){
        $q="SELECT DISTINCT zona from viviendas";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al leer todos las zonas de viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countZonas($array){
        //echo "<pre>zonas";var_dump($array);echo "</pre>";
        $q="SELECT";
        foreach($array as $k=>$v){
            if($k==count($array)-1){
                $q.="(SELECT COUNT(zona) FROM viviendas WHERE viviendas.zona='{$v['zona']}' ) as cuenta_{$k}";
            }else{
                $q.="(SELECT COUNT(zona) FROM viviendas WHERE viviendas.zona='{$v['zona']}' ) as cuenta_{$k},";

            }

        }
        //echo $q;
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al contar las zonas de viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEstados(){
        $q="SELECT DISTINCT estado from viviendas";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al leer todos los estados de viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create(){
        $q="INSERT INTO 
            viviendas (nombre,descripcion,info,estado,tipo,zona,precio) 
            values(:n,:d,:i,:e,:t,:z,:p)";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':d'=>$this->descripcion,
                ':i'=>$this->info,
                ':e'=>$this->estado,
                ':t'=>$this->tipo,            
                ':z'=>$this->zona,               
                ':p'=>$this->precio,               
   
            ]);
        }
        catch(PDOException $ex){
            die('Error al crear Viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
    
    }
    public function selectLastId(){
        $q="SELECT id FROM viviendas ORDER BY id DESC LIMIT 1";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }
        catch(PDOException $ex){
            die('Error al devolver la ultima id creada de viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetch();
    
    }
    public function update($id){
        $q="UPDATE viviendas SET
        nombre=:n,
        descripcion=:d,
        info=:i,
        estado=:e,
        tipo=:t,
        zona=:z,
        precio=:p 
        WHERE id=:id 
         ";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':d'=>$this->descripcion,
                ':i'=>$this->info,
                ':e'=>$this->estado,
                ':t'=>$this->tipo,            
                ':z'=>$this->zona,               
                ':p'=>$this->precio, 
                ':id'=>$id              
   
            ]);
        }
        catch(PDOException $ex){
            die('Error al actualizar Viviendas: '.$ex->getMessage());
        }
        parent::$conexion=null;
    }

    public function delete($id){
        $q="DELETE FROM viviendas
            WHERE id=:i
            ";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id,
            ]);
        }
        catch(PDOException $ex){
            die('Error al borrar Viviendas: '.$ex->getMessage());
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

    public function readAllViviendas($filtros=null){
        if($filtros==NULL){
            $q="select * from viviendas";

        }else{
            $where="";
            if(isset($filtros['buscador']) && $filtros['buscador']!=""){
                $where.="(viviendas.nombre LIKE '%{$filtros['buscador']}%') AND";
            }
            if(isset($filtros['filtro']) && $_GET['filtro']!="" && $_GET['filtro']!="todos" ){
                $where.=" (viviendas.tipo = '{$filtros['filtro']}') AND";
            }

            if((isset($filtros['rango']) && $filtros['rango']!="") && (isset($filtros['max']) && $filtros['max']!="")){
                $where.=" (viviendas.precio BETWEEN {$filtros['rango']} AND {$filtros['max']}) AND";
            }else if(!isset($filtros['rango']) && (isset($filtros['min']) && $filtros['min']!="") && (isset($filtros['max']) && $filtros['max']!="")){
                $where.=" (viviendas.precio BETWEEN {$filtros['min']} AND {$filtros['max']}) AND";
            }elseif(
                (
                    isset($filtros['rango']) && $filtros['rango']!=""
                    ) || 
                    isset($filtros['min']) && 
                    (
                        isset($filtros['min']) && $filtros['min']!=""
                    ) && 
                    !isset($filtros['max']
                )){

                if(isset($filtros['rango'])){
                    $where.=" (viviendas.precio BETWEEN {$filtros['rango']} AND 999999) AND";
                }else if(isset($filtros['min'])){
                    $where.=" (viviendas.precio BETWEEN {$filtros['min']} AND 999999) AND";
                }

            }

            
                $q="select * from viviendas
                WHERE 1=1
                AND
                {$where}
                1=1
                ORDER BY precio ASC,nombre ASC
                ";
        }
        //echo "<pre>";echo $q;echo "</pre>";
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

    /**
     * Get the value of zona
     */ 
    public function getZona()
    {
        return $this->zona;
    }

    /**
     * Set the value of zona
     *
     * @return  self
     */ 
    public function setZona($zona)
    {
        $this->zona = $zona;

        return $this;
    }

  
}
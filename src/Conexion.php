<?php
namespace Fct;

use PDO;
use PDOException;

class Conexion{
    protected static $conexion;
    public function __construct()
    {
        if(self::$conexion==null) self::CrearConexion();
    }


    private static function crearConexion(){
        $fichero=dirname(__DIR__,1)."/.config";
        $parametros=parse_ini_file($fichero);
        $host=$parametros['host'];
        $user=$parametros['user'];
        $pass=$parametros['pass'];
        $bbdd=$parametros['bbdd'];

        //$host="localhost";
        //$user="usznyczd71ox0";
        //$pass="usuario95";
        //$bbdd="dbfd3v5gcuci9y";



        $dns="mysql:host=$host;dbname=$bbdd;charset=utf8mb4";
        try{
            $option=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
            self::$conexion=new PDO($dns,$user,$pass,$option);
        }
        catch(PDOException $ex){
            die('Error al conectar con la base de datos:'.$ex->getMessage());
        }

        
    }
}
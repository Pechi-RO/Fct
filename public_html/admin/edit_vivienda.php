<?php
session_start();
require dirname(__DIR__,2)."/vendor/autoload.php";

use Fct\Viviendas;
use Fct\Imagenes;


//echo "<pre>vivienda: ";var_dump($vivienda->fetch(PDO::FETCH_OBJ));echo "</pre>";
//echo "<pre>imagenes: ";var_dump($imagenes);echo "</pre>";
//die();
//var_dump($_POST);
$error=false;
$url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    
  
//echo $url;  
//echo "<pre>files".var_dump($_FILES)."</pre>";
if(isset($_GET['id'])){
    $vivienda=(new Viviendas)->read($_GET['id']);
    $item=$vivienda->fetch(PDO::FETCH_OBJ);
}else if(isset($_POST['id'])){
    $vivienda=(new Viviendas)->read($_POST['id']);
    $item=$vivienda->fetch(PDO::FETCH_OBJ);
}
else{
    die('ola');
    header("Location:index.php");
}

if(isset($_POST['nombre'])){
$viviendas=(new Viviendas)->readAllViviendas();
foreach($viviendas as $item){
    if($item->nombre==$_POST['nombre']){
        $error=true;
        $_SESSION['error']="Nombre duplicado, no se creó la entrada";
    }
}

//update
if(!$error){
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else if(isset($_POST['id'])){
        $id=$_POST['id'];
    }
    (new Viviendas)
    ->setNombre($_POST['nombre'])
    ->setDescripcion($_POST['descripcion'])
    ->setInfo($_POST['info'])
    ->setEstado($_POST['estado'])
    ->setTipo($_POST['tipo'])
    ->setZona($_POST['zona'])
    ->setPrecio($_POST['precio'])
    ->update($id);
    $_SESSION['mensaje_V']="Vivienda actualizada con éxito";


    
      //comprobamos imagen
            //1.- veo si he subido o no una imagen
            if(isset($_FILES)){
                $imgs=(new Imagenes)->read($id);

                for($i=0;$i<count($_FILES['imagen']['name']);$i++){
                    if(is_uploaded_file($_FILES['imagen']['tmp_name'][$i])){
                                //he subido un fichero
                                if((new Imagenes)->isImagen($_FILES['imagen']['type'][$i])){
                                    $nombre="".uniqid().$_FILES['imagen']['name'][$i];
                                    //he subido la imagen
                                    $imagen=new Imagenes;
                                    $imagen->setNombre($nombre);
                                    $imagen->setVivienda_id($id);
                                    if(count($imgs)!=0){
                                    $imagen->setOrden($i+count($imgs));
                                    }else{
                                        $imagen->setOrden($i);
                                    }
                                    $imagen->setDir('http://localhost/mi_php/FCT/public_html/img/viviendas/');
                                    
                                    if(move_uploaded_file($_FILES['imagen']['tmp_name'][$i],"http://localhost/mi_php/FCT/public_html/img/viviendas/".$nombre)){
                                        //todo bien
                                        $imagen->create();
                                    }else{
                                        $error=true;
                                        $_SESSION['error']="contacte con al admin.Error:<br>".$_FILES['imagen']['error'][$i];
                                    }
            
                                }else{
                                    //Lo que he subido NO es una imagen
                                    $error=true;
                                    $_SESSION['error']="El fichero no es una imagen";
                                }
            
                            }else{
                                //no se han subido imagenes
            
                                
                            }
                    }
            
            }
}
        $_SESSION['mensaje']="Vivienda actualizda con éxito";
        header('Location:index.php');
           
}




?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Editar viviendas</title>
        <link rel="icon" type="image/x-icon" href="../favicon.ico">

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

        <style>

      

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #introCarousel {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
      
        </style>
        

    </head>
    <body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php
    require "./layouts/navbar.php";
    ?>

<div class="container" style="margin-top: 5rem;">

<?php
    if(isset($_SESSION['error'])){
        ?>
        <div class="alert alert-danger" role="alert">
          <?= $_SESSION['error'];?>
        </div>
        <?php
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['mensaje'])){
        ?>
        <div class="alert alert-success" role="alert">
          <?= $_SESSION['mensaje'];?>
        </div>
        <?php
        unset($_SESSION['mensaje']);
    }
    if(isset($_SESSION['mensaje_V'])){
        ?>
        <div class="alert alert-success" role="alert">
          <?= $_SESSION['mensaje_V'];?>
        </div>
        <?php
        unset($_SESSION['mensaje_V']);
    }
    ?>

<h4 class="mb-5"><strong>Actualizar viviendas</strong></h4>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $_GET['id']?>">

    <div class="card">
        <div class="card-body ">
            <h3 class="card-title col-lg-5 col-md-5 col-sm-6">
                <label for="nombre">Nombre</label>
            <input name="nombre" id="nombre" class="form-control" required value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];}else{echo $item->nombre;}?>">
            </input>
            </h3>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">

                <input type="file" onchange="previewMultiple(event)" name="imagen[]"  accept="image/*" id="image" multiple>

                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h4 class="box-title mt-5">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" ><?php if(isset($_POST['descripcion'])){echo $_POST['descripcion'];}else{echo $item->descripcion;}?></textarea>
                    </h4>
                    
                    
                    <h2 class="mt-5">
                    <label for="precio">Precio</label>
                    <input class="form-control" name="precio" id="precio" type="number" required value="<?php if(isset($_POST['precio'])){echo $_POST['precio'];}else{echo $item->precio;}?>"></input>
                    </h2>
                    
                    
                    <h3 class="box-title mt-5">Características</h3>
                    <ul class="list-unstyled">
                        <li>
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="">-</option>
                        <?php
                        $estados=(new Viviendas)->getEstados();
                        foreach ($estados as $v){
                            if(isset($_POST['estado']) && $_POST['estado']==$v['estado']){
                                ?>
                                <option selected value="<?= $v['estado'];?>"><?=$v['estado'];?></option>
                                <?php
                            }else if(isset($_GET['id']) && $item->estado==$v['estado']){
                                ?>
                                <option selected value="<?= $v['estado'];?>"><?=$v['estado'];?></option>
                                <?php

                            }else{
                                  ?>
                         <option value="<?= $v['estado'];?>"><?=$v['estado'];?></option>
                            <?php
                            }                        
                        }
                        ?>    
                        
                        </select>
                        </li>
                        <li>
                            <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control" required>
                        <option value="">-</option>

                        <?php
                        $tipos=(new Viviendas)->getTipos();
                        foreach ($tipos as $v){
                            if(isset($_POST['tipo']) && $_POST['tipo']==$v['tipo']){
                                ?>
                                <option selected value="<?= $v['tipo'];?>"><?=$v['tipo'];?></option>
                                <?php
                            }else if(isset($_GET['id']) && $item->tipo==$v['tipo']){
                                ?>
                                <option selected value="<?= $v['tipo'];?>"><?=$v['tipo'];?></option>
                                <?php

                            }else{
                                  ?>
                         <option value="<?= $v['tipo'];?>"><?=$v['tipo'];?></option>
                            <?php
                            }     

                        }
                        ?>    
                        
                        </select>
                    </li>
                    <li>
                            <label for="zona">Zona</label>
                        <select name="zona" id="zona" class="form-control" required>
                        <option value="">-</option>

                        <?php
                        $zonas=(new Viviendas)->getZonas();
                        foreach ($zonas as $v){
                            if(isset($_POST['zona']) && $_POST['zona']==$v['zona']){
                                ?>
                                <option selected value="<?= $v['zona'];?>"><?=$v['zona'];?></option>
                                <?php
                            }else if(isset($_GET['id']) && $item->zona==$v['zona']){
                                ?>
                                <option selected value="<?= $v['zona'];?>"><?=$v['zona'];?></option>
                                <?php

                            }else{
                                  ?>
                         <option value="<?= $v['zona'];?>"><?=$v['zona'];?></option>
                            <?php
                            }     

                        }
                        ?>    
                        
                        </select>
                    </li>
                    </ul>
                </div>
                <h4 class="box-title mt-5">
                    <label for="info">Información adicional</label>
                    <textarea name="info" id="info" class="form-control" ><?php if(isset($_POST['info'])){echo $_POST['info'];}else{echo $item->info;}?></textarea>
                    </h4>
                <div class="col-lg-12 col-md-12 col-sm-12">

  <!-- Section: Images -->
  <section class="">
    <div class="row gallery" id="gallery">
        <?php
        $arrayImagenes=(new Imagenes)->read($item->id);
        foreach($arrayImagenes as $v){
            ?>
            <div class="col-lg-4 col-md-12 mb-2 mb-lg-0 hide" style="margin-bottom: 0.5rem;">
                <a href='<?php if(isset($v['dir']))echo "../img/viviendas/{$v['nombre']}"; else{echo $v['nombre'];}?>' download>
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?php if(isset($v['dir']))echo "../img/viviendas/{$v['nombre']}"; else{echo $v['nombre'];}?>" alt="Card image cap" name="img[]">
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
            
    </div>
    <button class=" " type="submit" style="
            background-image: linear-gradient(#6d8aaa, #3f658f 50%, #3a5d84);
    filter: none;
    border: 1px solid #325172;
    --bs-btn-padding-x: 0.75rem;
    --bs-btn-padding-y: 0.375rem;
    --bs-btn-font-family: ;
    --bs-btn-font-size: 1rem;
    --bs-btn-font-weight: 400;
    --bs-btn-line-height: 1.5;
    --bs-btn-color: #777;
    --bs-btn-bg: transparent;
    --bs-btn-border-width: 1px;
    --bs-btn-border-color: transparent;
    --bs-btn-border-radius: 0.375rem;
    --bs-btn-hover-border-color: transparent;
    --bs-btn-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.075);
    --bs-btn-disabled-opacity: 0.65;
    --bs-btn-focus-box-shadow: 0 0 0 0.25rem rgba(var(--bs-btn-focus-shadow-rgb), .5);
    display: inline-block;
    padding: var(--bs-btn-padding-y) var(--bs-btn-padding-x);
    font-family: var(--bs-btn-font-family);
    font-size: var(--bs-btn-font-size);
    font-weight: var(--bs-btn-font-weight);
    line-height: var(--bs-btn-line-height);
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    border: var(--bs-btn-border-width) solid var(--bs-btn-border-color);
    border-radius: var(--bs-btn-border-radius);
    background-color: var(--bs-btn-bg);
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    ">Actualizar</button>

    </form>
  </section>
  <!-- Section: Images -->
                </div>
            </div>
        </div>
    </div>
</div>

 <script>

    function previewMultiple(event){
        let hide=document.getElementsByClassName('hide')
        for(let i=0;i<hide.length;i++){
            hide[i].style.display="none"
        }
        var saida = document.getElementById("image");
        var quantos = saida.files.length;
        for(i = 0; i < quantos; i++){
            var urls = URL.createObjectURL(event.target.files[i]);
            document.getElementById("gallery").innerHTML +='<div class="col-lg-4 col-md-12 mb-2 mb-lg-0 hide" style="margin-bottom: 0.5rem;"><a href='+urls+' download><div class="card" style="width: 18rem;"><img class="card-img-top" src="'+urls+'" alt="Card image cap" name="img[]"></div></a></div>'

        }
    }
    </script>
<script type="text/javascript" src="../js/mdb.min.js"></script>

    </body>
</html>
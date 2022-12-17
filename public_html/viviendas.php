<?php
require dirname(__DIR__,1)."/vendor/autoload.php";

//echo __DIR__;

use Fct\Viviendas;
use Fct\Imagenes;

$cur_page="viviendas";
//echo "<pre>";var_dump($_GET);echo "</pre>";

if(isset($_GET)){
  $viviendas=(new Viviendas)->readAllViviendas($_GET);
}else{
  $viviendas=(new Viviendas)->readAllViviendas();

}
$imagenes=(new Imagenes)->readAllImagenes();
//echo $imagenes[0]['vivienda_id'];
//die();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/style.css" />

</head>
<body>

      <!--Main Navigation-->
  <header>
    <style>
      /* Carousel styling */
      #introCarousel,
      .carousel-inner,
      .carousel-item,
      .carousel-item.active {
        height: 100vh;
      }


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

    <!-- Navbar -->
    <?php
    require "./layouts/navbar.php";
    ?>
    <!-- Navbar -->
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/style.css" />

<style>
  .custom-control{
    position: relative;
    display: flex;
    min-height: 1.5rem;
    padding-left: 1.5rem;
  }
  .custom-control-input{
    margin-right: 1rem;
  }
  .checkbox-btn{
    margin:1rem;
  }
  .checkbox-margin-right{
    margin-right: 0.5rem;
  }
  .card-header{
    background-color: #c1c9c9;
  }
  .badge-light{
    color: #212529;
    background-color: #f8f9fa;
  }
</style>
    
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">
     

      <hr class="" />

      <!--Section: Content-->
      <div class="row">
      <aside class="col-md-3">
		
      <form action="" method="$_GET">
      <div style="display: hidden;">
      <input type="hidden" name="filtro" value="<?php if(isset($_GET['filtro'])) echo $_GET['filtro'];?>">
      </div>
      
    <div class="card">
      <article class="filter-group">
        <header class="card-header">
            <h6 class="title">Tipos de viviendas</h6>
        </header>
        <div class="filter-content collapse show" id="collapse_1" >
          <div class="card-body">
            <form action="" method="GET" class="pb-3">
            <div class="input-group">
              <input name="buscador" type="text" class="form-control" placeholder="Buscador">
                <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
            </div>
            </form>
            
            <ul class="list-menu">
              <?php
              $tipos=(new Viviendas)->getTipos();
              foreach($tipos as $v){
                ?>
                  <li><a href="<?php echo $_SERVER['PHP_SELF']."?filtro=".$v['tipo'];?>"><?= $v['tipo'];?>  </a></li>
                <?php
              }
              ?>

            </ul>
    
          </div> <!-- card-body.// -->
        </div>
      </article> <!-- filter-group  .// -->
      <article class="filter-group">
        <header class="card-header" >
            <h6 class="title" >Zonas </h6>
        </header>
        <div class="filter-content collapse show" id="collapse_2" style="">
          <div class="card-body">
            <?php
            $zonas=(new Viviendas)->getZonas();
            $cuentaZonas=(new Viviendas)->countZonas($zonas);
            //echo "<pre>cuenta";var_dump($cuentaZonas);echo "</pre>";
            foreach($zonas as $k=>$v){
              ?>
                <label class="custom-control custom-checkbox">
              <input type="checkbox" name="<?=$v['zona']?>" <?php if(isset($_GET[$v['zona']])) echo "checked";?> class="custom-control-input">
              <div class="custom-control-label"><?= $v['zona'];?>  
                <b class="badge badge-pill badge-light float-right"><?= $cuentaZonas[0]["cuenta_".$k];?></b>  </div>
            </label>
              <?php
            }
            ?>


      </div> <!-- card-body.// -->
        </div>
      </article> <!-- filter-group .// -->
      <article class="filter-group">
        <header class="card-header">
            <h6 class="title">Rango de precios </h6>
        </header>
        <div class="filter-content collapse show" id="collapse_3" style="">
          <div class="card-body">
            <input type="range" class="custom-range" min="0" max="100000" step="5000" name="rango" id="rango" style="width: 100%;" value="<?php if(isset($_GET['rango'])) echo $_GET['rango']?>">
            <div class="form-row row mb-1">
            <div class="form-group col-12">
              <label>Precio</label>
              <input class="form-control" id="ver_rango" type="number" value="<?php if(isset($_GET['rango'])) echo $_GET['rango']?>" disabled>
            </div>
            <div class="form-group col-md-6">
              <label>Min</label>
              <input class="form-control" id="min" name="min" placeholder="0" type="number" value="<?php if(isset($_GET['min'])) echo $_GET['min']?>">
            </div>
            <div class="form-group text-right col-md-6">
              <label>Max</label>
              <input class="form-control" id="max" name="max" placeholder="100000" type="number" value="<?php if(isset($_GET['max'])) echo $_GET['max']?>">
            </div>
            </div> <!-- form-row.// -->
            <button class="btn btn-block btn-primary" type="submit">Buscar</button>
          </div><!-- card-body.// -->
        </div>
      </article> <!-- filter-group .// -->
      </form>
    </div> <!-- card.// -->
    
      </aside>



      <section class="col-md-9 text-center">
        <h4 class="mb-5"><strong>
          <?php
          if(!isset($_GET['filtro'])){
            $_GET['filtro']="";
          }
          switch($_GET['filtro']){
            case "vivienda":
                echo "VIVIENDAS";
              break;
            case "local":
                echo "LOCALES";
              break;
            case "terreno":
                echo "TERRENOS";
              break;
            default:
                echo "INMUEBLES";
              break;

          }
          ?>
        </strong></h4>
        

        <div class="row">
        <?php
        //echo "<pre>";var_dump($viviendas);echo "</pre>";
        foreach($viviendas as $item){

          if(isset($_GET['filtro']) && $_GET['filtro']!=""){

            if($_GET['filtro']==$item->tipo){

              ?>
          <div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="<?php
                //echo $item->id;
                $key=array_search($item->id,array_column($imagenes,"vivienda_id"));
                if($key){
                    //encontrado
                    echo $imagenes[$key]['nombre'];
                }else{
                    //
                    echo "img\viviendas\default1.jpg";
                }
                ?>" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $item->nombre?></h5>
                <h5 class="card-title"><?= $item->precio?>&euro;</h5>
                <p class="card-text">
                  <?= $item->info;?>
                </p>
                <a href="vivienda.php?id=<?= $item->id;?>" class="btn btn-primary">Ir</a>
              </div>
            </div>
          </div>
              <?php
            }

          }else{

            ?>
          <div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="<?php
                //echo $item->id;
                $key=array_search($item->id,array_column($imagenes,"vivienda_id"));
                if($key){
                    //encontrado
                    echo $imagenes[$key]['nombre'];
                }else{
                    //
                    echo "img\viviendas\default1.jpg";
                }
                ?>" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $item->nombre?></h5>
                <p class="card-text">
                  <?= $item->info;?>
                </p>
                <a href="vivienda.php?id=<?= $item->id;?>" class="btn btn-primary">Ir</a>
              </div>
            </div>
          </div>


            <?php

          }
            
        
        ?>
          
          <?php
        }
          ?>

          
      </section>
      </div>

      <!--Section: Content-->

      <hr class="my-5" />

     
    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">
   

    <hr class="m-0" />



    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2022 Copyright:
      <img src="../CC_BY-NC.png">

      <a class="text-dark" href="">Francisco Ruiz Ortega</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="../js/script.js"></script>
    <script>
  window.onload=eventos()
  function eventos(){
    document.getElementById('rango').addEventListener('change',cambiarPrecio,false)
    document.getElementById('min').addEventListener('change',cambiarPrecio,false)
    document.getElementById('max').addEventListener('change',cambiarPrecio,false)

  }

  function cambiarPrecio(){
    let e=window.event

    if(e.target.id=="rango"){
      document.getElementById('ver_rango').value=e.target.value
    }else if(e.target.id=="min"){
      document.getElementById('rango').setAttribute('min',e.target.value)
    }else if(e.target.id=="max"){
      document.getElementById('rango').setAttribute('max',e.target.value)

    }
  }
</script>
</body>
</html>
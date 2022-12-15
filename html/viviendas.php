<?php
require dirname(__DIR__,1)."/vendor/autoload.php";

echo __DIR__;

use Fct\Viviendas;
use Fct\Imagenes;

$cur_page="viviendas";
$viviendas=(new Viviendas)->readAllViviendas();
$imagenes=(new Imagenes)->readAllImagenes();
//echo "<pre>";var_dump($imagenes);echo "</pre>";
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

      .carousel-item:nth-child(1) {
        background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .carousel-item:nth-child(2) {
        background-image: url('https://mdbootstrap.com/img/Photos/Others/images/77.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .carousel-item:nth-child(3) {
        background-image: url('https://mdbootstrap.com/img/Photos/Others/images/78.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
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

    
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">
     

      <hr class="my-5" />

      <!--Section: Content-->
      <section class="text-center">
        <h4 class="mb-5"><strong>
          <?php
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
        foreach($viviendas as $item){
          if(isset($_GET['filtro'])){

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
</body>
</html>
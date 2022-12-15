<?php
if(!isset($_GET['id'])){
  header("Location:viviendas.php");
  die();
}
require dirname(__DIR__,1)."/vendor/autoload.php";

use Fct\Viviendas;
use Fct\Imagenes;

$vivienda=(new Viviendas)->read($_GET['id']);
$imagenes=(new Imagenes)->read($_GET['id']);
//echo "<pre>vivienda: ";var_dump($vivienda->fetch(PDO::FETCH_OBJ));echo "</pre>";
//echo "<pre>imagenes: ";var_dump($imagenes);echo "</pre>";
$item=$vivienda->fetch(PDO::FETCH_OBJ);
//die();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/style.css" />
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
    </head>
    <body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php
    require "./layouts/navbar.php";
    ?>
<div class="container" style="margin-top: 5rem;">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?= $item->nombre;?></h3>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><img src="<?= $imagenes[0]['nombre'];?>" style="width:100%"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h4 class="box-title mt-5">Descripción</h4>
                    <p><?=$item->descripcion;?></p>
                    <!--
                    <h2 class="mt-5">
                        $153<small class="text-success">(36%off)</small>
                    </h2>
                    -->
                    
                    <h3 class="box-title mt-5">Características</h3>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check text-success"></i>Estado:<?= $item->estado;?></li>
                        <li><i class="fa fa-check text-success"></i>Tipo de inmueble:<?= $item->tipo;?> </li>
                    </ul>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!--aqui-->
 <!-- Carousel wrapper -->
 <div id="introCarousel" class="carousel slide carousel-fade shadow-2-strong" data-mdb-ride="carousel" style="margin-top: 10px;">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="0" class="active"></li>
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="1"></li>
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="2"></li>
      </ol>

      <!-- Inner -->
      <div class="carousel-inner">
        <!-- Single item -->
        <?php
        for($i=0;$i<count($imagenes);$i++){
        ?>
        <div class="carousel-item <?php if($i==0)echo "active";?>">
          <img src="<?= $imagenes[$i]['nombre'];?>" width="100%" height="100%">
        </div>
        <?php
        }
        ?>

        
      </div>
      <!-- Inner -->

      <!-- Controls -->
      <a class="carousel-control-prev" href="#introCarousel" role="button" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#introCarousel" role="button" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- Carousel wrapper -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="../js/script.js"></script>
    <style>
      
    </style>
    </body>
</html>
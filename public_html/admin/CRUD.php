<?php
require dirname(__DIR__,2)."/vendor/autoload.php";
use Fct\Usuarios;
use Fct\Imagenes;
use Fct\Viviendas;

//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;


$viviendas=(new Viviendas)->readAllViviendas();

$cur_page="admin";

$viviendas=(new Viviendas)->readAllViviendas();
//$imagenes=(new Imagenes)->readAllImagenes();

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
    <link rel="stylesheet" href="../../css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../../css/style.css" />

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
        background-image: url('../img/viviendas/default1.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .carousel-item:nth-child(2) {
        background-image: url('../img/viviendas/default2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .carousel-item:nth-child(3) {
        background-image: url('../img/viviendas/default3.jpg');
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
    <link rel="stylesheet" href="../../css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../../css/style.css" />


    <div class="container">
    <h4 class="mb-5 text-center">
      
      </h4>

      
    <table class="table table-hover table-responsive caption-top">
      
  <thead>
  <caption class="mb-5 text-center">
      <strong>
          INMUEBLES        
        </strong>
      </caption>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Precio</th>
      <th scope="col">Zona</th>
      <th scope="col">Tipo de inmueble</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($viviendas as $item){
      ?>
       <tr>
      <th scope="row"><?= $item->id;?></th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
      <?php


    }
    ?>
   
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>


      
    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    

    <hr class="m-0" />


    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2022 Copyright:
      <img src="../../CC_BY-NC.png">
      <a class="text-dark" href="">Francisco Ruiz Ortega</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
    <!-- MDB -->
    <script type="text/javascript" src="../../js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="../../js/script.js"></script>
</body>
</html>
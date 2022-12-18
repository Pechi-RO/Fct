<?php
session_start();
require dirname(__DIR__,2)."/vendor/autoload.php";
use Fct\Usuarios;
use Fct\Imagenes;
use Fct\Viviendas;
if(!isset($_SESSION['usuario'])){
  header('Location:..(index.php');
}
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
    <title>Panel de administrador</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />


</head>
<body>
      <!--Main Navigation-->
  <header>
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

    <!-- Navbar -->
    <?php
    require "./layouts/navbar.php";
    
    ?>
    <!-- Navbar -->
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />



    <div class="container">
    <h4 class="mb-5 text-center">
      
      </h4>
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

    <table class="table table-hover table-responsive caption-top">
      
  <thead>
  <caption class="mb-5 text-center">
    <div>
      <strong>
          INMUEBLES        
        </strong>
    </div>
    <div>
        <a href="vivienda.php" class="pull-right btn btn-secondary"><i class="fa-solid fa-plus"></i> Nuevo</a>
    </div>
      

      </caption>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Precio</th>
      <th scope="col">Zona</th>
      <th scope="col">Tipo de inmueble</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($viviendas as $item){
      ?>
       <tr>
      <th scope="row">
      <a href="edit_vivienda.php?id=<?= $item->id;?>" class="btn btn-primary " style="border-radius: 2rem;">
      <?= $item->id;?>
      </a>
      </th>
      <td>
                  <?= $item->nombre;?>

      </td>
      <td><?= $item->precio;?> &euro;</td>
      <td><?= $item->zona;?></td>
      <td><?= $item->tipo;?></td>
      <td>
        <form method="POST" action="acciones.php">
          <input type="hidden" name="id" value="<?= $item->id;?>">
        <button type="submit" class="btn btn-block btn-danger">
        Borrar
        </button>
        </form>
       
        <a href="edit_vivienda.php?id=<?= $item->id;?>" class="btn btn-block btn-warning">
        Editar
        </a>
      </td>

    </tr>
      <?php
    }
    ?>
   
   
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
      <img src="../CC_BY-NC.png">
      <a class="text-dark" href="">Francisco Ruiz Ortega</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>
</html>
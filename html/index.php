<?php
require dirname(__DIR__,1)."/vendor/autoload.php";
use Fct\Usuarios;
use Fct\Imagenes;
use Fct\Viviendas;

//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;
(new Usuarios)->crearUser();
(new Imagenes)->crearImagenes();
$cur_page="index";

$viviendas=(new Viviendas)->readAllViviendas();
$imagenes=(new Imagenes)->readAllImagenes();

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
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/style.css" />

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
        <div class="carousel-item active">
          <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h1 class="mb-3" style="color:white;">Consiga el inmueble de sus sueños </h1>
                <h5 class="mb-4" style="color:white;">por menos de lo que se espera...</h5>                
              </div>
            </div>
          </div>
        </div>

        <!-- Single item -->
        <div class="carousel-item">
          <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h2 style="color:white;">En Almería</h2>
              </div>
            </div>
          </div>
        </div>

        <!-- Single item -->
        <div class="carousel-item">
          <div class="mask" >
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h2 style="color:white;">¿A que esperas?</h2>
                
              </div>
            </div>
          </div>
        </div>
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
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">
      <!--Section: Content-->
      <section>
        <div class="row">
          <div class="col-md-6 gx-5 mb-4">
            <div class="bg-image hover-overlay ripple shadow-2-strong" data-mdb-ripple-color="light">
              <img src="../img//viviendas/trust.jpeg" class="img-fluid" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a>
            </div>
          </div>

          <div class="col-md-6 gx-5 mb-4">
            <h4><strong>Gente de confianza</strong></h4>
            <p class="text-muted">
              Confía en nuestros profesionales para que hagan de mediadores
              entre tú mismo, tu apretada agenda, y el propietario del inmueble
            </p>
            <p><strong>¿Problemas con el papeleo?</strong></p>
            <p class="text-muted">
              Nuestros expertos comerciales te echarán un cable y te llevarán de la mano durante todo el procedimiento,
              siempre dándote la máxima confianza y sin la preocupación de si falta algún papel por arreglar.
            </p>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <!--Section: Content-->
      <section class="text-center">
        <h4 class="mb-5"><strong>Echa un vistazo a nuestro amplio catálogo</strong></h4>

        <div class="row">
          
          <?php
          $randomKeys=array_rand($viviendas,3);
          for($i=0;$i<count($randomKeys);$i++){
            $key=array_search($viviendas[$randomKeys[$i]]->id,array_column($imagenes,"vivienda_id"));
            //var_dump($randomKeys);

          ?>
          <div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="<?= $imagenes[$key]['nombre'];?>" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $viviendas[$randomKeys[$i]]->nombre;?></h5>
                <p class="card-text">
                <?= $viviendas[$randomKeys[$i]]->descripcion;?>
                </p>
                <a href="vivienda.php?id=<?=$viviendas[$randomKeys[$i]]->id ?>" class="btn btn-primary">Ir</a>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
          

          
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <!--Section: Content-->
      <section class="mb-5">
        <h4 class="mb-5 text-center"><strong>Póngase en contacto con nosotros</strong></h4>

        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <form>
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <input type="text" name="nombre" id="nombre" class="form-control" />
                    <label class="form-label" for="nombre">Nombre</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <input type="text" name="apellidos" id="apellidos" class="form-control" />
                    <label class="form-label" for="apellidos">Apellidos</label>
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control" />
                <label class="form-label" for="email">Email</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="pass" id="pass" class="form-control" />
                <label class="form-label" for="pass">Contraseña</label>
              </div>

              

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
                Enviar
              </button>


            </form>
          </div>
        </div>
      </section>
      <!--Section: Content-->
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
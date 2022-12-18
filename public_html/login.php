<?php
session_start();
require dirname(__DIR__,1)."/vendor/autoload.php";
use Fct\Usuarios;
use Fct\Imagenes;
use Fct\Viviendas;

//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;
(new Usuarios)->crearUser();
(new Viviendas)->crearViviendas();
(new Imagenes)->crearImagenes();
$cur_page="login";

$viviendas=(new Viviendas)->readAllViviendas();
$imagenes=(new Imagenes)->readAllImagenes();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>InmobiliariaFct</title>
    <link rel="icon" type="image/x-icon" href="./favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="./css/mdb.min.css" />
    <!-- Custom styles -->


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
      .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #3d168a, #1e168a, #16468a, #1387bd);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #3d168a, #1e168a, #16468a, #1387bd);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
    </style>

    <!-- Navbar -->
    <?php
    require "./layouts/navbar.php";
    ?>
    <!-- Navbar -->
    <!-- MDB -->
    <link rel="stylesheet" href="./css/mdb.min.css" />

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">
    <section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container" style="padding:0;">

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
    ?>
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="favicon.ico"
                    style="width: 185px;" alt="logo">
                </div>

                <form action="index.php" method="POST">
                  <p>Por favor introduzca sus credenciales</p>
                  <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control"
                      placeholder="Dirección de correo" />
                    <label class="form-label" for="email">Email</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Contraseña</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Iniciar sesión</button>

                    <!--<a class="text-muted" href="#!">Forgot password?</a>-->
                  </div>

                  

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">La confianza depositada en nosotros no será defraudada</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    

    <hr class="m-0" />


    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2022 Copyright:
      <img src="./CC_BY-NC.png">
      <a class="text-dark" href="">Francisco Ruiz Ortega</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
    <!-- MDB -->
    <script type="text/javascript" src="./js/mdb.min.js"></script>

</body>
</html>
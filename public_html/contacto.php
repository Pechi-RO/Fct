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
$cur_page="contacto";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Contacto</title>
    <link rel="icon" type="image/x-icon" href="./favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="./css/mdb.min.css" />

    <!--Sweetalert2 CDN-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body>
    <!--
    <script>
        window.onload=eventos

        
        function eventos(){
            document.getElementById('boton').addEventListener('click',ajaxRequest,false)

        }
        //AJAX
        function ajaxRequest(){
            let e=window.event
        
            //alert(PKvehiculo)
        /*
            let orden=document.getElementsByClassName('dragDrop')
        let imgs=new Array()
        for(let i=0;i<orden.length;i++){
            imgs[i]=orden[i].id
            console.log(imgs[i])
        }
        */
        let nombre=document.getElementById('nombre').value
        let tel=document.getElementById('telefono').value
        let email=document.getElementById('email').value
        let mensaje=document.getElementById('texto').value

        let array=new Array()
        array['nombre']=nombre
        array['tel']=tel
        array['email']=email
        array['mensaje']=mensaje


        console.log(array)
        //alert(array)

        //var valParam = JSON.stringify(array);

        
        Swal.fire({
            title: '¿Guardar imágenes?',
            text: "El orden de las imágenes se actualizará",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText:"Cancelar",
            confirmButtonText: 'Guardar orden'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'send.php',
                    type: 'POST',
                    data: array,
                    success: function (response) {
                        //$("#txtresponse").css('display', 'inline-block');
                        //$("#txtresponse").text(response);
                        Swal.fire(
                            '¡Éxito!',
                            response,
                            'success'
                        )
                    }

                });
                /*
                Swal.fire(
                    '¡Confirmado!',
                    'Nuevo orden guardado',
                    'success'
                )
                */
            }
        })


       

        }

    </script>
    -->
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
    <link rel="stylesheet" href="./css/mdb.min.css" />


  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">

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
      


      <!--Section: Content-->
      <section class="mb-5">
        <h4 class="mb-5 text-center"><strong>Póngase en contacto con nosotros</strong></h4>

        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <form method="POST" action="send.php" id="miform">
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
                    <input type="number"  name="telefono" id="telefono" class="form-control" />
                    <label class="form-label" for="telefono">Teléfono</label>
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control" />
                <label class="form-label" for="email">Email</label>
              </div>

              <!-- Password input -->
              <label class="form-label">Mensaje</label>
              <div class="form-outline mb-4" for="texto">
               
                <textarea name="texto" id="texto" class="form-control"></textarea>
              </div>

              

              <!-- Submit button -->
              <button type="submit" id="boton" class="btn btn-primary btn-block mb-4">
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
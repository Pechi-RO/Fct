<link rel="stylesheet" href="../../css/bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
<style>

 #myLinks {
  display: none;
}

 a {
  color: white;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  display: block;
}

 a.icon {
  background: black;
  display: block;
  position: absolute;
  right: 0;
  top: 0;
}



.active {
  background-color: #2b4663;
  color: white;
}
.ripple-surface{
  padding-right: 2.5rem;
}
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="position: fixed;top: 0;width: 100%;z-index:1000;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" style="width: 10%;"><img src="<?="../../logo.png";?>" width="100%" height="100%"></a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?php if($cur_page=="index")echo "active";?>" href="index.php">Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($cur_page=="viviendas" && $_GET['filtro']=="vivienda")echo "active";?>" href="viviendas.php?filtro=vivienda">Viviendas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($cur_page=="viviendas" && $_GET['filtro']=="local")echo "active";?>" href="viviendas.php?filtro=local">Locales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($cur_page=="viviendas" && $_GET['filtro']=="terreno")echo "active";?>" href="viviendas.php?filtro=terreno">Terrenos</a>
        </li>

        <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li>
        -->

      <li class="nav-item">
      <form method="GET" action="viviendas.php" class="d-flex">
        <div style="display: none;">
        <input type="hidden" name="filtro" value="<?php if(isset($_GET['filtro'])) echo $_GET['filtro'];?>">
        </div>
        <input class="form-control me-sm-2" name="buscador" placeholder="Buscador">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit" style="padding-right: 2.5rem;padding-left:2.5rem;">Buscador</button>
      </form>
      </li>
     
      </ul>
      <div class="d-flex">
        <button class="btn btn-primary">
        <i class="fa-solid fa-right-to-bracket"></i>
        </button>

      </div>
    </div>
   
        
  </div>
</nav>
<div style="margin-top:5rem; ">

</div>
<?php
  include './BD/conexion.php';

  session_start();

  $errores=array();

  if(isset($_POST['boton_login'])){
    $correo=mysqli_real_escape_string($conexion,$_POST['email']);
    $contrasena=mysqli_real_escape_string($conexion,$_POST['contrasena']);


    $consulta="SELECT * FROM usuario WHERE email='$correo';";
    $resultado=mysqli_query($conexion,$consulta);

    if(mysqli_num_rows($resultado)==1){
        $fila=mysqli_fetch_assoc($resultado);
        if(password_verify($contrasena,$fila['contrasena'])){
          $_SESSION['email']=$correo;
          $_SESSION['contrasena']=$contrasena;
          header("location: inicio.php");
        }else{
          $errores[]="El usuario y/o contraseña son incorrectos.";
        }
        
    }else{
        $errores[]="El usuario no se encuentra registrado.";   
    }
  }

  include './BD/cerrar_conexion.php';
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="./Estilos/Estilo.css" type="text/css">
  </head>
  <body>
    <!----------[Navbar Rappi]------------>
    <nav class="navbar navbar-expand-lg navbar-dark p-3 header">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">RapiBNB</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
              <li class="nav-item link-header">
                <a class="nav-link mx-2" aria-current="page" href="Index.php">Inicio</a>
              </li>
              <li class="nav-item link-header">
                <a class="nav-link mx-2 active" href="./iniciar_sesion.php">Iniciar Sesion</a>
              </li>
              <li class="nav-item link-header">
                <a class="nav-link mx-2" href="./registrarse.php">Registrarse</a>
              </li>
              <li class="nav-item dropdown link-header">
                <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Alquileres
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#">Buscar alquiler</a></li>
                  <li><a class="dropdown-item" href="#">Sobre nosotros</a></li>
                  <li><a class="dropdown-item" href="#">Contactanos</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        </nav>
        <!------------------------------------>
        <!----------[Contenido iniciar sesion]--------->
        <div class="container">
          
          <section class="vh-100">
              <div class="container py-5 h-90">
                <div class="row d-flex justify-content-center align-items-center h-100">
                  <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-light text-black" style="border-radius: 1rem;">
                      <div class="card-body p-5 text-center">

                        <h2 class="mb-5">Iniciar sesion</h2>

                          <?php
                              if(count($errores)> 0){
                                  echo"<div class='alert alert-danger' role='alert'>";
                                  foreach($errores as $error){
                                      echo $error . "<br>";
                                  }
                                  echo"</div>";  
                              }

                          ?>

                        <form class="mb-md-3 mt-md-2 pb-3" action="iniciar_sesion.php" method="post">
                             
                          <div class="form-outline form-black mb-4">
                            <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email"/>
                            <label class="form-label" for="typeEmailX">Email</label>
                          </div>

                          <div class="form-outline form-white mb-4">
                            <input type="password" id="typePasswordX" class="form-control form-control-lg" name="contrasena"/>
                            <label class="form-label" for="typePasswordX">contraseña </label>
                          </div>

                          <input type="submit" name="boton_login" class="btn btn-outline-dark btn-lg px-5" value="Iniciar sesion">

                        </form>

                        <div>
                          <p class="mb-0">No tiene una cuenta? <a href="./registrarse.php" class="text-black-50 fw-bold">Registrarse</a>
                          </p>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </section>      

        </div>
        <!------------------------------------>
        <!---------------------------------------------------------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
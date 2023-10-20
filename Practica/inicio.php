<?php
    include './BD/conexion.php';
    session_start();
    $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<?php
    echo "<h1>Hola ".$_SESSION['email']."!</h1>";

    echo "<br>
        <a href='cerrar_sesion.php'>Cerrar sesion</a>   
    ";
?>
<body>
    
</body>
</html>
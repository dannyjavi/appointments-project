<?php

require '../funcs/conexion.php';
require '../funcs/funcs.php';

if(isset($_GET["id"]) && isset($_GET['val']))
{
    $idUsuario = $_GET['id'];
    $token = $_GET['val'];

    $mensaje = validaIdToken($idUsuario, $token);
}

include '../views/partials/header.php'; ?>

    <div class="jumbotron">
        <div class="container">
            <h1><?php echo $mensaje; ?></h1>
            <br/>
           <a class="btn btn-primary btn-lg" href="../index.php" role="button">Iniciar Sesi&oacute;n</a>
        </div>
    </div>
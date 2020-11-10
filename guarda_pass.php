<?php
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$user_id = $mysqli->real_escape_string($_POST['user_id']);
$token = $mysqli->real_escape_string($_POST['token']);
$password = $mysqli->real_escape_string($_POST['password']);
$con_password = $mysqli->real_escape_string($_POST['con_password']);

if(validaPassword($password, $con_password))
{
    $pass_hash = hashPassword($password);

    if(cambiaPassword($pass_hash, $user_id, $token)){
    	include 'views/partials/header.php';
       echo "<div class='jumbotron'>
				<div class='container'>
				<div class='page-header'>Password modificado</div>
				<h3>Puedes hacer tu reserva con tu nueva clave</h3>
				<br> <a class='btn btn-success' href='index.php' > Iniciar Sesion </a>
				</div>
       		</div>";
    } else{
        echo "Error al modificar la Contrase&ntilde;a";
    }
} else {
    echo "Las contrase&ntilde;as no coinciden";
}
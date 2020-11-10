<?php
session_start();
//para corroborar que no hay sesion iniciada y se pueda trabajar con las sesiones
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array(); //para los errores


if(!empty($_POST['email']))
{
    
    $email = $mysqli->real_escape_string($_POST['email']);

    if(!isEmail($email))
    {
        $errors[] = "Debes ingresar un correo electrónico valido";
    }
        if(emailExiste($email))
        {
        	header('Content-Type: text/html; charset=UTF-8');
            $user_id = getValor('idPaciente','email', $email);
            $nombre = getValor('nombre','email', $email);

            $token = generaTokenPass($user_id);

            $url =  'http://localhost.ddns.net/cambia_pass.php?user_id='.$user_id.'&token='.$token;

            $asunto = "Generar nueva contraseña - Centro de   María Narváez";
            $cuerpo = "Hola $nombre: <br/><br /> Se ha solicitado un reinicio de contraseña. <br /><br />Para 
            restaurar la contraseña, visita la siguiente dirección: <a href='$url'>$url</a>";

            if(enviarEmail($email, $nombre, $asunto, $cuerpo))
            {

                include 'views/partials/header.php';
                echo "<div class='jumbotron'>";
                echo "<div class='container'>";
                	echo "<div class='page-header'>";
  					echo "<h1>Solicitud realizada con Exito<small><br> Verifica tu cuenta de correo</small></h1>";
  					echo "</div>";
                	echo "<h3>Hemos enviado un email electronico a la cuenta de correo $email para restablecer la Clave.</h3><br />";
                echo "<a class='btn btn-success' href='index.php' > Iniciar Sesion </a></div></div>";                  
                exit;
            }else{
            $errors[] = "Error al enviar Email";
            }
        }else{
            $errors[] = "No existe el correo Electronico";
        }   
}
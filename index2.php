<?php
session_start();
//para corroborar que no hay sesion iniciada y se pueda trabajar con las sesiones
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array(); //para los errores

//si el usuario envia un post
if(!empty($_POST))
{
    $nif = $mysqli->real_escape_string($_POST['nif']);
    $password = $mysqli->real_escape_string($_POST['password']);

    if (isNullLogin($nif, $password))
    {
        $errors[] = "Debe llenar todos los campos";
    }

    $errors[] = login($nif,$password);
}

if(!empty($_POST['email']))
{
    
    $email = $mysqli->real_escape_string($_POST['email']);

    if(!isEmail($email))
    {
        $errors[] = "Debes ingresar un correo electronico valido";
    }
        if(emailExiste($email))
        {
            $user_id = getValor('idPaciente','email', $email);
            $nombre = getValor('nombre','email', $email);

            $token = generaTokenPass($user_id);

            $url =  'http://localhost.ddns.net/cambia_pass.php?user_id='.$user_id.'&token='.$token;

            $asunto = "Generar nueva contrase&ntilde;a";
            $cuerpo = "Hola $nombre: <br/><br /> Se ha solicitado un reinicio de contrase&ntilde;a. <br /><br />Para 
            restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";

            if(enviarEmail($email, $nombre, $asunto, $cuerpo))
            {
               include 'views/partials/header.php';
                echo "<div class='jumbotron'>";
                echo "<div class='container'>";
                    echo "<div class='page-header'>";
                    echo "<h1>Solicitud realizada con Exito<small> Verifica tu cuenta de correo</small></h1>";
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

include 'views/partials/header.php';
?>
        
        <div class="container">    
            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Iniciar Sesi&oacute;n</div>
                        <div class="option"><a href="#" data-toggle="modal" data-target="#myModal">¿Se te olvid&oacute; tu contraseña?</a>
                        </div>
                    </div>     
                    
                    <div style="padding-top:30px" class="panel-body" >
                        
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        
                        <form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="nif" type="text" class="form-control" name="nif" placeholder="nif o email" required autofocus>                                        
                            </div>
                            
                            <div style="margin-bottom: 5px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" placeholder="password" required>
                            </div>
                            <div class="input-group">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" id="mostrar_contrasena" title="clic para mostrar contraseña"> Mostrar Contraseña
                                    </label>
                                  </div>
                                </div>
                            
                            <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
                                    <button id="btn-login" type="submit" class="btn btn-success">Iniciar Sesi&oacute;n</a>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
                                    </div>
                                </div>
                            </div>    
                        </form><?php echo resultBlock($errors); ?>
                    </div>                     
                </div>  
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="margin-top: 1.5rem" id="myModalLabel">Debes tener acceso a la cuenta de correo que ingresaste en el momento de tu registro</h4>
      </div>
      <div class="modal-body">
          <!-- contenido del modal -->
            <div class="panel panel-info">
                <div class="panel-heading">
                    Recupera la contrase&ntilde;a
                <div style="float:right; font-size: 15px; position: relative"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
                </div>
                <div class="panel-body">
                    <form action="recupera.php" method="POST">
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input id="inputEmail" type="email" class="form-control" name="email" value="" placeholder="correo electrónico" autofocus required>
                        </div>
                           
                       <button class="btn btn-lg btn btn-info btn-block" type="submit">Recuperar</button>
                        No tengo cuenta!<a href="registro.php" class="card-link"> Registrate aqu&iacute;.</a>
                    </form><?php echo resultBlock($errors); ?>
            </div>
          <!-- /.modal-body -->     
     </div>
      
    </div>
  </div>
</div>

    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
          $('#mostrar_contrasena').click(function () {
            if ($('#mostrar_contrasena').is(':checked') ) {
                  $('#password').attr('type', 'text');
                  $('#con_password').attr('type', 'text');
            } else {
              $('#password').attr('type', 'password');
              $('#con_password').attr('type', 'password');
                }
            });
        });
    </script>

</body>
</html>             
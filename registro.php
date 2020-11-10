<?php
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require 'models/Personas.php';
		$persona	= new Personas();
		$nombre = $persona->Limpiar($mysqli->real_escape_string($_POST['nombre']));
		$apellido = $persona->Limpiar($mysqli->real_escape_string($_POST['apellido']));
		$apellido2 = $persona->Limpiar($mysqli->real_escape_string($_POST['apellido2']));
		$nacimiento = $persona->Limpiar($mysqli->real_escape_string($_POST['nacimiento']));
		$password = $persona->Limpiar($mysqli->real_escape_string($_POST['password']));
		$con_password = $persona->Limpiar($mysqli->real_escape_string($_POST['con_password']));
		$nif = $persona->Limpiar($mysqli->real_escape_string($_POST['nif']));
		$direccion = $persona->Limpiar($mysqli->real_escape_string($_POST['direccion']));
		$cp = $persona->Limpiar($mysqli->real_escape_string($_POST['cp']));
		$telefono = $persona->Limpiar($mysqli->real_escape_string($_POST['telefono']));
		$email = $persona->Limpiar($mysqli->real_escape_string($_POST['email']));
		$profesion = $persona->Limpiar($mysqli->real_escape_string($_POST['profesion']));
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
		$activo = 0;
		$privilegio = 2;
		
		$secret = 'clave secreta';
	
		if(!$captcha){
			$errors[] = "Por favor verifica el captcha";
		}
		
		if(isNull($nombre, $apellido,$apellido2,$nacimiento,$password,$con_password, $nif,$direccion,$cp, $telefono,$email, $profesion))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		if(!isEmail($email))
		{
			$errors[] = "Dirección de correo inválida";
		}

		if (!isTelefono($telefono))
		{
			$errors[] = "Debes ingresar un numero de teléfono válido";
		}
		
		if(!validaPassword($password, $con_password))
		{
			$errors[] = "Las contraseñas no coinciden";
		}		
		
		if(pacienteExiste($nif))
		{
			$errors[] = "El paciente con  $nif ya existe en el Centro";
		}
		
		if(emailExiste($email))
		{
			$errors[] = "El correo electronico $email ya existe";
		}
		if(telefonoExiste($telefono))
		{
			$errors[] = "El telefono $telefono ya existe";
		}


		if(count($errors) == 0)
		{
			
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
			$arr = json_decode($response, TRUE);
			
			if($arr['success'])
			 {
				
				$pass_hash = hashPassword($password);
				$token = generateToken();
				
				$registro = registraUsuario($nombre,$apellido,$apellido2,$nacimiento,$pass_hash,$nif,$direccion,$cp,$telefono,$email,$profesion, $activo, $token, $privilegio);			
				if($registro > 0)
				{				
					$url = 'http://'.$_SERVER["SERVER_NAME"].'/controllers/activar.php?id='.$registro.'&val='.$token;
					
					$asunto = 'Activar Cuenta - Centro de   de reservas';
					$cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, es indispensable de clic en el siguiente enlace: <a href='$url'>Activar Cuenta</a>";
					
					if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
						include 'views/partials/header.php';
						echo "<div class='jumbotron'>";
								echo "<div class='container'>";
										echo "<div class='page-header'><h1>Proceso Exitoso</h1></div>";
										echo "<h3>Para terminar el proceso de registro siga las instrucciones que le hemos enviado a la direccion de correo electrónico: $email</h3>";
										echo "<a class='btn btn-success' href='index.php' > Iniciar Sesión </a>";
								echo"</div>";
						echo "</div>";
						
						exit;
						} else {
						$erros[] = "Error al enviar Email";
					}
					
					} else {
					$errors[] = "Error al Registrar";
				}
				
				} else {
				$errors[] = 'Error al comprobar Captcha';
			}
		}
	}

include 'views/partials/header.php';
?>
	
<body>
		<div class="container">
			<div id="signupbox" style="margin-top: 50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Regístrate</div>
						<div class="option" style="float: right;
    margin: -20px;margin-right: 10px;font-size: 1.5em"><a id="signinlink" href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>
					<!--/.panel-heading -->
					<div class="panel-body">
						<form id="signupform" class="form-horizontal" role="form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>
							<div class="form-group">
								<label for="nombre" class="col-md-2 control-label">Nombre:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" autofocus required>
								</div>
								<label for="apellido" class="col-md-2 control-label">Apellido:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="apellido" placeholder="Apellido" required >
								</div>
							</div>
							<div class="form-group">
								<label for="apellido2" class="col-md-2 control-label">Sgdo Apellido</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="apellido2" placeholder="sgdo apellido">
								</div>
								<label for="nacimiento" class="col-md-2 control-label">Nacimiento</label>
								<div class="col-md-4">
									<input type="date" class="form-control" name="nacimiento" >
								</div>
							</div>
							<!-- pass-conf-pass -->
							<div class="form-group">
								<label for="password" class="col-md-2 control-label">Password</label>
								<div class="col-md-4">
									<input type="password" id="password"  class="form-control" name="password" placeholder="Password" required>
								</div>							
								<label for="con_password" class="col-md-2 control-label">Confirmar Password</label>
								<div class="col-md-4">
									<input type="password" class="form-control" id="con_password" name="con_password" placeholder="Confirmar Password" required>
								</div>							
							    <div class="col-md-offset-2 col-sm-10">
							      <div class="checkbox">
							        <label>
							          <input type="checkbox" id="mostrar_contrasena" title="clic para mostrar contraseña"> Mostrar Contraseña
							        </label>
							      </div>
							    </div>
							</div>
							<!--/.password -->
							<div class="form-group">
								<label for="nif" class="col-md-2 control-label">DNI</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="nif" value="<?php if(isset($nif)) echo $nif; ?>" placeholder="123456L - F123456">
								</div>
								<label for="direccion" class="col-md-2 control-label">Direccion</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="direccion" placeholder="Avda de carlos haya, bloque 1, 4-D">
								</div>
							</div>
							<!-- nif-direccion -->
							<!-- cp. telefono-email -->
							<div class="form-group">
								<label for="cp" class="col-md-2 control-label">C.P</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="cp" placeholder="29009">
								</div>
								<label for="telefono" class="col-md-2 control-label">Telefono</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="telefono" value="<?php if(isset($telefono)) echo $telefono; ?>" placeholder="78978289819" required>
								</div>
							</div>
							<!-- email  --- profesion -->
							<div class="form-group">
								<label for="email" class="col-md-2 control-label">Email</label>
								<div class="col-md-4">
									<input type="email" class="form-control" name="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="ejemplo@hotmail.com  - rodolfo@gmail.com" required>
								</div>
								<label for="profesion" class="col-md-2 control-label">Profesion</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="profesion" placeholder="medico,mecánico">
								</div>
							</div>
							<!-- captcha -->
							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label"></label>
								<div class="g-recaptcha col-md-9" data-sitekey="6Lfau4AUAAAAAO97DsB20mGbvF2t2C8Lf7Bp35lf"></div>
							</div>
							
							<div class="form-group">                                      
								<div class="col-md-offset-5 col-md-5">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
								</div>
							</div>

						</form><?php echo resultBlock($errors); ?>
					</div>
				</div>
			</div>
		</div>
	<script src="views/bower_components/jquery/dist/jquery.min.js" ></script>
	<script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js" ></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
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
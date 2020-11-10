<?php
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array();
if(empty($_GET['user_id'])){
    header('location: /registro.php');
}

$user_id = $mysqli->real_escape_string($_GET['user_id']) ;
$token = $mysqli->real_escape_string($_GET['token']);

if(!verificaTokenPass($user_id, $token))
{
    echo "No se pudo verificar los datos";
    exit;
}
?>
<?php
include 'views/partials/header.php';
?>
<div class="jumbotron">
	<div class="container">
		<div class="panel panel-default">
		  	<div class="panel-heading">
  				Cambia tu Clave
			</div>
		  	<div class="panel-body">
		    	Recuerda que una contraseña facil de recordar siempre es mejor, eso evita que repitas este proceso
				
				<br/>
		    	<form action="guarda_pass.php" method="POST">
		    		<input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_id; ?>" />
				
					<input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />
		    		<div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" autofocus placeholder="nueva contraseña" required>                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="con_password" type="password" class="form-control" name="con_password" placeholder="repite la nueva contraseña" required>                                        
                    </div>
					
					<button class="btn btn-lg btn btn-info btn-block" type="submit">Recuperar</button><a href="index.php" class="navbar-brand">Inicio</a>  	
		    	</form>		    	
		 	</div>
		 </div>
	</div>
</div>

	
	
</div>
</body>
</html>
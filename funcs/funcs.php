<?php
 	function Limpiar($datos){
        $datos  =   trim($datos);
        $datos  =   stripcslashes($datos);
        $datos  =   htmlspecialchars($datos);
        return $datos;
        
    }
	function isNull($nombre, $apellido,$apellido2,$nacimiento,$pass, $pass_con,$nif,$direccion,$cp,$telefono, $profesion, $email){
		if(strlen(trim($nombre)) < 1 || strlen(trim($apellido)) < 1 || strlen(trim($apellido2)) < 1 || strlen(trim($nacimiento)) < 1 || strlen(trim($nif)) < 1 || strlen(trim($direccion)) < 1 || strlen(trim($cp)) < 1 || strlen(trim($telefono)) < 1 || strlen(trim($profesion)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}
	
	function isEmail($email)
	{
		$email = filter_var($email,FILTER_SANITIZE_EMAIL);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			return true;
			} else {
			return false;
		}
	}
	function isTelefono($telefono)
	{
		$telefono = filter_var($telefono,FILTER_SANITIZE_NUMBER_INT);

		if (!filter_var($telefono, FILTER_VALIDATE_INT) === false){
			return true;
			} else {
			return false;
		}
	}
	
	function validaPassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0){
			return false;
			} else {
			return true;
		}
	}
	
	function minMax($min, $max, $valor){
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function pacienteExiste($nif)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT idPaciente FROM pacientes WHERE nif = ? LIMIT 1");
		$stmt->bind_param("s", $nif);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

	function telefonoExiste($telefono)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT idPaciente FROM pacientes WHERE telefono = ? LIMIT 1");
		$stmt->bind_param("i", $telefono);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;	
		}
	}
	
	function emailExiste($email)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT idPaciente FROM pacientes WHERE email = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;	
		}
	}
	
	function generateToken()
	{
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}
	
	function hashPassword($password) 
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}
	
	function resultBlock($errors){
		if(count($errors) > 0)
		{
		echo "<div id='error' class='alert alert-danger' role='alert'>";
			echo "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>";
			echo "<span class='sr-only'>Error:</span>";
			echo "<ul style='list-style-type: none'>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}
	
	function registraUsuario($nombre,$apellido,$apellido2,$nacimiento,$pass_hash,$nif,$direccion,$cp,$telefono,$email,$profesion, $activo, $token, $privilegio){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO pacientes (nombre,apellido,apellido2,nacimiento, password,nif,direccion,cp,telefono,email,profesion, activacion, token, privilegio) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param('sssssssiissisi', $nombre,$apellido,$apellido2,$nacimiento, $pass_hash, $nif,$direccion,$cp,$telefono,$email,$profesion,$activo, $token, $privilegio);		
		if ($stmt->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}
	
	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require_once 'PHPMailer/PHPMailerAutoload.php';
		require 'conexion.php';
		header('Content-Type: text/html; charset=UTF-8');
		//para que traiga los datos de la base de datos
		$sqlConf = "SELECT * FROM configuracion";
		$resultConf = $mysqli->query($sqlConf);
		$row = $resultConf->fetch_assoc();
		// todo funciona
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = $row['host']; //'smtp.gmail.com';
		$mail->Port = $row['puerto']; //'587';
		
		$mail->Username = $row['email_emisor'];	//'tucorreo@gmail.com';
		$mail->Password = $row['password'];
		$mail->CharSet = 'UTF-8';
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$mail->setFrom($row['email_emisor'], 'quien lo envía');
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
		return true;
		else
		return false;
	}
	
	function validaIdToken($id, $token){
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM pacientes WHERE idPaciente = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
				} else {
				if(activarUsuario($id)){
					$msg = '<div class="alert alert-success" role="alert">
							  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							  <span class="sr-only">Success:</span>
							  	Cuenta Activada - Puedes reservar dando clic en el siguiente Enlace
							</div>';
					} else {
						include '../views/partials/';
					$msg = '
					<div class="alert alert-danger" role="alert">
					  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					  <span class="sr-only">Error:</span>
					  	Error al Activar Cuenta
					</div>';
				}
			}
			} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}
	
	function activarUsuario($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE pacientes SET activacion=1 WHERE idPaciente = ?");
		$stmt->bind_param('i', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}
	
	function isNullLogin($nif, $password){
		if(strlen(trim($nif)) < 1 || strlen(trim($password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	function login($nif, $password)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT idPaciente, privilegio, password FROM pacientes WHERE nif = ? || email = ? LIMIT 1");
		$stmt->bind_param("ss", $nif, $nif);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			
			if(isActivo($nif)){
				
				$stmt->bind_result($id, $privilegio, $passwd);
				$stmt->fetch();
				
				$validaPassw = password_verify($password, $passwd);
				
				if($validaPassw){
					
					lastSession($id);
					$_SESSION['id_Paciente'] = $id;
					$_SESSION['tipo_paciente'] = $privilegio;
						if ($privilegio == 1) {
							header("Location: ../views/horario.php");
						}else{
							header("Location: ../views/miscitas.php");
						}
					} else {
					
					$errors = "La contrase&ntilde;a es incorrecta";
				}
				} else {
				$errors = 'El usuario no esta activo';
			}
			} else {
			$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
		}
		return $errors;
	}
	
	function lastSession($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE pacientes SET last_session=NOW(), token_password='', password_request=1 WHERE idPaciente = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}
	
	function isActivo($nif)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM pacientes WHERE nif = ? || email = ? LIMIT 1");
		$stmt->bind_param('ss', $nif, $nif);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	
	
	function generaTokenPass($user_id)
	{
		global $mysqli;
		
		$token = generateToken();
		
		$stmt = $mysqli->prepare("UPDATE pacientes SET token_password=?, password_request=1 WHERE idPaciente = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();
		
		return $token;
	}
	
	function getValor($campo, $campoWhere, $valor)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT $campo FROM pacientes WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}
	
	function getPasswordRequest($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT password_request FROM pacientes WHERE idPaciente = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();
		
		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;	
		}
	}
	
	function verificaTokenPass($paciente_id, $token){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM pacientes WHERE idPaciente = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $paciente_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else
		{
			return false;	
		}
	}
	
	function cambiaPassword($password, $paciente_id, $token){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE pacientes SET password = ?, token_password='', password_request=0 WHERE idPaciente = ? AND token_password = ?");
		$stmt->bind_param('sis', $password, $paciente_id, $token);
		
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
}
<?php
session_start();

require 'funcs/conexion.php';
require 'funcs/funcs.php';

if(!isset($_SESSION['id_Paciente']))
  {
    header("location: ../index.php");
 }

$idUsuario = $_SESSION['id_Paciente'];

$sql = "SELECT idPaciente,concat_ws(' ', nombre,apellido) as nombreCompleto,profesion FROM pacientes WHERE idPaciente = '$idUsuario'";

$result = $mysqli->query($sql);

$row = $result->fetch_assoc();

include 'views/partials/header.php';

?>
<!--Cuadro principal  -->
<div class="wrapper">
		<header class="main-header">
		<?php include 'views/partials/navbar.php';?>
		</header>
	<!-- Left side column. contains the logo and sidebar -->
  <?php include 'views/partials/sidebar.php';
  ?>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
			Pacientes Registrados
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="admin.php"><i class="fa fa-users"></i>Inicio</a></li>
				<li><a href="admin.php">Pacientes</a></li>
				<li class="active">Tabla</li>
				<!-- Contextual button for informational alert messages -->
			</ol>
		</section>
		<!-- Tabla -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<!--<h3 class="box-title">Pacientes</h3>-->		
								<button id="btn_insertar" class="btn bg-maroon" title="Insertar nuevo usuario" data-toggle="modal" data-target="#ventanaModal"><i class="fa fa-user-plus"></i></button>
							<?php include 'views/partials/buscador.php';?>
						</div>
						<!-- box-header-->
						<div class="box-body table-responsive no-padding" id="div_tabla">
							</div>
						<!-- .box-body-->
						<div class="box-footer clearfix text-center paginas">
							<ul class="pagination pagination-sm no-margin" id="pagination">
							</ul>
						</div>
						<!-- box-footer clearfix-->
					</div>
					<!-- /.box-->
					</div>	
				<!-- /.col-xs-12 -->					
			</div>					
		
		</section>
		<!-- Fin Tabla -->
	</div>
	<!--Footer   -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
	</footer>
</div>
<?php include 'views/partials/modals.php'; ?>

<!-- Javascript -->
	<script src="../views/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="js/main.js"></script>
	<script src="views/dist/js/adminlte.js"></script>
	<script src="views/dist/js/demo.js"></script>
</body>
</html>

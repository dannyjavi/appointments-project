<?php
session_start();

require '../funcs/conexion.php';
require '../funcs/funcs.php';

if(!isset($_SESSION['id_Paciente']))
  {
    header("location: ../../index.php");
 }

$idUsuario = $_SESSION['id_Paciente'];

$sql = "SELECT idPaciente,concat_ws(' ', nombre,apellido) as nombreCompleto,profesion,telefono,nombre,apellido,apellido2,email,direccion FROM pacientes WHERE idPaciente = '$idUsuario'";

$result = $mysqli->query($sql);

$row = $result->fetch_assoc();

include '../views/partials/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$nombre = Limpiar($_POST['nombre']);
$apellido = Limpiar($_POST['apellido']);
$apellido2 = Limpiar($_POST['apellido2']);
$telefono = Limpiar($_POST['telefono']);
$direccion = Limpiar($_POST['direccion']);
$email = Limpiar($_POST['email']);

$consulta = "UPDATE pacientes SET nombre = ?, apellido = ?,apellido2 = ?,telefono = ?, direccion = ?, email = ? WHERE idPaciente = ?";

$resultado= $mysqli->prepare($consulta);
$resultado->bind_param('sssissi', $nombre, $apellido,$apellido2,$telefono, $direccion, $email,$idUsuario);

$resultado->execute();
$num = $resultado->num_rows;
if ($num == 0 ) {
    header("Location: ../views/datosPersonales.php");
  }

}

?>
<!--Cuadro principal  -->
<div class="wrapper">
		<header class="main-header">
		<?php include '../views/partials/navbar.php';?>
		</header>
	<!-- Left side column. contains the logo and sidebar -->
  <?php include '../views/partials/sidebar.php';
  ?>
	<div class="content-wrapper">
				<section class="content-header">
			      <h1>
			        Datos Personales
			      </h1>
			     
				    <ol class="breadcrumb">
				        <li><a href="admin.php"><i class="fa fa-users"></i>Inicio</a></li>
				        <li><a href="admin.php">Actualizar</a></li>
				        <li class="active">Datos P.</li>
				        <!-- Contextual button for informational alert messages -->
				    </ol>
			    </section>
			<!-- Tabla -->
			<section class="content">
            <div class="row">
                <div class="col-md-10">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-black" style="background: url('../views/dist/img/photo1.png') center center;">
                        <h3 class="widget-user-username"><?php echo $row['nombreCompleto'];?></h3>
                        <h5 class="widget-user-desc"><?php echo $row['profesion'];?></h5>
                      </div>
                      <div class="widget-user-image">
                        <img class="img-circle" src="../views/dist/img/logofinal3.png" alt="User Avatar">
                      </div><br/>
                      <div class="box-footer">
                          <div class="row">
                             <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="box box-primary">
                                  <div class="box-header with-border">
                                    <h3 class="box-title">Información Personal</h3>
                                  </div>
                                  <!-- /.box-header -->
                                  <!-- form start -->
                                  <div class="col-md-6">
                                      <form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                          <div class="box-body">
                                            <div class="form-group">
                                              <label for="txtNombre">Nombres</label>
                                              <input type="text" name="nombre"class="form-control" id="txtNombre" value="<?php echo $row['nombre'];?>">
                                            </div>
                                            <div class="form-group">
                                              <label for="txtNombre">Apellido</label>
                                              <input type="text" name="apellido" class="form-control" id="txtApellido" value="<?php echo $row['apellido'];?>">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputPassword1">Sgdo Apellido</label>
                                              <input type="text" name="apellido2" class="form-control" id="txtApellido" value="<?php echo $row['apellido'];?>">
                                            </div>
                                          </div>
                                          <!-- /.box-body -->
                                        </div>
                                        <div class="col-md-6">
                                          <div class="box-body">
                                            <div class="form-group">
                                              <label for="txtNombre">Teléfono</label>
                                              <input type="text" name="telefono" class="form-control" id="txtTelefono" value="<?php echo $row['telefono'];?>">
                                              </div>
                                            <div class="form-group">
                                              <label for="txtNombre">Correo Electrónico</label>
                                              <input type="text" name="email" class="form-control" id="txtEmail" value="<?php echo $row['email'];?>">
                                            </div>
                                            <div class="form-group">
                                              <label for="direccion">Direccion</label>
                                              <input type="text" name="direccion" class="form-control" id="txtDireccion" id="txtEmail" value="<?php echo $row['email'];?>">
                                            </div>
                                          </div>
                                          <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                          </div>
                                      </form>
                                  </div>
                                </div>
                                <!-- /.box -->        
                          </div>                        
                      </div>
                    </div>
                    <!-- /.widget-user -->                    
                  </div>
                  <!-- /.col -->
            </div>
      <!-- /.row -->                    
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
	<!-- Latest compiled and minified JavaScript --> 
<script src='bower_components/jquery/dist/jquery.min.js'></script>
<script src='bower_components/moment/moment.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<script src='bower_components/fullcalendar/dist/locale-all.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<script src="../../js/pacientes.js"></script>
	<script src="dist/js/adminlte.js"></script>
	<script src="dist/js/demo.js"></script>
 <script src="dist/js/alertify.js"></script>

 
</body>
</html>

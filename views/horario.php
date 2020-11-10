<?php
session_start();

require '../funcs/conexion.php';
require '../funcs/funcs.php';

if(!isset($_SESSION['id_Paciente']))
  {
    header("location: ../../index.php");
 }

$idUsuario = $_SESSION['id_Paciente'];
$privilegio = $_SESSION['tipo_paciente'];
$sql = "SELECT idPaciente,concat_ws(' ', nombre,apellido) as nombreCompleto FROM pacientes WHERE idPaciente = '$idUsuario'";

$result = $mysqli->query($sql);

$row = $result->fetch_assoc();

include '../views/partials/header.php';

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
	        Reservar Cita
	      </h1>
	     
		    <ol class="breadcrumb">
		        <li><a href="/admin.php"><i class="fa fa-users"></i>Inicio</a></li>
		        <li><a href="/views/horario.php">Reservas</a></li>
		        <li class="active">Citas</li>
		        <!-- Contextual button for informational alert messages -->
		    </ol>
	    </section>
			<!-- Tabla -->
		<section class="content">
				<div class="row">
					<div class="col-xs-12">
						 	<div class="box box-primary">
				               	<div class="box-body no-padding">
				                  <div id="calendar"></div><!-- calendario -->
				               	</div><!-- /.box-body -->
							</div><!-- /.box -->
					</div><!-- /.col-xs-12 -->
				</div>
				<div class="modal fade" id="nuevaCita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title text-center" id="myModalLabel">Nueva Cita</h4>
						</div>
						<div class="modal-body">        
							<form class="form-horizontal">
								<?php
								if ($privilegio == 1) { ?>
									<div class="form-group">
										<label for="exampleInputEmail1" class="col-sm-2 control-label">Pacientes</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="paciente" placeholder="nombre del Paciente" /><p id="msgvacio"></p>
											<input type="hidden" class="form-control" value="" id="paciente_ID"/>
											<input type="hidden" class="form-control" id="txtID">
											
										</div>
									</div>
								<?php
								}
								?>
								<!-- pruebas -->
								<div class="form-group">
									<input type="hidden" class="form-control" id="txtID">
									<input type="hidden" class="form-control" id="paciente2" value="<?php echo $idUsuario;?>">
											<label class="col-sm-2 control-label">Motivo de la consulta</label>
										<div class="col-sm-10">
											<input type="text" name="txtTitulo" id="txtTitulo" class="form-control" placeholder="Motivo de la consulta">
										</div>
								</div>
								
								<div class="form-group">
									<label for="txtHora" class="col-sm-2 control-label">Hora Seleccionada</label>
									<div class="col-sm-4">
									<input type="text" class="form-control" id="txtHora" name="txtHora" disabled="off">
									</div>
									<label for="date" class="col-sm-2 control-label">Fecha Seleccionada</label>
									<div class="col-sm-4">
									<input type="date" class="form-control" id="txtFecha" name="txtFecha" disabled="off">
									</div>
								</div>
								<div class="form-group">
									<label for="sesion" class="col-sm-2 control-label">Sesion</label>
									<div class="col-sm-8">
										<select name="sesion" id="sesion" class="form-control">
											<option value="3600" selected>Sesion Completa</option>
											<option value="1800">Media Sesion</option>
											<?php
											if($privilegio ==1){ ?>
											<option value="900">VNM</option>
											<?php
											}
											?>                     
										</select>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="d-none btn btn-default" id="btnEliminar">Eliminar</button>
							<button type="button" id="btnModificar" class="d-none btn btn-primary">Modificar</button>
							<button type="button" id="btnAgregar" class="btn btn-success">Reservar</button>
						</div>
					</div>
				</div>
				</div>		
		</section><!-- Fin Tabla -->		
	</div>
	
	<?php 
	include '../views/partials/modals.php'; ?>
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
 
<!--<script src='bower_components/jquery/dist/jquery.min.js'></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src='bower_components/moment/moment.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<script src='bower_components/fullcalendar/dist/locale-all.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<?php 
	if ($privilegio == 1) {?>
		<script src="../../js/admin.js"></script>
		<?php
	}
	?>
	<script src="../../js/pacientes.js"></script>
	<script src="dist/js/adminlte.js"></script>
	<script src="dist/js/demo.js"></script>
 <script src="dist/js/alertify.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <script>
    
   $(function () {
        
        $("#theinput2").autocomplete({

        	minLength: 1,
        	source: "/buscador/buscar.php",
        	select : function(event, ui){
        		event.preventDefault();
		         $("#theinput2").val(ui.item.label);
		         $("#theinput3").val(ui.item.value);
		          // start an alert which contains the value of proposal
		      },
        });
        $( "#theinput2").autocomplete("option", "appendTo", ".form-horizontal" );
      });
      
    </script>
</body>
</html>

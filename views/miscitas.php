<?php
session_start();

require '../funcs/conexion.php';
require '../funcs/funcs.php';

if(!isset($_SESSION['id_Paciente']))
  {
    header("location: ../../index.php");
 }

$idUsuario = $_SESSION['id_Paciente'];

$sql = "SELECT idPaciente,concat_ws(' ', nombre,apellido) as nombreCompleto,profesion FROM pacientes WHERE idPaciente = '$idUsuario'";

$result = $mysqli->query($sql);

$row = $result->fetch_assoc();

$privilegio = $_SESSION['tipo_paciente'];
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
			        <li><a href="admin.php"><i class="fa fa-users"></i>Inicio</a></li>
			        <li><a href="admin.php">Citas</a></li>
			        <li class="active">Historial</li>
			        <!-- Contextual button for informational alert messages -->
			    </ol>
		    </section>
			<!-- Tabla -->
			<section class="content">
					<div class="row">						
          				<!-- ./ citas del dia  -->
  						<div class="col-md-6 col-sm-6 col-xs-12">												
								<div class="box box-info">
						            <div class="box-header with-border">
						              	<h3 class="box-title">Citas para hoy </h3>
						            </div><!-- /.box-header -->
										<?php
										if ($privilegio == 1) {
											$sql = "SELECT * FROM citas inner join pacientes ON pacientes.idPaciente = citas.idPaciente order by citas.start ";
										}else{
											$sql = "SELECT * FROM citas inner join pacientes ON pacientes.idPaciente = citas.idPaciente WHERE citas.idPaciente = $idUsuario order by citas.start DESC";
											}
											$result = $mysqli->query($sql);
											
											$row = $result->fetch_all(MYSQLI_ASSOC);
											$num = $result->num_rows;

											$fecha_actual = date("d-m-Y");
											//sumo 1 día
											$masuno = date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
							              		
											foreach ($row as $citas) :
												setlocale(LC_ALL, 'es_ES.utf-8');
												$fechaCita = $citas['start'];
												$dia = strftime('%A',strtotime($fechaCita));
												$fecha = strftime('%d-%m-%G',strtotime($fechaCita));
												$hora = strftime('%R %P',strtotime($fechaCita));

							              		if ($fecha == $fecha_actual){
							             ?>
							              	
						            <div class="box-body">									            	
						             	<div class="info-box">
								            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>
									            <div class="info-box-content">
									            	<div class="col-md-6">
									            		<?php 
									            			if ($privilegio == 1) { ?>

									            				<span class="info-box-text">Paciente: <?php echo $citas['nombre']; ?></span>
									            				<?php		
									            			}
									            		?>
									            		
									            		<span class="info-box-text">Motivo: <?php echo $citas['titulo']; ?></span>
									              		<span class="info-box-number">Fecha: <?php echo $fecha; ?></span>

									            	</div>
									              	<div class="col-md-6">
									              		<span class="info-box-text">Dia: <?php echo $dia; ?></span>
									              		<span class="info-box-number">Hora: <?php echo $hora; ?></span>
									              		
									              	</div>
									            </div><!-- /.info-box-content -->
								        </div><!-- /.info-box -->
						            </div><!-- /.box-body -->

					              	<?php
					              }				              
					          endforeach
					              ?>
				            </div><!-- /.box -->
				        </div><!-- /.col-md-6 -->	
				        <!-- citas para mañana -->
				        <div class="col-md-6 col-sm-6 col-xs-12">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Citas para Mañana </h3>
								</div><!-- /.box-header -->
								<?php
								foreach ($row as $citas) :
										setlocale(LC_ALL, 'es_ES.utf-8');
										$fechaCita = $citas['start'];
										$dia = strftime('%A',strtotime($fechaCita));
										$fecha = strftime('%d-%m-%G',strtotime($fechaCita));
										$hora = strftime('%R %P',strtotime($fechaCita));

										if ($fecha == $masuno){
											
									?>
								<div class="box-body">
									<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="fa fa-calendar"></i></span>
											<div class="info-box-content">
												<div class="col-md-6">
													<?php 
													if ($privilegio == 1) { ?>
														
														<span class="info-box-text">Paciente: <?php echo $citas['nombre']; ?></span>
														<?php		
													}
												?>
													<span class="info-box-text">Motivo: <?php echo $citas['titulo']; ?></span>
													<span class="info-box-number">Fecha: <?php echo $fecha; ?></span>
												</div>
												<div class="col-md-6">
													<span class="info-box-text">Dia: <?php echo $dia; ?></span>
													<span class="info-box-number">Hora: <?php echo $hora; ?></span>
												</div>
											</div><!-- /.info-box-content -->
									</div><!-- /.info-box -->
								</div><!-- /.box-body -->
								<?php
								};
								endforeach;								
								?>
							</div><!-- /.box -->
				        </div><!-- /.col-md-6 -->
				        	<!--citas cumplidas -->
				        	<!-- citas para mañana -->
				        <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h3 class="box-title">Historial de Citas</h3>

											<div class="box-tools pull-right">
								                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
								                </button>
							             	</div><!-- / .box-tools-->										              
										</div><!-- /.box-header -->
										<?php
											

												foreach ($row as $citas) :
													setlocale(LC_ALL, 'es_ES.utf-8');
													$fechaCita = $citas['start'];
													$dia = strftime('%A',strtotime($fechaCita));
													$fecha = strftime('%d/%m/%G',strtotime($fechaCita));
													$hora = strftime('%R %P',strtotime($fechaCita));
								              		//$sgte = strtotime($fecha_actual.'+ 1 day');								              		
								              		if ($fecha < $fecha_actual){
								        ?>
							            <div class="box-body">
							             	<div class="info-box">
									            <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>
										            <div class="info-box-content">
										            	<div class="col-md-6">
										            		<?php 
									            			if ($privilegio == 1) { ?>
									            				
									            				<span class="info-box-text">Paciente: <?php echo $citas['nombre']; ?></span>
									            			<?php		
									            			}
									            			?>	
										            		<?php
										            			if ($num > 1) {
										            		?>
											            		<span class="info-box-text">Motivo: <?php echo $citas['titulo']; ?></span>
											              		<span class="info-box-number">Fecha: <?php echo $fecha; ?></span>
										            	</div>
										              	<div class="col-md-6">
										              		<span class="info-box-text">Dia: <?php echo $dia; ?></span>
										              		<span class="info-box-number">Hora: <?php echo $hora; ?></span>
										              	</div>
										            			
										            		<?php
										            		}else{
										            		?>php
										            		<div class="box-header with-border">
																<h3 class="box-title">No tienes citas registradas en el momento</h3>
																
															</div>
										            		<?php
										            		}
										            		?>
										            		
										            </div><!-- /.info-box-content -->
									        </div><!-- /.info-box -->
							            </div><!-- /.box-body -->
								            <?php
								        	}
								            endforeach
								        
								            ?>
				            		</div><!-- /.box -->
				        </div><!-- /.col-md-12 -->
					</div><!--/.row -->
			</section>
			
	 </div>
	
	<?php include '../views/partials/modals.php'; ?>
		<!--Footer   -->
	 <footer class="main-footer">
		    <!-- To the right -->
		    <div class="pull-right hidden-xs">
		       Calle larios, 29001 - Urbanización alameda - Málaga Capital
		    </div>
		    <!-- Default to the left -->
		    <strong>Copyright &copy; 2019 <a href="#">Centro de Reservas</a>.</strong> Todos los derechos reservados
	 </footer>
</div>

	<!-- Latest compiled and minified JavaScript -->
 
<script src='bower_components/jquery/dist/jquery.min.js'></script>
<script src='bower_components/moment/moment.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<script src='bower_components/fullcalendar/dist/locale-all.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<script src="dist/js/adminlte.js"></script>
	<script src="dist/js/demo.js"></script>
 <script src="dist/js/alertify.js"></script>
 
</body>
</html>

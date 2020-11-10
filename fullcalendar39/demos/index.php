<?php
session_start();

if (isset($_SESSION['tipo_usuario'])) {
?>
		<!DOCTYPE html>
		<html>
		<head>
			<style>			
				.nover{
					display: none;
				}
				img{
					width: 100%;
					height: auto;
				}			 
			</style>

			<script src="../../js/jquery.min.js"></script>
			<!-- custom scripts --> 
			<!-- bootstrap -->
			<script src="../../js/bootstrap.min.js" crossorigin="anonymous"></script>
			<link  href="../../css/bootstrap.min.css" rel="stylesheet" >
			<!-- fullcalendar -->
			<link href="../../css/fullcalendar.css" rel="stylesheet" />
			<link href="../../css/fullcalendar.print.css" rel="stylesheet" media="print" />
			
			<link rel="stylesheet" href="../../css/alertify.core.css"/>
			<link rel="stylesheet" href="../../css/alertify.default.css"/>
			<script src="../../js/alertify.js"></script>
			
		</head>
		<body>
<div class="container">			
			<!--<input type='hidden' id="sesionInstructor" value="<php echo $_SESSION['tipo_usuario']?>">-->
			
			<br><div id="calendarioweb"></div>
		
		<!-- Ventana modal para agregar y eliminar eventos/Horarios -->
		<?php
		include 'modalhorario.php';		
		?>
		 <?php
			if ($_SESSION['tipo_usuario']==2){			
		 ?>
			<button id="ConfigHoras" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ModalConfiguracionHoras" style="margin-top: 20px">Generar Horario</button>
			<input type='hidden' id="sesionInstructor" value="<?php echo $_SESSION['tipo_usuario']?>">
			
			<script type="text/javascript" src="../../js/calendario.js"></script> 
			<?php
			}			
			?>
			<img id="vacio"class="nover" src="../../img/obra3.png" alt="calendariovacio">						
			<script type="text/javascript" src="../../js/pacientes.js"></script>
</div>

			<script src="../../js/moment.min.js"></script>
			<script src="../../js/locale-all.js"></script>
			<script src="../../js/fullcalendar.js"></script>
			
		</body>
		</html>
		
<?php		
}
else
{
	header("location:index.php");
}






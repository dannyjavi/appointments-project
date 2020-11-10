<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../views/dist/img/logofinal3.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            <?php echo utf8_decode($row['nombreCompleto']);?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Principal</li>
              <?php if ($_SESSION['tipo_paciente'] == 1) {          ?>            
                          <!-- admin -->
                          <li><a href="/views/horario.php"><i class="fa fa-calendar"></i> <span>Agenda</span></a></li>
                          <li><a href="/views/miscitas.php"><i class="fa fa-list"></i> <span>Mis Citas</span></a></li>
                          <li><a href="/admin.php"><i class="fa fa-users"></i> <span>Pacientes</span></a></li>
                          <li><a href="#"><i class="fa fa-history"></i> <span>Historial</span></a></li>
                          <li class="header">REPORTES</li>
                          <li><a href="#"><i class="fa fa-file-pdf-o"></i> <span>Facturas</span></a></li>
                          <li><a href="#"><i class="fa fa-envelope"></i> <span>Enviar mensajes</span></a></li>
                          <li><a href="#"><i class="fa fa-check"></i> <span>Confirmar Citas</span></a></li>
                        
              <?php
    }
    else { ?>
             <!-- Optionally, you can add icons to the links -->
            <li><a href="/views/horario.php"><i class="fa fa-calendar"></i> <span>Reservar Cita</span></a></li>
            <li><a href="/views/miscitas.php"><i class="fa fa-list"></i> <span>Mis Citas</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-refresh" aria-hidden="true"></i> <span>Actualizar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/views/datosPersonales.php">Datos personales</a></li>
                </ul>
            </li>
<?php } ?>
            <li><a href="../../controllers/logout.php"><i class="fa fa-sign-out"></i> <span>Salir</span></a></li>
        </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>


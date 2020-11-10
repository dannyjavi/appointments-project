<!-- Logo -->
<a href="/index.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>M</b> Proyecto onez</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Centro</b> Proyecto one</span>
</a>

    <!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning"></span><!--pendiente para cuando se ponga esta parte -->
                </a>
                <ul class="dropdown-menu">
                    <li class="header">Notificaciones vacias</li>
                    <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                        <li><!-- start notification -->
                        <a href="#">
                            <i class="fa fa-users text-aqua"></i>Pendiente
                        </a>
                        </li>
                        <!-- end notification -->
                    </ul>
                    </li>
                    <li class="footer"><a href="#">ver Todo</a></li>
                </ul>
            </li>
            <!-- Tasks Menu -->        
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="../views/dist/img/logofinal3.png" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs"><?php echo utf8_decode($row['nombreCompleto']);?></span>
                </a>        
            </li>
        </ul>
    </div>
</nav>
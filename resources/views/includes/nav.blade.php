<header>
    <nav class="nav navbar navbar-default menu-nav">

        <div class="container-fluid">

            <div class="navbar-header d-flex align-items-center">
                <div class="navebar-brand" id="toggleMenu">
                    <i class="fa fa-bars fa-lg fa-fw"></i>
                </div>
                <!-- <a class="navbar-brand" href="/soft2beCorporation" style="font-size: 10pt;"><i>S2Credit v5.0</i></a> -->
            </div>

            <p class="navbar-text">FINSUS</p>

            <div class="collapse navbar-collapse navbar-right">

                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-bell fa-lg fa-fw"></i>
                            <i style="font-size:0.7em;" class="badge badge-notify"></i>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a>
                                    <div style="width:500px;">
                                        <span style="font-size:1.0em;" class="glyphicon glyphicon-bell"
                                            aria-hidden="true"></span>
                                        <strong>Sin alerta</strong>
                                        <span class="pull-right text-muted"></span>
                                    </div>
                                    <div>No hay alertas nuevas</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" id="menu_perfil"
                            data-toggle="dropdown">
                            <i class="fa fa-user-circle-o fa-lg fa-fw" aria-hidden="true"></i><i
                                class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu menu_perfil">
                            <li><a title="USUARIO"><i class="fa fa-user-circle fa-fw"></i> Hola 2</a></li>
                            <li><a title="PERFIL"><i class="fa fa-users fa-fw"></i>Hola 3</a></li>
                            <li><a title="SUCURSAL"><i class="fa fa-building fa-fw"></i>Hola 4</a></li>


                            <li role="separator" class="divider"></li>
                            <!-- <li><a href="#" onclick="show_menu();"><span id="action_menu">Ocultar menú</span></a></li> -->
                            <li><a href="#" id="cambia_perfil" onclick="cambioSesion();" id="cambioSesion"> <i
                                        class="fa fa-refresh fa-fw"></i> CAMBIAR SESSIÓN</a></li>
                            <!-- <li><a href="#" class="viewDescargas" > <i class="fa fa-download fa-fw"></i> DESCARGAS</a></li>-->
                            <li><a href="logout.php"> <i class="fa fa-sign-out  fa-fw"></i> CERRA SESIÓN </a></li>
                        </ul>
                    </li>

                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>

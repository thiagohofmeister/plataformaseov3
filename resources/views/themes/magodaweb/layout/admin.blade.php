<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        @if (!empty($Seo->meta_tags))
            @foreach ($Seo->meta_tags as $meta)
                {!! $meta !!}
            @endforeach
        @endif

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset(ASSET . 'bower_components/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset(ASSET . 'bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="{{ asset(ASSET . 'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{{ asset(ASSET . 'bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset(ASSET . 'dist/css/sb-admin-2.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset(ASSET . 'bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.8.0/css/alertify.min.css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">{{ SITENAME }}</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <?php /*
                      <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-messages">
                      <li>
                      <a href="#">
                      <div>
                      <strong>John Smith</strong>
                      <span class="pull-right text-muted">
                      <em>Yesterday</em>
                      </span>
                      </div>
                      <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <strong>John Smith</strong>
                      <span class="pull-right text-muted">
                      <em>Yesterday</em>
                      </span>
                      </div>
                      <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <strong>John Smith</strong>
                      <span class="pull-right text-muted">
                      <em>Yesterday</em>
                      </span>
                      </div>
                      <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a class="text-center" href="#">
                      <strong>Read All Messages</strong>
                      <i class="fa fa-angle-right"></i>
                      </a>
                      </li>
                      </ul>
                      <!-- /.dropdown-messages -->
                      </li>
                      <!-- /.dropdown -->
                      <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-tasks">
                      <li>
                      <a href="#">
                      <div>
                      <p>
                      <strong>Task 1</strong>
                      <span class="pull-right text-muted">40% Complete</span>
                      </p>
                      <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      <span class="sr-only">40% Complete (success)</span>
                      </div>
                      </div>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <p>
                      <strong>Task 2</strong>
                      <span class="pull-right text-muted">20% Complete</span>
                      </p>
                      <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                      <span class="sr-only">20% Complete</span>
                      </div>
                      </div>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <p>
                      <strong>Task 3</strong>
                      <span class="pull-right text-muted">60% Complete</span>
                      </p>
                      <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                      <span class="sr-only">60% Complete (warning)</span>
                      </div>
                      </div>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <p>
                      <strong>Task 4</strong>
                      <span class="pull-right text-muted">80% Complete</span>
                      </p>
                      <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                      <span class="sr-only">80% Complete (danger)</span>
                      </div>
                      </div>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a class="text-center" href="#">
                      <strong>See All Tasks</strong>
                      <i class="fa fa-angle-right"></i>
                      </a>
                      </li>
                      </ul>
                      <!-- /.dropdown-tasks -->
                      </li>
                      <!-- /.dropdown -->
                      <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-alerts">
                      <li>
                      <a href="#">
                      <div>
                      <i class="fa fa-comment fa-fw"></i> New Comment
                      <span class="pull-right text-muted small">4 minutes ago</span>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                      <span class="pull-right text-muted small">12 minutes ago</span>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <i class="fa fa-envelope fa-fw"></i> Message Sent
                      <span class="pull-right text-muted small">4 minutes ago</span>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <i class="fa fa-tasks fa-fw"></i> New Task
                      <span class="pull-right text-muted small">4 minutes ago</span>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a href="#">
                      <div>
                      <i class="fa fa-upload fa-fw"></i> Server Rebooted
                      <span class="pull-right text-muted small">4 minutes ago</span>
                      </div>
                      </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                      <a class="text-center" href="#">
                      <strong>See All Alerts</strong>
                      <i class="fa fa-angle-right"></i>
                      </a>
                      </li>
                      </ul>
                      <!-- /.dropdown-alerts -->
                      </li>
                      <!-- /.dropdown -->
                     */ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <?php /*
                              <li>
                              <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                              </li>
                              <li>
                              <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                              </li>
                              <li class="divider"></li>
                             */ ?>
                            <li>
                                <a href="{{ url('/admin/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="{{ url('/admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/leads') }}"><i class="fa fa-trophy fa-fw"></i> Leads</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/seo-guia') }}"><i class="fa fa-wrench fa-fw"></i> Guia SEO</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-newspaper-o fa-fw"></i> Postagens<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('admin/posts/add') }}">Nova Postagem</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/posts') }}">Publicados</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/posts/rascunhos') }}">Rascunhos</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-asterisk fa-fw"></i> Categorias<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('admin/categorias/add') }}">Nova Categoria</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/categorias') }}">Lista</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-tags fa-fw"></i> Tags<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('admin/tags/add') }}">Nova Tag</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/tags') }}">Lista</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Áreas de Conteúdo<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('admin/tipoconteudos/add') }}">Cadastrar</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/tipoconteudos') }}">Áreas</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Conteúdos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('admin/conteudos/add') }}">Cadastrar</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/conteudos') }}">Tópicos</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-comment-o fa-fw"></i> Comentários<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('admin/comentarios') }}">Lista</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-search fa-fw"></i> SEO <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('admin/seo-site') }}">O Site</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/paginas-seo/add') }}">Cadastrar Página</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/paginas-seo') }}">Lista Páginas</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div>
                @yield('conteudo')
            </div>
            <!-- jQuery -->
            <script src="{{ asset(ASSET . 'bower_components/jquery/dist/jquery.min.js') }}"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="{{ asset(ASSET . 'bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="{{ asset(ASSET . 'bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

            <!-- DataTables JavaScript -->
            <script src="{{ asset(ASSET . 'bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset(ASSET . 'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

            <!-- Editor de Textos -->
            <script src="{{ asset(ASSET . 'js/plugins/ckeditor/ckeditor.js') }}"></script>

            <!-- Alert personalizado -->
            <script src="//cdn.jsdelivr.net/alertifyjs/1.8.0/alertify.min.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="{{ asset(ASSET . 'dist/js/sb-admin-2.js') }}"></script>

            <!-- Page-Level Demo Scripts - Tables - Use for reference -->
            <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
            </script>

            <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
                CKEDITOR.replace('ckeditor_pers');
            </script>
            
            <script src="{{ asset(ASSET . 'js/geral.js') }}"></script>
            @yield('js')
    </body>
</html>
@extends(TM . 'layout/admin')

@section('conteudo')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <!--main content start-->
        <section class="main-content-wrapper">
            <div class="pageheader">
                <h1>Gerenciar Categorias</h1>
            </div>
            <section id="main-content" class="animated fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Listagem, edição e adição de categorias</h3>

                            </div>
                            <div class="panel-body table-responsive">
                                <div class="tab-wrapper tab-left ">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#categorias" data-toggle="tab" aria-expanded="true">
                                                <span class="fa fa-list" title="Lista Categorias"></span> 
                                                <span class="hidden-xs">Lista Categorias</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Inicio INPUTS -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="categorias">
                                            <!-- /.panel-heading -->
                                            <div class="panel-body">
                                                <div class="row">
                                                    @if (count($errors) > 0)
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif

                                                    @if (session('msg'))
                                                    <div class="alert alert-success">
                                                        <ul>      
                                                            <li>{{ session('msg') }}</li>
                                                        </ul>
                                                    </div>
                                                    @endif
                                                    <!-- /.col-lg-12 -->
                                                </div>
                                                <div class="panel panel-default">

                                                    <!-- /.panel-heading -->
                                                    <div class="panel-body">
                                                        <div class="dataTable_wrapper">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Imagem</th>
                                                                        <th>Nome</th>
                                                                        <th>Slug</th>
                                                                        <th>Status</th>
                                                                        <th>Ação</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($Categorias as $Cat)
                                                                    <tr>
                                                                        <td class="img-responsive"><img src="{{ url($Cat->seo_open_graph) }}" alt="" width="100px"></td>
                                                                        <td>{{ $Cat->nome }}</td>
                                                                        <td>{{ $Cat->slug }}</td>
                                                                        <td><a href="{{ url('admin/categorias/status/' . $Cat->id) }}" class="btn btn-{{ $Cat->status == 1 ? 'success' : 'danger' }} btn-xs">{{ $Cat->status == 1 ? 'Ativo' : 'Inativo' }}</a></td>
                                                                        <td class="center">
                                                                            <a href="{{ url('admin/categorias/edit/' . $Cat->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                                            <a href="javascript:void(0)" data-ref="{{ url('admin/categorias/delete/' . $Cat->id) }}" class="btn btn-danger btn-circle confirm-delete"><i class="fa fa-times"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="text-center">
                                                            <ul class="pagination">
                                                                <li class="disabled"><span>&laquo;</span></li> 
                                                                <li class="active"><span>1</span></li>
                                                                <li><a href="#">2</a></li>
                                                                <li><a href="#">3</a></li>
                                                                <li><a href="#">4</a></li>
                                                                <li><a href="#" rel="next">&raquo;</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- /.panel-body -->
                                                </div>
                                                <!-- /.panel-body -->
                                            </div>
                                            <!-- /.panel -->
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>
        </section>
        <!--main content end-->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
@stop

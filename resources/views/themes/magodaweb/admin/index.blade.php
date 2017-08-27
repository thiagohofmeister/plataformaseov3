@extends(TM . 'layout.admin')

@section('conteudo')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $Comentarios }}</div>
                            <div>Comentários no Blog</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('admin/comentarios') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Ver todos</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $TotalPosts }}</div>
                            <div>Postagens ao total</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('admin/posts') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Ver todos</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-thumbs-o-up fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">-1</div>
                            <div>Visitas Hoje</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver no Analytics</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">-1</div>
                            <div>Tickets em Aberto</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver todos</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Postagens Recentes</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Visualize as postagens do seu Blog!
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <!-- <th>Imagem</th> -->
                                            <th>Imagem</th>
                                            <th>Título</th>
                                            <th>Categoria</th>
                                            <th>SEO</th>
                                            <th>Data</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($Posts) > 0)
                                        @foreach ($Posts as $Post)
                                        <tr class="even">
                                            <td class="img-responsive"><img src="{{ url($Post->seo_open_graph ? $Post->seo_open_graph : $Post->imagem) }}" width="100" alt="{{ $Post->titulo }}"></td>
                                            <td>{{ $Post->titulo }}{{ $Post->status == 'r' ? "<i>(rascunho)</i>" : '' }}</td>
                                            <td>{{ $Post->categoria }}</td>
                                            <td><button type="button" class="btn btn-{{ $Post->possui_seo == 's' ? 'success' : 'danger' }} btn-xs">{{ $Post->possui_seo == 's' ? 'Sim' : 'Não' }}</button></td>
                                            <td>{{ date('d/m/Y H:i', strtotime($Post->data_postagem)) }}</td>
                                            <td class="center">
                                                <a href="{{ url('admin/posts/edit/'.$Post->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url('admin/pages/post-novo.php?postid={$Post->id}') }}" class="btn btn-{{ $Post->status == 'i' ? 'success' : 'danger'}} btn-circle"><i class="fa fa-{{ $Post->status == 'i' ? 'check' : 'times' }}"></i></a>
                                                @if ($Post->status == 'i')
                                                <a href="{{ url('admin/pages/post-novo.php?exe=delete&postid={$Post->id}') }}" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>


                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div> 
            <!-- /panel-default -->
        </div>
        <!-- /col-lg-12 -->
    </div>
    <!-- /row -->
</div>
@stop
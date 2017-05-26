@extends(TM . 'layout.admin')


@section('conteudo')
<!-- Navigation -->
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Comentários - Lista</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lista de todos os comentários do site
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Autor</th>
                                            <th>E-mail</th>
                                            <th>Data</th>
                                            <th>Postagem</th>
                                            <th>Status</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($Comentarios) > 0)
                                        @foreach ($Comentarios as $Comentario)
                                        <tr class="even">
                                            <td>{{ $Comentario->nome_autor }}</td>
                                            <td>{{ $Comentario->email }}</td>
                                            <td>{{ date('d/m/Y H:i', strtotime($Comentario->data_comentario)) }}</td>
                                            <td><a href="{{ url($Comentario->categoria_slug . '/' . $Comentario->post_slug) }}" title="{{ $Comentario->post_titulo }}" target="_blank">{{ $Comentario->post_titulo }}</a></td>
                                            <td><a href="{{ url('admin/comentarios/toggleStatus/' . $Comentario->id) }}" class="btn btn-{{ $Comentario->status == 'a' ? 'success' : 'danger' }} btn-xs">{{ $Comentario->status == 'a' ? 'Ativo' : ($Comentario->status == 'n' ? 'Novo' : 'Inativo') }}</a></td>
                                            <td class="center">
                                                <a href="{{ url('admin/comentarios/edit/' . $Comentario->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>

                                                <a href="{{ url('admin/comentarios/delete/' . $Comentario->id) }}" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>
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
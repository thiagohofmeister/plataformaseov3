@extends(TM . 'layout/admin')

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
                            <h1 class="page-header">Conteúdos - Lista</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lista de todas conteúdos do site
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Imagem</th>
                                            <th>Título</th>
                                            <th>Link</th>
                                            <th>Área</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Conteudos as $Conteudo)
                                        <tr>
                                            <td class="img-responsive"><img src="{{ url($Conteudo->imagem) }}" width="100px" alt="{{ $Conteudo->titulo }}"></td>
                                            <td>{{ $Conteudo->titulo }}</td>
                                            <td>{!! !empty($Conteudo->link_url) ? "<a href='$Conteudo->link_url' target='_blank'>$Conteudo->link</a>" : '-' !!}</td>
                                            <td>{{ $Conteudo->area }}</td>
                                            <td class="center">
                                                <a href="{{ url('admin/conteudos/edit/'. $Conteudo->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url('admin/conteudos/delete/'.$Conteudo->id) }}" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
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
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
                            <h1 class="page-header">Postagens - Lista</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lista de todas postagens do site
                        </div>
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
                                        @foreach ($Posts as $Post)
                                        <tr class="even">
                                            <td class="img-responsive"><img src="{{ url($Post->imagem) }}" width="100px" alt="{{ $Post->titulo }}"></td>
                                            <td>{{ $Post->titulo }}{!! $Post->status == \App\Enum\Post\Status::DRAFT ? " <i>(rascunho)</i>" : '' !!}</td>
                                            <td>{{ $Post->categoria }}</td>
                                            <td><button type="button" class="btn btn-{{ $Post->possui_seo == \App\Enum\Post\Status::PUBLISHED ? 'success' : 'danger' }} btn-xs">{{ $Post->possui_seo == 's' ? 'Sim' : 'Não' }}</button></td>
                                            <td><?= date('d/m/Y H:i', strtotime($Post->data_postagem)); ?></td>
                                            <td class="center">
                                                <a href="{{ url('admin/posts/edit/'. $Post->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0)" data-ref="{{ url('admin/posts/delete/' . $Post->id) }}" class="btn btn-danger btn-circle confirm-delete"><i class="fa fa-times"></i></a>
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
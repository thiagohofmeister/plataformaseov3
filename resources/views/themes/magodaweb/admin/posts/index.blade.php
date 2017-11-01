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
                                        @each(TM . 'admin.components.post', $Posts, 'Post')
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
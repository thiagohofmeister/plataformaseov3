@extends(TM . 'layout.admin')

@section('conteudo');
<!-- Navigation -->
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">SEO - Listagem de Configurações</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lista de todas otimizações de postagens
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="20%">Imagem</th>
                                            <th>Título</th>
                                            <th>Descrição</th>
                                            <th width="10%">Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($PaginasSeo) > 0)
                                        @foreach ($PaginasSeo as $Pagina)
                                        <tr class="even ">
                                            <td class="img-responsive">
                                                <img src="{{ url($Pagina->seo_open_graph) }}" width="200px" />
                                            </td>
                                            <td>{{ $Pagina->seo_title }}</td>
                                            <td>{{ $Pagina->seo_description }}</td>
                                            <td class="center">
                                                <a href="{{ url('admin/paginas-seo/edit/' . $Pagina->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url('admin/paginas-seo/delete/' . $Pagina->id) }}" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>
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
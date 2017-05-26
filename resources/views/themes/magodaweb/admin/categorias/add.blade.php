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
                                                <span class="hidden-xs">Cadastrar Categoria</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Inicio INPUTS -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="novoPostCategoria">
                                            <form action="{{ url('admin/categorias/add/') }}" method="POST" accept-charset="UTF-8" class="form-horizontal" role="form" novalidate="novalidate" id="formEdit" name="formEdit" enctype="multipart/form-data">
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

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Nome *:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="Digite um nome" name="nome" type="text" value="{{ old('nome') }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="imageInput" class="col-sm-2 control-label">Imagem Principal:</label>
                                                    <div class="col-sm-10">
                                                        <input name="seo_open_graph" type="file">
                                                        <span class="help-block">
                                                            Tamanho de imagem recomendado: 1000px X 200px
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Conteúdo:</label>
                                                    <div class="col-sm-10 text-editor">
                                                        <textarea class="form-control" rows="3" id="ckeditor_pers" name="descricao" placeholder="Solte os dedos, vamos lá!">{{ old('descricao') }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Meta Title:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" maxlength="65" placeholder="Digite um meta title" name="seo_title" type="text" value="{{ old('seo_title') }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Meta Description:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" maxlength="156" placeholder="Digite um meta description" name="seo_description" type="text" value="{{ old('seo_description') }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Spam Text:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="Digite um spam text" name="seo_spam_text" maxlength="180" type="text" value="{{ old('seo_spam_text') }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button class="btn btn-success" type="submit" data-loading-text="...">Cadastrar</button>
                                                        <button class="btn btn-danger" type="reset" data-loading-text="...">Limpar</button>
                                                    </div>
                                                </div>
                                                
                                                {{ CSRF_FIELD() }}
                                            </form>
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

@extends(TM . 'layout/admin')

@section('conteudo')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <!--main content start-->
        <section class="main-content-wrapper">
            <div class="pageheader">
                <h1>Editar Postagem</h1>

            </div>
            <section id="main-content" class="animated fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Preencha os campos abaixo para produzir uma nova Postagem</h3>
                            </div>
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
                            <div class="panel-body table-responsive">
                                <form method="POST" accept-charset="UTF-8" class="form-horizontal" role="form" novalidate="novalidate" id="formEdit" name="formEdit" enctype="multipart/form-data">

                                    <div class="tab-wrapper tab-left ">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#novoPost" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="Nova Postagem"></span> 
                                                    <span class="hidden-xs">Nova Postagem</span>
                                                </a>
                                            </li>
                                            <li class="unactive">
                                                <a href="#seo" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="SEO"></span> 
                                                    <span class="hidden-xs">SEO da Postagem</span>
                                                </a>
                                            </li>
                                            <?php /* ?>
                                            <li class="unactive">
                                                <a href="#tag" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="Tag"></span> 
                                                    <span class="hidden-xs">Tags</span>
                                                </a>
                                            </li>
                                            <?php */ ?>
                                        </ul>
                                        <!-- Inicio INPUTS -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="novoPost">
                                                <div class="form-group">
                                                    <label for="imageInput" class="col-sm-2 control-label">
                                                        Imagem Principal:
                                                        @if (!empty($Post->imagem))
                                                        <a href="{{ url($Post->imagem) }}" target="_blank">Ver atual</a>
                                                        @endif
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input name="imagem" type="file">
                                                        <span class="help-block">
                                                            Tamanho de imagem recomendado: 1000px X 200px
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Título *:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="Digite um título" name="titulo" type="text" value="{{ $Post->titulo }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Categoria *:</label>
                                                    <div class="col-sm-10">
                                                        @if (count($Categorias) > 0)
                                                        <select id="disabledSelect" name="id_categoria" class="form-control">
                                                            <option value="-1">Escolha</option>
                                                            @foreach ($Categorias as $Categoria)
                                                            <option value="{{ $Categoria->id }}" {{ $Post->id_categoria == $Categoria->id ? "selected='selected'" : '' }}>{{ $Categoria->nome }}</option>
                                                            @endforeach
                                                        </select>
                                                        @endif

                                                        @if (!empty($CategoriaInativa))
                                                        <div class="has-error">
                                                            <span class = "help-block">
                                                                A categoria <strong>{{ $CategoriaInativa }}</strong> está <u>desativada</u>, favor selecionar outra para que a postagem apareça no site.
                                                            </span>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <?php /*
                                                  <div class="form-group">
                                                  <label class="col-sm-2 control-label">Slug *:</label>
                                                  <div class="col-sm-10">
                                                  <input class="form-control" placeholder="dominio.com.br/categoria/nome-da-postagem" name="slug" type="text" value="<?= !empty($post['slug']) ? $post['slug'] : ''; ?>">
                                                  </div>
                                                  </div> */ ?>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Migalha:</label>
                                                    <div class="col-sm-10"> 
                                                        <input class="form-control" placeholder="Home > Categoria > Título da Postagem" name="migalha" type="text" value="{{ $Post->migalha }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Conteúdo:</label>
                                                    <div class="col-sm-10 text-editor">
                                                        <textarea name="conteudo" class="form-control" id="ckeditor_pers" rows="3" placeholder="Solte os dedos, vamos lá!">{{ $Post->conteudo }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="seo">
                                                <div class="form-group">
                                                    <label for="nameInput" class="col-sm-2 control-label">Title:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" maxlength="65" placeholder="Seo Title" name="seo_title" type="text" value="{{ $Post->seo_title }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nameInput" class="col-sm-2 control-label">Meta Description:</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" maxlength="156" placeholder="Seo Meta Description" rows="3" name="seo_description" cols="50">{{ $Post->seo_description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nameInput" class="col-sm-2 control-label">Spam Text:</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" placeholder="Seo Spam Text" rows="3" name="seo_spam_text" maxlength="180" cols="50">{{ $Post->seo_spam_text }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="imageInput" class="col-sm-2 control-label">
                                                        Imagem OpenGraph:<br>
                                                        @if (!empty($Post->seo_open_graph))
                                                        <a href="{{ url($Post->seo_open_graph) }}" target="_blank">Ver atual</a>
                                                        @endif
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input name="seo_open_graph" type="file">
                                                        <span class="help-block">
                                                            Tamanho de imagem recomendado: 640px x 480px - Proporção: (3:2)
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tag">
                                                <div class="form-group">
                                                    <label for="nameInput" class="col-sm-2 control-label">Buscar Tags:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" maxlength="65" placeholder="Nome da Tag" id="ctrBuscarTags" name="Tags" type="text" value="">
                                                        <div class="search-content-tags">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{ CSRF_FIELD() }}

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-success" name="status" value="1" type="submit" data-loading-text="...">Atualizar</button>
                                            <button class="btn btn-success" name="status" value="0" type="submit" data-loading-text="...">Salvar Rascunho</button>
                                            <button class="btn btn-danger" type="reset" data-loading-text="...">Limpar</button>
                                        </div>
                                    </div>
                            </div>
                            </form>

                            <div class="panel-body table-responsive">
                                <form method="POST" accept-charset="UTF-8" class="form-horizontal" role="form" novalidate="novalidate" id="formUpload" name="formUpload" enctype="multipart/form-data">

                                    <div class="tab-wrapper tab-left ">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#novoPost" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="Nova Postagem"></span> 
                                                    <span class="hidden-xs">Nova Imagem</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Inicio INPUTS -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="novoPost">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Título *:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="Digite um título" name="titulo_imagem_upload" type="text" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="imageInput" class="col-sm-2 control-label">Imagem:</label>
                                                    <div class="col-sm-10">
                                                        <input name="imagem_upload" type="file">
                                                        <span class="help-block">
                                                            Tamanho de imagem recomendado: 640px x 480px - Proporção: (3:2)
                                                        </span>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    {{ CSRF_FIELD() }}

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <a href="javascript:void(0);" class="btn btn-success" id="ctrEnviarUpload">Upload</a>
                                        </div>
                                    </div>
                                </form>
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


@section('js')
<!-- Upload Via Ajax -->
<script src="{{ asset(ASSET . 'js/upload.js') }}"></script>
<!-- Buscar Tags Via Ajax 
    <script src="../js/tags.js"></script>-->
@stop
@extends(TM . 'layout/admin')

@section('conteudo')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <!--main content start-->
        <section class="main-content-wrapper">
            <div class="pageheader">
                <h1>Seo do Site</h1>

            </div>
            <section id="main-content" class="animated fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Preencha os campos abaixo, insira Tags e Scripts</h3>
                            </div>

                            <div class="panel-body table-responsive">
                                <form method="POST" accept-charset="UTF-8" class="form-horizontal" role="form" novalidate="novalidate" id="formEdit" name="formEdit" enctype="multipart/form-data">

                                    <div class="tab-wrapper tab-left ">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#novoPost" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="Nova Postagem"></span> 
                                                    <span class="hidden-xs">Insira Tags e Scripts</span>
                                                </a>
                                            </li>

                                        </ul>
                                        <!-- Inicio INPUTS -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="novoPost">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">H1 (title da index):</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" maxlength="65" placeholder="Digite um h1 para a index" name="h1" type="text" value="{{ $Seo->seo_title }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Slogan:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="Digite um slogan" name="slogan" type="text" value="{{ $Seo->slogan }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Descrição:</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" maxlength="150" name="descricao" rows="3" placeholder="">{{ $Seo->seo_description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Spam Text:</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" maxlength="150" name="descricao" rows="3" placeholder="">{{ $Seo->seo_spam_text }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Tema do Site:</label>
                                                    <div class="col-sm-10">
                                                        <select id="disabledSelect" name="tema" class="form-control">
                                                            <option value="-1">Escolha</option>
                                                            @foreach ($Themes as $theme)
                                                                <option {{ $theme != $Seo->tema ? '' : "selected=selected" }} value="{{ $theme }}">{{ $theme }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">E-mail de Contato:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="contato@seudominio.com.br" name="email" type="text" value="{{ $Seo->email }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Domínio do site:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="http://www.seudominio.com.br/" name="baseUrl" type="text" value="{{ $Seo->base_url }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Facebook (fanpage):</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="http://facebook.com/SUAFANPAGE" name="facebook" type="text" value="{{ $Seo->facebook }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Twitter (username):</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="http://twitter.com/USERNAME" name="twitter" type="text" value="{{ $Seo->twitter }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">GooglePlus (perfil):</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="https://plus.google.com/+USERNAME" name="googleplus" type="text" value="{{ $Seo->googleplus }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Youtube (channel):</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="http://youtube.com/SEUCANAL" name="youtube" type="text" value="{{ $Seo->youtube }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Acima do Header</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="tagsHead" rows="3" placeholder="">{{ $Seo->tags_head }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Dentro do Body</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="tagsBody" rows="3" placeholder="">{{ $Seo->tags_body }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">No Rodapé</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="tagsFoot" rows="3" placeholder="">{{ $Seo->tags_foot }}</textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-success" type="submit" data-loading-text="...">Salvar</button>
                                            <button class="btn btn-danger" type="reset" data-loading-text="...">Limpar</button>
                                        </div>
                                    </div>
                                </div>


                            </form>

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
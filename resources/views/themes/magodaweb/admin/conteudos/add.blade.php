<?php
session_start();
require('../../_app/config.inc.php');

//Validação de nível de acesso
$login = new Login(3);
if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('location: ../index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin'];
endif;

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($post['SendFormPost'])):
    unset($post['SendFormPost']);

    if (empty($post['link'])):
        unset($post['link']);
    endif;

    // Declara a Imagem Principal
    $post['imagem'] = ( $_FILES['imagem']['tmp_name'] ? $_FILES['imagem'] : null );

    // Valida se o Tipo Conteudo foi selecionado
    if ($post['idTipoConteudo'] == '-1'):
        $post['idTipoConteudo'] = '';
    endif;

    $postCadastra = new Conteudo;
    $postCadastra->ExeCreate($post);
endif;

//Header
View::elemento('../../_mvc/header');
//Menus
View::elemento('../../_mvc/menus');
?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <!--main content start-->
        <section class="main-content-wrapper">
            <div class="pageheader">
                <h1>Gerenciar Conteúdos</h1>

            </div>
            <section id="main-content" class="animated fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Aqui você pode criar, editar, listar e excluir seções de conteúdo.</h3>
                            </div>
                            <?php
                            if (!empty($post))
                                SAErro($postCadastra->getError()[0], $postCadastra->getError()[1]);
                            ?>
                            <div class="panel-body table-responsive">
                                <form method="POST" accept-charset="UTF-8" class="form-horizontal" role="form" novalidate="novalidate" id="formEdit" name="formEdit" enctype="multipart/form-data">

                                    <div class="tab-wrapper tab-left ">
                                        <ul class="nav nav-tabs">

                                            <li class="active">
                                                <a href="#lista" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="SEO"></span> 
                                                    <span class="hidden-xs">Lista Conteúdos</span>
                                                </a>
                                            </li>
                                            <li class="unactive">
                                                <a href="#novo" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="Nova Postagem"></span> 
                                                    <span class="hidden-xs">Novo Conteúdo</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Inicio INPUTS -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="lista">
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                    <div class="row">

                                                        <!-- /.col-lg-12 -->
                                                    </div>
                                                    <div class="panel panel-default">

                                                        <!-- /.panel-heading -->
                                                        <div class="panel-body">
                                                            <div class="dataTable_wrapper">
                                                                <table class="table table-striped table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th>Slug</th>
                                                                            <th>Ação</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $read = new Read;
                                                                        $read->ExeRead('Conteudo', "ORDER BY titulo ASC");
                                                                        $Areas = $read->getResult();

                                                                        if ($Areas):
                                                                            View::elemento('../../_mvc/conteudos_list', $Areas);
                                                                        endif;
                                                                        ?>
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
                                            <div class="tab-pane unactive" id="novo">
                                                <div class="form-group">
                                                    <label for="imageInput" class="col-sm-2 control-label">Imagem Principal:</label>
                                                    <div class="col-sm-10">
                                                        <input name="imagem" type="file">
                                                        <span class="help-block">
                                                            Tamanho de imagem recomendado: 640px x 480px - Proporção: (3:2)
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Título *:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="Digite um título" name="titulo" type="text" value="<?= !empty($post['titulo']) ? $post['titulo'] : ''; ?>">
                                                    </div>
                                                </div>                                                            
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Slug *:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="Digite um slug" name="slug" type="text" value="<?= !empty($post['slug']) ? $post['slug'] : ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Área *:</label>
                                                    <div class="col-sm-10">
                                                        <?php
                                                        $readCont = new Read;
                                                        $readCont->ExeRead('TipoConteudo');
                                                        ?>
                                                        <select id="disabledSelect" name="idTipoConteudo" class="form-control">
                                                            <option value="-1">Escolha</option>
                                                            <?php
                                                            if ($readCont->getRowCount()):
                                                                foreach ($readCont->getResult() as $conteudo):
                                                                    extract($conteudo);
                                                                    ?>
                                                                    <option value="<?= $idTipoConteudo; ?>" <?= !empty($post['idTipoConteudo']) && $post['idTipoConteudo'] == $idCategoria ? "selected='selected'" : ''; ?>><?= $descricao; ?></option>
                                                                    <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Link:</label>
                                                    <div class="col-sm-10"> 
                                                        <input class="form-control" placeholder="http://dominio.com.br/conteudo" name="link" type="text" value="<?= !empty($post['link']) ? $post['link'] : ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Conteúdo:</label>
                                                    <div class="col-sm-10 text-editor">
                                                        <textarea name="conteudo" class="form-control" rows="3" placeholder="Solte os dedos, vamos lá!"><?= !empty($post['conteudo']) ? $post['conteudo'] : ''; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-success" name="SendFormPost" value="a" type="submit" data-loading-text="...">Publicar</button>
                                            <button class="btn btn-success" name="SendFormPost" value="i" type="submit" data-loading-text="...">Salvar Rascunho</button>
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

<?php
//Footer
View::elemento('../../_mvc/footer');
?>

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
                <h1>Gerenciar Tags</h1>

            </div>
            <section id="main-content" class="animated fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Listagem, edição e adição de tags</h3>

                            </div>
                            <div class="panel-body table-responsive">
                                <?php
                                $Action = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                                $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                                if (!empty($post['SendPostForm']) && empty($Action)):
                                    unset($post['SendPostForm']);

                                    $cadastra = new Tag;
                                    $cadastra->ExeCreate($post);

                                    SAErro($cadastra->getError()[0], $cadastra->getError()[1]);
                                elseif (!empty($Action)):
                                    $TagAction = filter_input(INPUT_GET, 'tagid', FILTER_VALIDATE_INT);
                                    switch ($Action):
                                        case 'edit':
                                            if (!empty($post['SendPostForm'])):
                                                unset($post['SendPostForm']);
                                                
                                                $atualizar = new Tag;
                                                $atualizar->ExeUpdate($TagAction, $post);

                                                SAErro($atualizar->getError()[0], $atualizar->getError()[1]);
                                            else:
                                                $readCat = new Read;
                                                $readCat->ExeRead('Tag', "WHERE idTag = :tagid", "tagid={$TagAction}");

                                                if ($readCat->getResult()):
                                                    $post = $readCat->getResult()[0];
                                                endif;
                                            endif;
                                            break;
                                        default:
                                            SAErro("Essa funcionalidade não existe no sistema, favor utilizar os botões de ação!", SA_ERROR);
                                    endswitch;
                                endif;
                                ?>
                                <form method="POST" accept-charset="UTF-8" class="form-horizontal" role="form" novalidate="novalidate" id="formEdit" name="formEdit" enctype="multipart/form-data">

                                    <div class="tab-wrapper tab-left ">
                                        <ul class="nav nav-tabs">
                                            <li class="<?= $Action == 'edit' ? 'unactive' : 'active'; ?>">
                                                <a href="#categorias" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="Lista Categorias"></span> 
                                                    <span class="hidden-xs">Lista Tags</span>
                                                </a>
                                            </li>
                                            <li class="<?= $Action == 'edit' ? 'active' : 'unactive'; ?>">
                                                <a href="#novoPostCategoria" data-toggle="tab" aria-expanded="true">
                                                    <span class="fa fa-list" title="Nova Categoria"></span> 
                                                    <span class="hidden-xs"><?= $Action == 'edit' ? 'Editar' : 'Nova'; ?> Tag</span>
                                                </a>
                                            </li>

                                        </ul>
                                        <!-- Inicio INPUTS -->
                                        <div class="tab-content">
                                            <div class="tab-pane <?= $Action == 'edit' ? 'unactive' : 'active'; ?>" id="categorias">
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
                                                                        $read->ExeRead('Tag', "ORDER BY nome ASC");
                                                                        $Tags = $read->getResult();

                                                                        if ($Tags):
                                                                            View::elemento('../../_mvc/tags_list', $Tags);
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
                                            <div class="tab-pane <?= $Action == 'edit' ? 'active' : 'unactive'; ?>" id="novoPostCategoria">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Nome *:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="Digite um nome" name="nome" type="text" value="<?= !empty($post['nome']) ? $post['nome'] : ''; ?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button class="btn btn-success" type="submit" name="SendPostForm" value="null" data-loading-text="...">Salvar</button>
                                                        <button class="btn btn-danger" type="reset" data-loading-text="...">Limpar</button>
                                                    </div>
                                                </div>
                                            </div>


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

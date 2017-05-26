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
                <h1>Gerenciar Comentários</h1>
            </div>
            <section id="main-content" class="animated fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Edição de comentários</h3>

                            </div>
                            <div class="panel-body table-responsive">
                                <?php
                                $Action = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                                $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                                if (!empty($Action)):
                                    $ComAction = filter_input(INPUT_GET, 'comid', FILTER_VALIDATE_INT);
                                    switch ($Action):
                                        case 'edit':
                                            if (!empty($post['SendPostForm'])):
                                                unset($post['SendPostForm'], $post['dataComentario']);

                                                $atualizar = new Comentario;
                                                $atualizar->ExeUpdate($ComAction, $post);

                                                SAErro($atualizar->getError()[0], $atualizar->getError()[1]);
                                            else:
                                                $readCom = new Comentario;
                                                $Comentario = $readCom->getCommentOfId($ComAction);

                                                if ($readCom->getResult()):
                                                    $post = $Comentario;
                                                endif;
                                            endif;
                                            break;
                                        case 'active':
                                        case 'inactive':
                                        case 'new':
                                            if (!empty($ComAction)):
                                                $Action = ($Action == 'active' ? 'a' : ($Action == 'inactive' ? 'i' : 'n'));
                                                $AlterarStatus = new Comentario;
                                                $AlterarStatus->ExeStatus($ComAction, $Action);

                                                SAErro($AlterarStatus->getError()[0], $AlterarStatus->getError()[1]);
                                            endif;
                                            break;
                                        case 'delete':
                                            if (!empty($ComAction)):
                                                $Delete = new Comentario;
                                                $Delete->ExeDelete($ComAction);

                                                SAErro($Delete->getError()[0], $Delete->getError()[1]);
                                            endif;
                                            break;
                                        default:
                                            SAErro("Essa funcionalidade não existe no sistema, favor utilizar os botões de ação!", SA_ERROR);
                                    endswitch;
                                endif;

                                if ($Action == 'edit'):
                                    ?>
                                    <form method="POST" accept-charset="UTF-8" class="form-horizontal" role="form" novalidate="novalidate" id="formEdit" name="formEdit" enctype="multipart/form-data">

                                        <div class="tab-wrapper tab-left ">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#novoPostCategoria" data-toggle="tab" aria-expanded="true">
                                                        <span class="fa fa-list" title="Nova Categoria"></span> 
                                                        <span class="hidden-xs"><?= $Action == 'edit' ? 'Editar' : 'Nova'; ?> Categoria</span>
                                                    </a>
                                                </li>

                                            </ul>
                                            <!-- Inicio INPUTS -->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="novoPostCategoria">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Nome Autor:</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" name="nomeAutor" type="text" value="<?= !empty($post['nomeAutor']) ? $post['nomeAutor'] : ''; ?>" readonly="true">
                                                        </div>
                                                    </div>                                                
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">E-mail:</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" name="email" type="text" value="<?= !empty($post['email']) ? $post['email'] : ''; ?>" readonly="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Data:</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" name="dataComentario" type="text" value="<?= !empty($post['dataComentario']) ? date('d/m/Y H:i', strtotime($post['dataComentario'])) : ''; ?>" readonly="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-2 control-label">Comentário:</label>
                                                        <div class="col-sm-10 text-editor">
                                                            <textarea class="form-control" rows="3" id="ckeditor_pers" name="comentarioTexto" placeholder="Solte os dedos, vamos lá!"><?= !empty($post['comentarioTexto']) ? $post['comentarioTexto'] : ''; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Categoria *:</label>
                                                        <div class="col-sm-10">
                                                            <select id="disabledSelect" name="status" class="form-control">
                                                                <option value="-1">Escolha</option>
                                                                <option value="n" <?= !empty($post['status']) && $post['status'] == 'n' ? "selected='selected'" : ''; ?>>Novo</option>
                                                                <option value="a" <?= !empty($post['status']) && $post['status'] == 'a' ? "selected='selected'" : ''; ?>>Ativo</option>
                                                                <option value="i" <?= !empty($post['status']) && $post['status'] == 'i' ? "selected='selected'" : ''; ?>>Inativo</option>                                                            
                                                            </select>
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
                                    </form>
                                </div>
                                <?php
                            else:
                                ?>
                                <a href="<?= BASE; ?>admin/pages/comentarios-lista.php" class="btn btn-success">Voltar</a>
                            <?php
                            endif;
                            ?>

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

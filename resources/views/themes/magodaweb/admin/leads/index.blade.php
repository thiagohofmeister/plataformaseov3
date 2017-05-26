@extends(TM . 'layout.admin')

@section('conteudo')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Central de Leads</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 col-sm-10 col-md-10">
                                    <!-- search form -->
                                    <form class="form-inline" name="search" method="get">
                                        <div class="form-group" style="margin-top: 0px;">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default btn-trans dropdown-toggle"><span class="caret"></span>  Mídias</button>
                                                <ul class="dropdown-menu">
                                                    <li class=""><a href="">Adwords</a></li>
                                                    <li class=""><a href="">Facebook</a></li>
                                                    <li class=""><a href="">Orgânico</a></li>
                                                </ul>
                                            </div>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default btn-trans dropdown-toggle"><span class="caret"></span>  Período</button>
                                                <ul class="dropdown-menu">
                                                    <li class=""><a href="">7 Dias</a></li>
                                                    <li class=""><a href="">14 Dias</a></li>
                                                    <li class=""><a href="">30 Dias</a></li>
                                                    <li class=""><a href="">Tudo</a></li>
                                                </ul>
                                            </div>

                                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search fa fa-search"></i></button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-xs-12 col-sm-2 col-md-2 pull-right">
                                    <!--i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i-->



                                    </div>
                                </div>
                            </div>
                            <!-- /.panel-heading -->


                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Cidade</th>
                                                <th>Data</th>
                                                <th>Mídia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-success btn-xs">Adwords</button></td>
                                            </tr>
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-primary btn-xs">Facebook</button></td>
                                            </tr>
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-warning btn-xs">Orgânico</button></td>
                                            </tr> 
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-success btn-xs">Adwords</button></td>
                                            </tr>
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-primary btn-xs">Facebook</button></td>
                                            </tr>
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-warning btn-xs">Orgânico</button></td>
                                            </tr> 
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-success btn-xs">Adwords</button></td>
                                            </tr>
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-primary btn-xs">Facebook</button></td>
                                            </tr>
                                            <tr>
                                                <td>Nome do usuário</td>
                                                <td>email@gmail.com</td>
                                                <td>51-81813636</td>
                                                <td>Porto Alegre (Poa)</td>
                                                <td>10/04/2016 19:05</td>
                                                <td><button type="button" class="btn btn-warning btn-xs">Orgânico</button></td>
                                            </tr> 
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
                <!-- /panel-default -->
            </div>
            <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
    </div>
    @stop
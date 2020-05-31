<?php
if ( session_status() !== PHP_SESSION_ACTIVE ){
session_start(); }
if (!isset($_SESSION['adm_session'])){ header("Location: viewInicioUser.php"); }
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/publicacoes.css">

<script type="text/javascript" src="../assets/js/plugins/jquery-3.3.1.min.js"> </script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/localization/messages_pt_BR.js"></script>
<script type="text/javascript" src="../assets/js/publicacoes.js"></script>

<div id="corpo"> </div>


<div class="modal" id="verEditarPublicacoes" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title"> Edite as informações sobre a publicações </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editarPublicacoes-form" name="editarPublicacoes-form" method="POST">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="data">
                                    <h5> Data da publicação: </h5>
                                </label>
                                <input type="date" class="form-control" id="data" name="data"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="descricao">
                                    <h5> Citação referente a publicação: </h5>
                                </label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3">  </textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="link">
                                    <h5> Link para acesso: </h5>
                                </label>
                                <input type="link" class="form-control" id="link" name="link">  </input>
                            </div>
                        </div>
                    </div>
            </div>
            <div style="width: 100%; border-top: 1px solid #dee2e6;">
                <div class="modal-footer" style="width: 50%; float: right; border-top: 0px solid #fff;">
                    <button type="button" class="btn btn-secondary" style="float: right; margin-left: 10px; margin-top: 0px;" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                    <button type="submit" class="btn btn-warning" style="float: right" id="btnEditarPublicacao">
                        <i class="fa fa-check"></i> Salvar
                    </button>
                </div>
                </form>
                <div style="width: 30%; float: left; margin: 15px; margin-right: 0px;">
                    <form class="form-horizontal" id="excluirPublicacoes-form" name="excluirPublicacoes-form" method="POST">
                        <input type="hidden" name="acao" id="acao" value="excluir">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-lg btn-danger" id="btnExcluirPublicacao" title="Excluir notícia">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="verAdicionarPublicacoes" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title"> Adicione uma publicacão </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="adicionarPublicacoes-form" name="adicionarPublicacoes-form" method="POST">
                    <input type="hidden" name="acao" value="adicionar">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="data">
                                    <h5> Data da publicação: </h5>
                                </label>
                                <input type="date" class="form-control" id="data" name="data"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="descricao">
                                    <h5> Citação referente a publicação: </h5>
                                </label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="link">
                                    <h5> Link para acesso: </h5>
                                </label>
                                <input type="link" class="form-control" id="link" name="link">  </input>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                <button type="submit" class="btn btn-warning" id="btnAdicionarPublicacao">
                    <i class="fa fa-check"></i> Adicionar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>


</div>

<script>
    $(document).ready(function() {
        $.get("publicacoes.php", function() {
            var divEditar = $('.editar');

            divEditar.show();

            $('li').addClass('paginacao');
        });
    });

</script>

<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
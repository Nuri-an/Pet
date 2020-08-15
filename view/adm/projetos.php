<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/projetos.css">

<script type="text/javascript" src="../assets/js/plugins/jquery-3.3.1.min.js"> </script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/localization/messages_pt_BR.js"></script>
<script type="text/javascript" src="../assets/js/projetos.js"></script>

<div id="corpo"> </div>

<div class="modal" id="verProjetos" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="tituloModal"> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="Projetos-form" name="Projetos-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" id="acao">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idMidia" id="idMidia">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="titulo">
                                    <h5> Título da publicação: </h5>
                                </label>
                                <input type="text" class="form-control" id="titulo" name="titulo"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="descricao">
                                    <h5> Descrição do projeto: </h5>
                                </label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="data">
                                    <h5> Ano do desenvolvimento: </h5>
                                </label>
                                <input type="number" maxlength="4" class="form-control" id="data" name="data"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <h5> Upload: </h5>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" style="cursor: pointer; border: 1px solid #ced4da;" onclick="deletMidia()">
                                            <i class="fa fa-times" aria-hidden="true" title="Deletar arquivo"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="arquivo" name="arquivo" lang="pt" onchange="nomeMidiaAdd()">
                                        <label class="custom-file-label" for="arquivo" id="midia"> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="parceria">
                                    <h5> Parcerias no desenvolvimento: </h5>
                                </label>
                                <textarea class="form-control" id="parceria" name="parceria"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="publicacao">
                                    <h5> Eventos em que foi publicado: </h5>
                                </label>
                                <textarea class="form-control" id="publicacao" name="publicacao"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div style="width: 100%; border-top: 1px solid #dee2e6;">
                <div class="modal-footer" style="width: 50%; float: right; border-top: 0px solid #fff;">
                    <button type="button" class="btn btn-secondary" style="float: right; margin-left: 10px; margin-top: 0px;" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                    <button type="submit" class="btn btn-warning" style="float: right" id="btnProjeto">
                        <i class="fa fa-check"></i> Salvar
                    </button>
                </div>
                </form>
                <div id="excluirProjeto" style="width: 30%; float: left; margin: 15px; margin-right: 0px;">
                    <form class="form-horizontal" id="excluirProjetos-form" name="excluirProjetos-form" method="POST">
                        <input type="hidden" name="acao" value="excluir">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-lg btn-danger" id="btnExcluirProjeto" title="Excluir notícia">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<script>
    $(document).ready(function() {
        $.get("postProjetos.php", function() {
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
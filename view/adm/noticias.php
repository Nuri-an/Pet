<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/noticias.css">

<script type="text/javascript" src="../assets/js/plugins/jquery-3.3.1.min.js"> </script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/localization/messages_pt_BR.js"></script>
<script type="text/javascript" src="../assets/js/noticias.js"></script>

<div id="corpo"></div>

<div class="modal" id="verNoticias" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="tituloP"> </h3>
                <button type="button" class="close" data-dismiss="modal" title="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="Noticias-form" name="Noticias-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="acao" id="acao">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idMidia" id="idMidia">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="titulo">
                                    <h5> Título: </h5>
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
                                    <h5> Resumo da notícia: </h5>
                                </label>
                                <textarea class="form-control" id="resumo" name="resumo"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="descricao">
                                    <h5> Descrição: </h5>
                                </label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="10"></textarea>
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
                                        <input type="file" class="custom-file-input" id="arquivo" name="arquivo" lang="pt" onchange="nomeMidia()">
                                        <label class="custom-file-label" for="arquivo" id="midia"> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            </div>
            <div style="width: 100%; border-top: 1px solid #dee2e6;">
                <div class="modal-footer" style="width: 50%; float: right; border-top: 0px solid #fff;">
                    <button type="button" class="btn btn-secondary" style="float: right; margin-left: 10px; margin-top: 0px;" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                    <button type="submit" class="btn btn-warning" style="float: right" id="btnNoticia">
                        <i class="fa fa-check"></i> Salvar
                    </button>
                </div>
                </form>
                <div id="excluir" style="width: 30%; float: left; margin: 15px; margin-right: 0px;">
                    <form class="form-horizontal" id="excluirNoticias-form" name="excluirNoticias-form" method="POST">
                        <input type="hidden" name="acao" id="acao" value="excluir">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-lg btn-danger" id="btnExcluirNoticia" title="Excluir notícia">
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
        $.get("postNoticias.php", function() {
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
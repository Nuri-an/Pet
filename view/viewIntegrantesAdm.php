<?php
(session_status() !== PHP_SESSION_ACTIVE) ? session_start() : ' ';
(isset($_SESSION['adm_session'])) ? ' ' : header("Location: viewNoticiasUser.php"); 

require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/integrantes.css">

<script type="text/javascript" src="../assets/js/plugins/jquery-3.3.1.min.js"> </script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/localization/messages_pt_BR.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jQuery-Mask/jquery.mask.js"></script>
<script type="text/javascript" src="../assets/js/integrantes.js"></script>


<div id="corpo" class="container"> </div>

</div>

<!-- Normal Modal -->

<div class="modal" id="modalAtualizar" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="tituloP"> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="atualizar-form" name="atualizar-form">
                    <input type="hidden" name="acao" id="acao">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="tipo" id="tipo">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="nome">
                                    <h5> Nome: </h5>
                                </label>
                                <input type="text" class="form-control" id="nome" name="nome"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="email">
                                    <h5> Email: </h5>
                                </label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="cpf">
                                    <h5> Cpf: </h5>
                                </label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="999.999.999-99"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="dataInicio">
                                    <h5> Data de entrada no grupo: </h5>
                                </label>
                                <input type="date" class="form-control" id="dataInicio" name="dataInicio"> </input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="dataFim">
                                    <h5> Data de saída no grupo: </h5>
                                </label>
                                <input type="date" class="form-control" id="dataFim" name="dataFim"> </input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="social">
                                    <h5> Linkedin: </h5>
                                </label>
                                <input type="url" class="form-control" id="social" name="social"> </input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <h5> Foto: </h5>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="arquivo" name="arquivo" lang="pt" onchange="nomeFoto()">
                                    <label class="custom-file-label" for="arquivo" id="foto"> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <h5> Situação atual: </h5>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="Tutor(a)" id="situacao1" name="situacao" class="custom-control-input">
                                    <label class="custom-control-label" for="situacao1">Tutor(a)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="Bolsista" id="situacao2" name="situacao" class="custom-control-input">
                                    <label class="custom-control-label" for="situacao2">Bolsista</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="Voluntário" id="situacao3" name="situacao" class="custom-control-input">
                                    <label class="custom-control-label" for="situacao3">Voluntário</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-lg btn-danger" data-continer="body" data-toggle="popover" data-placement="left" title="Ajuda" data-content="É permitido apenas o envio de imagens com as seguintes extensões: .png, .jpg, .jpeg, .JPG, .PNG, .JPEG">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                <button type="submit" class="btn btn-warning" id="btnEditarInfo">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- End -->

<script>
    $(document).ready(function() {
        $.get("integrantes.php", function() {
            var divEditar = $('.editar');

            divEditar.show();

            $('#adm').addClass('paginacao');
        });
    });
</script>


<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
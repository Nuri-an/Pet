<?php
require '../inc/global/banner.php';
require '../inc/global/head_start.php';
require '../inc/global/config.php';

require_once("../dao/DaoIntegrantes.php");

$integrantesDao = new DaoIntegrantes();

$stmtTutores = $integrantesDao->runQuery("SELECT * FROM integrantes i, tutores t WHERE i.codIntegrante = t.codIntegrante");
$stmtTutores->execute();

$stmtDiscentes = $integrantesDao->runQuery("SELECT * FROM integrantes i, discentes d WHERE i.codIntegrante = d.codIntegrante");
$stmtDiscentes->execute();

?>

<style>
    .borda:hover {
        border: 2px solid #836FFF;
    }

    .info {
        display: none;
    }

    .nome {
        display: block;
    }

    @media (min-width: 768px) {
        .carousel-multi-item-2> {
            width: 25%;
            max-width: 100%;
        }
    }
</style>

<script>
    function abreT(indice) {
        var conteudo = $('#conteudoT' + indice);
        var primeiroNome = $('#primeiroNomeT' + indice);
        if (conteudo.hasClass('info')) {
            $("#carouselTutores").carousel('pause');
            conteudo.removeClass('info');
            primeiroNome.hide();
        } else {
            $("#carouselTutores").carousel('cycle');
            conteudo.addClass('info');
            primeiroNome.show();

        }
    }

    function abreD(indice) {
        var conteudo = $('#conteudoD' + indice);
        var primeiroNome = $('#primeiroNomeD' + indice);
        if (conteudo.hasClass('info')) {
            $("#carouselDiscentes").carousel('pause');
            conteudo.removeClass('info');
            primeiroNome.hide();
        } else {
            $("#carouselDiscentes").carousel('cycle');
            conteudo.addClass('info');
            primeiroNome.show();

        }
    }
</script>

<div id="atualiza">
    <div class="container" style="overflow:hidden;">
        <h2 class="display-4 text-align: center;"> Tutores </h2>
        <div class="card-deck">
            <?php
            if ($stmtTutores->rowCount() == 0) {
                echo '<small class="text-muted" style="font-size:30;"><i>Não há</i></small> ';
            }
            ?>
            <!--/.Controls-->
            <?php
            $i = 1;

            while ($rowTutores = $stmtTutores->fetch(PDO::FETCH_ASSOC)) {

                $newDateT = date('d/m/Y', strtotime($rowTutores['dataInicioIntegrante']));

                echo '
                <div  style="width: 300px; float: left;">
                    <div class="card borda">
                        <div  onclick="abreT(' . $i . ')">
                            <img class="card-img-top rounded img-fluid d-block" src="../assets/media/integrantes/' . $rowTutores['fotoIntegrante'] . '"  alt="" >
                            <button type="button" class="btn btn-primary" style="margin-right:50%; margin-left:50%;-webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Exluir" id="rowExcluirFoto_' . $i . '" data-id="' . $rowTutores['codIntegrante'] . '" onclick="excluirFoto(' . $i . ')">
                                <i class="fa fa-trash"></i> 
                            </button>
                            <div id="primeiroNomeT' . $i . '" >
                                <h5 class="card-title"> &nbsp ' . explode(' ', $rowTutores['nomeIntegrante'])[0] . ' </h5>
                            </div>
                        </div>
                        <div class="card-body info" id="conteudoT' . $i . '">
                            <h5 class="card-title">' . $rowTutores['nomeIntegrante'] . '</h5>
                            <p>
                                <i class="fa fa-address-card-o"></i>&nbsp ' . $rowTutores['emailIntegrante'] . '
                                <br />
                                <i class="fa fa-linkedin-square" aria-hidden="true" style="color: blue;"></i><a href="' . $rowTutores['socialIntegrante'] . '"> &nbsp Linkedin</a>
                                <br />
                                <i class="fa fa-handshake-o" aria-hidden="true"></i> &nbsp ' . $rowTutores['situacaoIntegrante'] . '
                                <button type="button" class="btn btn-primary" style="margin-left:90%; margin-top: 10px; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Editar" id="rowEditarInformacoes_' . $i . '" data-id="' . $rowTutores['codIntegrante'] . '" data-nome="' . $rowTutores['nomeIntegrante'] . '" data-cpf="' . $rowTutores['cpfIntegrante'] . '" data-email="' . $rowTutores['emailIntegrante'] . '"  data-social="' . $rowTutores['socialIntegrante'] . '" data-dataInicio="' . $rowTutores['dataInicioIntegrante'] . '" data-dataFim="' . $rowTutores['dataFimIntegrante'] . '" data-situacao="' . $rowTutores['situacaoIntegrante'] . '" onclick="verInformacoes(' . $i . ')">
                                    <i class="fa fa-pencil"></i> 
                                </button>
                            </p>
                            <p class="card-text"><small class="text-muted">Ativo desde ' . $newDateT . '</small></p>
                        </div>
                    </div>
                </div>';
                $i++;
            }
            ?>
        </div>
    </div>
    <div class="container" style="margin-top: 20px;">
        <h2 class="display-4 text-align: center;"> Discentes </h2>
        <div class="card-deck">
            <?php
            if ($stmtDiscentes->rowCount() == 0) {
                echo '<small class="text-muted" style="font-size:30;"><i>Não há</i></small> ';
            }
            ?>

            <?php
            while ($rowDiscentes = $stmtDiscentes->fetch(PDO::FETCH_ASSOC)) {

                $newDateD = date('d/m/Y', strtotime($rowDiscentes['dataInicioIntegrante']));

                echo '
                <div  style="width: 300px; float: left;">
                    <div class="card borda">
                        <div class="" onclick="abreD(' . $i . ')">
                            <img class="card-img-top"  src="../assets/media/integrantes/' . $rowDiscentes['fotoIntegrante'] . '"  alt="" >
                            <button type="button" class="btn btn-primary" style="margin-right:50%; margin-left:50%;-webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Excluir" id="rowExcluirFoto_' . $i . '" data-id="' . $rowDiscentes['codIntegrante'] . '" onclick="excluirFoto(' . $i . ')">
                                <i class="fa fa-trash"></i> 
                            </button>
                            <div id="primeiroNomeD' . $i . '" >
                                <h5 class="card-title"> &nbsp ' . explode(' ', $rowDiscentes['nomeIntegrante'])[0] . ' </h5>
                            </div>
                        </div>
                        <div class="card-body info" id="conteudoD' . $i . '">
                            <h5 class="card-title">' . $rowDiscentes['nomeIntegrante'] . '</h5>
                            <p>
                                <i class="fa fa-address-card-o"></i>&nbsp ' . $rowDiscentes['emailIntegrante'] . '
                                <br />
                                <i class="fa fa-linkedin-square" aria-hidden="true" style="color: blue;"></i><a href="' . $rowDiscentes['socialIntegrante'] . '"> &nbsp Linkedin</a>
                                <br />
                                <i class="fa fa-handshake-o" aria-hidden="true"></i> &nbsp ' . $rowDiscentes['situacaoIntegrante'] . '
                                <button type="button" class="btn btn-primary" style="margin-left:90%; margin-top: 10px; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Editar" id="rowEditarInformacoes_' . $i . '" data-id="' . $rowDiscentes['codIntegrante'] . '" data-nome="' . $rowDiscentes['nomeIntegrante'] . '" data-cpf="' . $rowDiscentes['cpfIntegrante'] . '" data-email="' . $rowDiscentes['emailIntegrante'] . '"  data-social="' . $rowDiscentes['socialIntegrante'] . '" data-dataInicio="' . $rowDiscentes['dataInicioIntegrante'] . '" data-dataFim="' . $rowDiscentes['dataFimIntegrante'] . '" data-situacao="' . $rowDiscentes['situacaoIntegrante'] . '" onclick="verInformacoes(' .  $i  . ')">
                                    <i class="fa fa-pencil"></i> 
                                </button>
                            </p>
                            <p class="card-text"><small class="text-muted">Ativo desde ' . $newDateD . '</small></p>
                        </div>
                    </div>
                </div>';
                $i++;
            }
            ?>
        </div>
    </div>
</div>

<!-- Normal Modal -->

<div class="modal" id="modalAtualizar" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="editarInfoLabel"> Edite as informações </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" enctype="multipart/form-data" id="atualizar-form" name="atualizar-form">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="nome">
                                    <h5> Nome *: </h5>
                                </label>
                                <input type="text" class="form-control" id="nome" name="nome"> </input>
                                <div class="invalid-tooltip">
                                    Por favor, digite o nome completo do integrante.
                                </div>
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
                                    <h5> Cpf *: </h5>
                                </label>
                                <input type="text" class="form-control" wrap="hard" id="cpf" name="cpf"> </input>
                                <div class="invalid-tooltip">
                                    Por favor, digite o cpf do integrante.
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="dataInicio">
                                    <h5> Data de entrada no grupo *: </h5>
                                </label>
                                <input type="date" class="form-control" id="dataInicio" name="dataInicio" required> </input>
                                <div class="invalid-tooltip">
                                    Por favor, escolha a data que o integrante entrou no grupo.
                                </div>
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
                                    <input type="file" class="custom-file-input" id="arquivo" name="arquivo" lang="pt">
                                    <label class="custom-file-label" for="arquivo"> </label>
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
                                    <div class="invalid-tooltip">Selecione uma situação para o integrante</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-lg btn-danger" data-continer="body" data-toggle="popover" data-placement="left" title="Ajuda" data-content="Para adicionar outros títulos e textos utilize o campo de Conteúdo Extra e o seu menu para fazer a formatação. As tags HTML são necessárias, pois a formatação se aplicará ao texto entre elas.">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="btnEditarInfo" onclick="atualizarInformacoes()">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End -->


<script src="../assets/js/integrantes.js"></script>

<?php
require '../inc/global/head_end.php';
?>
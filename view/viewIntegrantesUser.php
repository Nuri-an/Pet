<?php
require '../inc/global/banner.php';
require '../inc/global/head_start.php';
require '../inc/global/config.php';

require_once("../dao/DaoInformacoes.php");

$informacoesDao = new DaoInformacoes();

$stmtTutores = $informacoesDao->runQuery("SELECT * FROM integrantes i, tutores t WHERE i.codIntegrante = t.codIntegrante");
$stmtTutores->execute();

$stmtDiscentes = $informacoesDao->runQuery("SELECT * FROM integrantes i, discentes d WHERE i.codIntegrante = d.codIntegrante");
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

<div class="container" style="overflow:hidden;">
    <h2 class="display-4 text-align: center;"> Tutores </h2>
    <div class="card-deck">
        <div id="carouselTutores" class="carousel slide carousel-multi-item-2" data-ride="carousel" style="width: 100%;">
            <!--Controls-->
            <div class="controls-top" style="margin-bottom:10px; align-items: center; display: flex; flex-direction: row; justify-content: center;">
                <?php
                if ($stmtTutores->rowCount() == 0) {
                    echo '<small class="text-muted" style="font-size:30;"><i>Não há</i></small> ';
                } else {
                    echo '<a class="black-text" href="#carouselTutores" data-slide="prev">
                    <i class="carousel-control-prev-icon" style="margin-right:5px; width:32px; height:32px;"></i>
                </a>
                <a class="black-text" href="#carouselTutores" data-slide="next">
                    <i class="carousel-control-next-icon" style="margin-left: 5px; width:32px; height:32px;"></i>
                </a>';
                }
                ?>
            </div>
            <!--/.Controls-->
            <div class="carousel-inner">

                <?php
                $i = 0;
                $ultimaDiv = 1;
                while ($rowTutores = $stmtTutores->fetch(PDO::FETCH_ASSOC)) {

                    $newDateT = date('d/m/Y', strtotime($rowTutores['dataInicioIntegrante']));

                    if ($i <= 3) {
                        if ($i == 0) {
                            echo '<div class="carousel-item row no-gutters active">';
                        }
                        echo '
                    <div class="col-3 float-left">
                        <div class="card borda">
                            <div  onclick="abreT(' . $i . ')">
                                <img class="card-img-top rounded img-fluid d-block" src="../assets/media/integrantes/' . $rowTutores['fotoIntegrante'] . '"  alt="" >
                                <div id="primeiroNomeT' . $i . '" style="margin-top: 10px;">
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
                                </p>
                                <p class="card-text"><small class="text-muted">Ativo desde ' . $newDateT . '</small></p>
                            </div>
                        </div>
                    </div>';
                        if (($i == 3) || ($stmtTutores->rowCount() == 3) || ($stmtTutores->rowCount() == 2) || ($stmtTutores->rowCount() == 1)) {
                            echo '</div>';
                        }
                    } 
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 20px;">
    <h2 class="display-4 text-align: center;"> Discentes </h2>
    <div class="card-deck">
        <div id="carouselDiscentes" class="carousel slide carousel-multi-item-2" data-ride="carousel" style="width: 100%; height:550px;">
            <!--Controls-->
            <div class="controls-top" style="margin-bottom:10px; align-items: center; display: flex; flex-direction: row; justify-content: center;">
            <?php
                if ($stmtDiscentes->rowCount() == 0) {
                    echo '<small class="text-muted" style="font-size:30;"><i>Não há</i></small> ';
                } else {
                    echo '<a class="black-text" href="#carouselDiscentes" data-slide="prev">
                    <i class="carousel-control-prev-icon" style="margin-right:5px; width:32px; height:32px;"></i>
                </a>
                <a class="black-text" href="#carouselDiscentes" data-slide="next">
                    <i class="carousel-control-next-icon" style="margin-left: 5px; width:32px; height:32px;"></i>
                </a>';
                }
                ?>
            </div>
            <!--/.Controls-->
            <div class="carousel-inner">
                <?php
                $i = 0;
                $ultimaDiv = 1;
                while ($rowDiscentes = $stmtDiscentes->fetch(PDO::FETCH_ASSOC)) {

                    $newDateD = date('d/m/Y', strtotime($rowDiscentes['dataInicioIntegrante']));

                    if ($i <= 3) {
                        if ($i == 0) {
                            echo '<div class="carousel-item row no-gutters active">';
                        }
                        echo '
                    <div class="col-3 float-left">
                        <div class="card borda">
                            <div class="" onclick="abreD(' . $i . ')">
                                <img class="card-img-top rounded img-fluid d-block" src="../assets/media/integrantes/' . $rowDiscentes['fotoIntegrante'] . '"  alt="" >
                                <div id="primeiroNomeD' . $i . '" style="margin-top: 10px;">
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
                                </p>
                                <p class="card-text"><small class="text-muted">Ativo desde ' . $newDateD . '</small></p>
                            </div>
                        </div>
                    </div>';
                        if (($i == 3) || ($stmtDiscentes->rowCount() == 3) || ($stmtDiscentes->rowCount() == 2) || ($stmtDiscentes->rowCount() == 1)) {
                            echo '</div>';
                        }
                    } else {
                        if (($i >= 4) && (($i % 4) == 0)) {
                            echo ' <div class="carousel-item row no-gutters">';
                        }

                        echo '
                    <div class="col-3 float-left">
                        <div class="card borda">
                            <div class="" onclick="abreD(' . $i . ')">
                                <img class="card-img-top rounded img-fluid d-block" src="../assets/media/integrantes/' . $rowDiscentes['fotoIntegrante'] . '"  alt="" >
                                <div id="primeiroNomeD' . $i . '" style="margin-top: 10px;">
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
                                </p>
                                <p class="card-text"><small class="text-muted">Ativo desde ' . $newDateD . '</small></p>
                            </div>
                        </div>
                    </div>';
                        $ultimaDiv = 0;
                        if (($i > 4) && ((($i + 1) % 4) == 0)) {
                            echo ' </div>';
                            $ultimaDiv = 1;
                        }
                    }
                    $i++;
                }
                if ($ultimaDiv != 1) {
                    echo ' </div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
require '../inc/global/head_end.php';
?>
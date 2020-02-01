<?php require 'loader.html' ?>
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

<link rel="stylesheet" href="../assets/css/integrantes.css">

<script type="text/javascript" src="../assets/js/integrantes.js"></script>

<div class="container" style="overflow:hidden;">
    <h2 class="display-4 text-align: center;"> Tutores </h2>
    <hr>
    </hr>
    <div class="card-deck" style="width: 100%; justify-content: center; align-items: center;">
        <?php
        if ($stmtTutores->rowCount() == 0) {
            echo '<small class="text-muted" style="font-size:30; "><i>Não há</i></small> ';
        }
        ?>
        <!--/.Controls-->
        <?php
        $i = 1;

        while ($rowTutores = $stmtTutores->fetch(PDO::FETCH_ASSOC)) {

            $newDateT = date('d/m/Y', strtotime($rowTutores['dataInicioIntegrante']));
            $midia = "../assets/media/integrantes/" . $rowTutores['fotoIntegrante'];

            if (($rowTutores['fotoIntegrante'] != '') && (file_exists($midia))) {
                $srcFotoT = $midia;
            } else {
                $srcFotoT = "../assets/media/integrantes/foto_1.jpg";
            }


            echo '
                <div  style="width: 300px; float: left; margin-bottom:10px;">
                    <div class="card borda">
                        <div  onclick="abreT(' . $i . ')">
                            <img class="card-img-top mx-auto rounded img-fluid d-block" src="' . $srcFotoT . '"  alt="" style= style="height:250px;" >
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
    <hr>
    </hr>
    <div class="card-deck" style="width: 100%; justify-content: center; align-items: center;">
        <?php
        if ($stmtDiscentes->rowCount() == 0) {
            echo '<small class="text-muted" style="font-size:30;"><i>Não há</i></small> ';
        }
        ?>

        <?php
        while ($rowDiscentes = $stmtDiscentes->fetch(PDO::FETCH_ASSOC)) {

            $newDateD = date('d/m/Y', strtotime($rowDiscentes['dataInicioIntegrante']));
            $midia = "../assets/media/integrantes/" . $rowDiscentes['fotoIntegrante'];

            if (($rowDiscentes['fotoIntegrante'] != '') && (file_exists($midia))) {
                $srcFotoD = $midia;
            } else {
                $srcFotoD = "../assets/media/integrantes/foto_1.jpg";
            }

            echo '
                <div  style="width: 300px; float: left; margin-bottom:10px;">
                    <div class="card borda">
                        <div class="" onclick="abreD(' . $i . ')">
                            <img class="card-img-top mx-auto rounded img-fluid d-block"  src="' . $srcFotoD . '"  alt="" style="height:250px;" >
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
<?php
require '../inc/global/head_end.php';
?>
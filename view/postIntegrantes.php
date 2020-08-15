<?php
require_once("../dao/DaoIntegrantes.php");

$integrantesDao = new DaoIntegrantes();

$stmtTutores = $integrantesDao->runQuery("SELECT * FROM integrantes i, tutores t WHERE i.codIntegrante = t.codIntegrante");
$stmtTutores->execute();

$stmtDiscentes = $integrantesDao->runQuery("SELECT * FROM integrantes i, discentes d WHERE i.codIntegrante = d.codIntegrante ORDER BY nomeIntegrante");
$stmtDiscentes->execute();
?>

<!-- 355 - 575 -->

<p class="badge badge-danger text-wrap" id="adm">Integrantes</p>
<hr class="bg-danger" style="margin-top: -17px; margin-bottom: 40px;" />

<div id="tutores">
    <h2 class="display-4" style="text-align: center; color: rgba(0,0,0,.5);"> Tutor(a) </h2>
    <div class="card-deck" style="margin-bottom: 80px; width: 100%; justify-content: center; align-items: center; float: left;">
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

            if (empty($rowTutores['socialIntegrante'])) {
                $emailTutor = '<a class="font-weight-normal" style="cursor: pointer;"> E-mail</a>';
            } else {
                $emailTutor = '<a target="_blank" class="text-decoration-none text-body text-break" href="mailto:' . $rowTutores['emailIntegrante'] . '"> ' . $rowTutores['emailIntegrante'] . '</a>';
            }

            if (empty($rowTutores['socialIntegrante'])) {
                $socialTutores = '<a  class="text-primary" style="cursor: pointer;"> &nbsp Linkedin</a>';
            } else {
                $socialTutores = '<a target="_blank" href="' . $rowTutores['socialIntegrante'] . '"> &nbsp Linkedin</a>';
            }

            echo '
                <div class="card-integrante">
                    <div class="card borda card-foto" onclick="abreT(' . $i . ')">
                        <div id="fotoT' . $i . '">
                            <img class="card-img-top mx-auto rounded img-fluid d-block" src="' . $srcFotoT . '" >
                            <a class="editar" title="Exluir" style="display: none; cursor:pointer; margin-top: 5px; margin-right: 15px; float: right;" id="rowExcluirFoto_' . $i . '" data-id="' . $rowTutores['codIntegrante'] . '"  data-tipo="tutor" onclick="excluir(' . $i . ')">
                                <i class="fa fa-trash fa-2x text-danger"></i> 
                            </a>
                            <div style="margin-top: 5px; float: left;">
                                <h5 class="card-title"> &nbsp ' . explode(' ', $rowTutores['nomeIntegrante'])[0] . ' </h5>
                            </div>
                        </div>
                        <div class="info container" id="conteudoT' . $i . '" style="margin-top:70px;">
                            <h5 class="card-title">' . $rowTutores['nomeIntegrante'] . '</h5>
                            <p>
                                <i class="fa fa-address-card-o"></i>&nbsp ' . $emailTutor . '
                                <br />
                                <i class="fa fa-linkedin-square" aria-hidden="true" style="color: blue;"></i>' . $socialTutores . '
                                <br />
                                <i class="fa fa-handshake-o" aria-hidden="true"></i> &nbsp ' . $rowTutores['situacaoIntegrante'] . '
                                <a class="editar" style="display: none; cursor: pointer; margin-left:90%; margin-top: 10px; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Editar" id="rowEditarInformacoes_' . $i . '" data-id="' . $rowTutores['codIntegrante'] . '" data-nome="' . $rowTutores['nomeIntegrante'] . '" data-cpf="' . $rowTutores['cpfIntegrante'] . '" data-email="' . $rowTutores['emailIntegrante'] . '"  data-social="' . $rowTutores['socialIntegrante'] . '" data-dataInicio="' . $rowTutores['dataInicioIntegrante'] . '" data-dataFim="' . $rowTutores['dataFimIntegrante'] . '" data-situacao="' . $rowTutores['situacaoIntegrante'] . '" onclick="verInformacoes(' . $i . ')">
                                    <i class="fa fa-pencil fa-2x text-success"></i> 
                                </a>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Ativo desde ' . $newDateT . '</small>
                            </p>
                        </div>
                    </div>
                </div>';
            $i++;
        }
        ?>
        <div class="card-integrante editar" id="modalTutores"  style= "display: none">
            <div class="card borda card-foto" onclick="newTutores()">
                <img class="card-img-top" src="../assets/media/integrantes/foto_0.png" alt="" title="Adicionar novo integrante">
                <div style="margin-top: 5px;">
                    <h5 class="card-title"> &nbsp Adicionar novo tutor(a) </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="discentes" style="margin-top: 30px; ">
    <h2 class="display-4" style="text-align: center; color: rgba(0,0,0,.5);"> Alunos </h2>
    <div class="card-deck" style="width: 100%; justify-content: center; align-items: center;">
        <?php
        while ($rowDiscentes = $stmtDiscentes->fetch(PDO::FETCH_ASSOC)) {

            $newDateD = date('d/m/Y', strtotime($rowDiscentes['dataInicioIntegrante']));
            $midia = "../assets/media/integrantes/" . $rowDiscentes['fotoIntegrante'];

            if (($rowDiscentes['fotoIntegrante'] != '') && (file_exists($midia))) {
                $srcFotoD = $midia;
            } else {
                $srcFotoD = "../assets/media/integrantes/foto_1.jpg";
            }

            if (empty($rowDiscentes['socialIntegrante'])) {
                $emailDiscente = '<a class="font-weight-normal" style="cursor: pointer;"> E-mail</a>';
            } else {
                $emailDiscente = '<a target="_blank" class="text-decoration-none text-body" href="mailto:' . $rowDiscentes['emailIntegrante'] . '"> ' . $rowDiscentes['emailIntegrante'] . '</a>';
            }

            if (empty($rowDiscentes['socialIntegrante'])) {
                $socialDiscente = '<a class="text-primary" style="cursor: pointer;"> &nbsp Linkedin</a>';
            } else {
                $socialDiscente = '<a target="_blank"  class="text-decoration-none" href="' . $rowDiscentes['socialIntegrante'] . '"> &nbsp Linkedin</a>';
            }

            echo '
                <div  class="card-integrante">
                    <div class="card borda card-foto" onclick="abreD(' . $i . ')">
                        <div id="fotoD' . $i . '">
                            <img class="card-img-top mx-auto rounded img-fluid d-block"  src="' . $srcFotoD . '"  >
                            <a class="editar" style="display: none; cursor:pointer; margin-top: 5px; margin-right: 15px; float: right;" title="Excluir" id="rowExcluirFoto_' . $i . '" data-id="' . $rowDiscentes['codIntegrante'] . '"  data-tipo="discente" onclick="excluir(' . $i . ')">
                                <i class="fa fa-trash fa-2x text-danger"></i> 
                            </a>
                            <div style="margin-top: 5px;">
                                <h5 class="card-title"> &nbsp ' . explode(' ', $rowDiscentes['nomeIntegrante'])[0] . ' </h5>
                            </div>
                        </div>
                        <div class="info container" id="conteudoD' . $i . '"  style="margin-top:70px;">
                            <h5 class="card-title">' . $rowDiscentes['nomeIntegrante'] . '</h5>
                            <p>
                                <i class="fa fa-address-card-o"></i>&nbsp ' . $emailDiscente . '
                                <br />
                                <i class="fa fa-linkedin-square" aria-hidden="true" style="color: blue;"></i>' . $socialDiscente . '
                                <br />
                                <i class="fa fa-handshake-o" aria-hidden="true"></i> &nbsp ' . $rowDiscentes['situacaoIntegrante'] . '
                                <a class="editar" style="display: none; cursor: pointer; margin-left:90%; margin-top: 10px; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Editar" id="rowEditarInformacoes_' . $i . '" data-id="' . $rowDiscentes['codIntegrante'] . '" data-nome="' . $rowDiscentes['nomeIntegrante'] . '" data-cpf="' . $rowDiscentes['cpfIntegrante'] . '" data-email="' . $rowDiscentes['emailIntegrante'] . '"  data-social="' . $rowDiscentes['socialIntegrante'] . '" data-dataInicio="' . $rowDiscentes['dataInicioIntegrante'] . '" data-dataFim="' . $rowDiscentes['dataFimIntegrante'] . '" data-situacao="' . $rowDiscentes['situacaoIntegrante'] . '" data-foto="' . $rowDiscentes['fotoIntegrante'] . '" onclick="verInformacoes(' .  $i  . ')">
                                    <i class="fa fa-pencil fa-2x text-success"></i> 
                                </a>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Ativo desde ' . $newDateD . '</small>
                            </p>
                        </div>
                    </div>
                </div>';
            $i++;
        }
        ?>
        <div class="card-integrante editar" style= "display: none">
            <div class="card borda card-foto" onclick="newDiscente()">
                <img class="card-img-top" src="../assets/media/integrantes/foto_0.png" alt="" title="Adicionar novo integrante">
                <div style="margin-top: 5px;">
                    <h5 class="card-title"> &nbsp Adicionar novo discente </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<br> <br>
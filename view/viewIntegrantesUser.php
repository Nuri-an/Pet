<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';

require_once("../dao/daoIntegrantes.php");

$integrantesDao = new DaoIntegrantes();
?>

<link rel="stylesheet" href="../assets/css/integrantes.css">

<script type="text/javascript" src="../assets/js/integrantes.js"></script>

<?php
$stmtTutores = $integrantesDao->runQuery("SELECT * FROM integrantes i, tutores t WHERE i.codIntegrante = t.codIntegrante");
$stmtTutores->execute();

$stmtDiscentes = $integrantesDao->runQuery("SELECT * FROM integrantes i, discentes d WHERE i.codIntegrante = d.codIntegrante");
$stmtDiscentes->execute();

?>


<div class="container">
    <h2 class="display-4" style="text-align: center;"> Tutores </h2>
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

            if (empty($rowTutores['socialIntegrante'])) {
                $emailTutor = '<a class="font-weight-normal" style="cursor: pointer;"> E-mail</a>';
            } else {
                $emailTutor = '<a target="_blank" class="text-decoration-none text-body text-break" href="mailto:' . $rowTutores['emailIntegrante'] . '"> '. $rowTutores['emailIntegrante'] .'</a>';
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
                            <img class="card-img-top mx-auto rounded img-fluid d-block" src="' . $srcFotoT . '">
                            <div style="margin-top:5px;">
                                <h5 class="card-title"> &nbsp ' . explode(' ', $rowTutores['nomeIntegrante'])[0] . ' </h5>
                            </div>
                        </div>
                        <div class="info container" id="conteudoT' . $i . '" style="margin-top:70px;">
                            <h5 class="card-title">' . $rowTutores['nomeIntegrante'] . '</h5>
                            <p>
                                <i class="fa fa-address-card-o"></i>&nbsp ' . $emailTutor . '
                                <br />
                                <i class="fa fa-linkedin-square" aria-hidden="true" style="color: blue;">' . $socialTutores . '
                                <br />
                                <i class="fa fa-handshake-o" aria-hidden="true"></i> &nbsp ' . $rowTutores['situacaoIntegrante'] . '
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
    </div>
</div>
<div class="container" style="margin-top: 30px;">
    <h2 class="display-4" style="text-align: center;"> Alunos </h2>
    <hr ></hr>
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
                
            if (empty($rowDiscentes['socialIntegrante'])) {
                $emailDiscente = '<a class="font-weight-normal" style="cursor: pointer;"> E-mail</a>';
            } else {
                $emailDiscente = '<a target="_blank" class="text-decoration-none text-body" href="mailto:' . $rowDiscentes['emailIntegrante'] . '"> '. $rowDiscentes['emailIntegrante'] .'</a>';
            }
            
            if (empty($rowDiscentes['socialIntegrante'])) {
                $socialDiscente = '<a class="text-primary" style="cursor: pointer;"> &nbsp Linkedin</a>';
            } else {
                $socialDiscente = '<a target="_blank"  class="text-decoration-none" href="' . $rowDiscentes['socialIntegrante'] . '"> &nbsp Linkedin</a>';
            }

            echo '
                <div class="card-integrante">
                    <div class="card borda card-foto" onclick="abreD(' . $i . ')">
                        <div id="fotoD' . $i . '">
                            <img class="card-img-top mx-auto rounded img-fluid d-block"  src="' . $srcFotoD . '">
                            <div style="margin-top:5px;">
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
    </div>
</div>
<br> <br>
</div>
<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
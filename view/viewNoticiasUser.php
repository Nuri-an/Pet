<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';

require_once("../dao/daoNoticias.php");

$noticiasDao = new DaoNoticias();
?>

<link rel="stylesheet" href="../assets/css/noticias.css">

<script type="text/javascript" src="../assets/js/noticias.js"></script>

<?php
$stmtNoticiasIn = $noticiasDao->runQuery("SELECT * FROM noticias WHERE localNoticia LIKE 'Interna'");
$stmtNoticiasIn->execute();

$stmtNoticiasEx = $noticiasDao->runQuery("SELECT * FROM noticias WHERE localNoticia LIKE 'Externa'");
$stmtNoticiasEx->execute();

?>

<div class=" text-center" style="margin-bottom:30px;" role="group" aria-label="Exemplo básico">
    <a class="btn btn-outline-info h5" href="#internas">Notícias internas</a>
    <a class="btn btn-outline-info h5" href="#externas">Notícias externas</a>
</div>

<br>

<div id="internas">
    <?php
    $i = 1;

    while ($rowNoticiasIn = $stmtNoticiasIn->fetch(PDO::FETCH_ASSOC)) {

        //$newDateT = date('d/m/Y', strtotime($rowTutores['dataInicioIntegrante']));

        echo '
                <h2 class="display-5" style="">' . $rowNoticiasIn['tituloNoticia'] . '
                <div class="row">
                    <div class="col-10 text-truncate lead">
                    ' . $rowNoticiasIn['descricaoNoticia'] . '
                    </div>
                </div>
                <div style="display: inline; float: right; margin-bottom: 5px;">
                    <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Editar">
                        Ler mais
                    </button>
                </div>
                <hr>
                <br><br>';
    }
    ?>
</div>

<div id="externas">

    <?php
    $i = 1;

    while ($rowNoticiasEx = $stmtNoticiasEx->fetch(PDO::FETCH_ASSOC)) {

        $newDateEx = date('d/m/Y', strtotime($rowNoticiasEx['dataNoticia']));
        $midia = "../assets/media/noticias/" . $rowNoticiasEx['midiaNoticia'];

        if (($rowNoticiasEx['midiaNoticia'] != '') && (file_exists($midia))) {
            $srcMidiaEx = $midia;
        } else {
            $srcMidiaEx = "../assets/media/integrantes/midia_0.png";
        }

        echo '
                <h2 class="display-5" style="">' . $rowNoticiasEx['tituloNoticia'] . ' </h2>
                <div class="row">
                    <div class="col-10 text-truncate lead">
                    ' . $rowNoticiasEx['descricaoNoticia'] . '
                    </div>
                </div>
                <footer class="blockquote-footer  text-right" style="margin-right:90px;"> Publicado em: ' . $newDateEx . '</footer>
                <div style="display: inline; float: right; margin-bottom: 5px;">
                    <button type="button" class="btn btn-primary" title="Editar"  id="rowLerMais_' . $i . '" data-titulo="' . $rowNoticiasEx['tituloNoticia'] . '" data-descricao="' . $rowNoticiasEx['descricaoNoticia'] . '" data-midia="' . $srcMidiaEx . '" onclick="lerMais(' . $i . ')">
                        Ler mais
                    </button>
                </div>
                <hr>
                <br><br>';
    }
    ?>
</div>
</div>

<!-- Normal Modal -->

<div class="modal fade" id="lerMais" tabindex="-1" role="dialog" aria-labelledby="lerMais" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="titulo">  </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="" style="justify-content: center; align-items: center; float: left;">
                            <img class="card-img-top mx-auto rounded img-fluid d-block" src="" style="height: 200px;" id="midia" name="midia">
                        </div>
                        <div class="lead" style="float: left;" id="descricao">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
require '../inc/global/head_end.php';
?>
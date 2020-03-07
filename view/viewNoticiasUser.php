<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/noticias.css">

<script type="text/javascript" src="../assets/js/noticias.js"></script>

<div class=" text-center" style="margin-bottom:30px;" role="group" aria-label="Exemplo básico">
    <a class="btn btn-outline-info h5" href="#internas">Notícias internas</a>
    <a class="btn btn-outline-info h5" href="#externas">Notícias externas</a>
</div>

<br>

<div id="internas">
    <?php
    /*$i = 1;

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
    }*/
    ?>
</div>

<div id="externas">

    
</div>
</div>

<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
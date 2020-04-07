<?php

require_once("../dao/DaoIntegrantes.php");

$integrantesDao = new DaoIntegrantes();

$stmtSituacao = $integrantesDao->runQuery("SELECT * FROM integrantes");
$stmtSituacao->execute();
?>

<div class="col-md-12">
    <div class="form-material">
        <?php
        $i = 1;
        while ($rowSituacao = $stmtSituacao->fetch(PDO::FETCH_ASSOC)) {
            if ($rowSituacao['codIntegrante'] == $_GET['codIntegrante']) {
                echo '<div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" value="' . $rowSituacao['situacaoIntegrante'] . '" id="situacao' . $i . '" name="situacao" class="custom-control-input" checked/>
                        <label class="custom-control-label" for="situacao' . $i . '">' . $rowSituacao['situacaoIntegrante'] . '</label>
                    </div>
                ';
            }
        }    ?>

        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="situacao2" name="situacao" class="custom-control-input">
            <label class="custom-control-label" for="situacao'. $i . '">Ou clique neste outro radio personalizado</label>
        </div>
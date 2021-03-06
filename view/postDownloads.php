<?php
require_once("../dao/daoDownloads.php");

$downloadsDao = new DaoDownloads();
?>

<?php

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$quantidadePg = filter_input(INPUT_POST, 'quantidadePg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $quantidadePg) - $quantidadePg;

$stmtDownloads = $downloadsDao->runQuery("SELECT * FROM downloads ORDER BY referenciaDownload LIMIT $inicio, $quantidadePg ");
$stmtDownloads->execute();
$stmtDownloadsList = $downloadsDao->runQuery("SELECT * FROM downloads ORDER BY referenciaDownload LIMIT $inicio, $quantidadePg ");
$stmtDownloadsList->execute();

$totalDownloads = $downloadsDao->runQuery("SELECT COUNT(codDownload) AS numResult FROM downloads");
$totalDownloads->execute();
$rowTotalDownloads = $totalDownloads->fetch(PDO::FETCH_ASSOC);

$totalPg = ceil($rowTotalDownloads['numResult'] / $quantidadePg);
?>

<p class="badge badge-danger text-wrap">Downloads</p>
<hr class="bg-danger" style="margin-top: -17px; margin-bottom: 20px;" />



<div class="container" style="border-bottom:30px; align-items: center; width: 100%;">
    <br>
    <div class="download border border-success" style="border-radius: 5px;">
        <div class="tab-content">

            <?php

            $i = 1;

            while ($rowDownloads = $stmtDownloads->fetch(PDO::FETCH_ASSOC)) {

                $slides = "../assets/media/downloads/" . $rowDownloads['slidesDownload'];
                $algoritmo = "../assets/media/downloads/" . $rowDownloads['algoritmoDownload'];

                if (($rowDownloads['slidesDownload'] != '') && (file_exists($slides))) {

                    $srcSlides = '<div>
                                    <a href="'. $slides .'" download="' . $rowDownloads['referenciaDownload'] . ': ' . $rowDownloads['tituloDownload'] . ' - slides">
                                        <h6>
                                            <i class="fa fa-download text-danger" aria-hidden="true"> Slides </i>
                                        </h6>
                                    </a>
                                </div>';
                } else {
                    $srcSlides = '<div>
                                    <small class="text-muted " style="font-size:50; ">
                                        <i>Sem slides dispníveis para download</i>
                                    </small>
                                </div>';
                }

                if (($rowDownloads['algoritmoDownload'] != '') && (file_exists($algoritmo))) {

                    $srcAlgoritmo = '<div>
                                        <a href="' . $algoritmo . '" download="' . $rowDownloads['referenciaDownload'] . ': ' . $rowDownloads['tituloDownload'] . ' - algoritmo">
                                            <h6>
                                                <i class="fa fa-download text-danger" aria-hidden="true"> Algoritmo </i>
                                            </h6>
                                        </a>
                                    </div>';
                } else {
                    $srcAlgoritmo = '<div>
                                        <small class="text-muted " style="font-size:50; top: 3">
                                            <i>Sem algoritmo dispnível para download</i>
                                        </small>
                                    </div>';
                }

                if (!(empty($rowDownloads['linkDownload']))) {

                    $srcLink = '<div>
                                    <a href="' . $rowDownloads['linkDownload'] . '" target="_blank">
                                        <h6>
                                            <i class="fa fa-external-link  text-danger" aria-hidden="true"> Link </i>
                                        </h6>
                                    </a>
                                </div>';
                } else {
                    $srcLink = '<div>
                                    <small class="text-muted " style="font-size:50; top: 3">
                                        <i>Sem link</i>
                                    </small>
                                </div>';
                }

                if($i == 1){
                    echo '<div class="tab-pane active" id="download_' . $i . '" role="tabpanel">
                            <div class="text-center lead"> ' . $rowDownloads['tituloDownload'] . ' </div>
                            <div class="editar" style="display: none; margin-top: 25px;">
                                <button type="button" class="btn" onclick="editar_modal('. $i .')" id="rowEditarDownloads_'. $i .'" data-id="'. $rowDownloads['codDownload'] .'" data-titulo="'. $rowDownloads['tituloDownload'] .'" data-referencia="'. $rowDownloads['referenciaDownload'] .'" data-slides="'. $rowDownloads['slidesDownload'] .'" data-algoritmo="'. $rowDownloads['algoritmoDownload'] .'" data-link="'. $rowDownloads['linkDownload'] .'" style="border-radius: 50px; position: relative; float: right; background-color: #8FBC8F;" aria-label="Editar">
                                    <i class="fa fa-pencil" aria-hidden="true" ></i>
                                </button>
                            </div>
                            <div class="container" style="margin-top: 15px;">
                                '. $srcSlides .'
                                '. $srcAlgoritmo .'
                                '. $srcLink .'
                            </div>
                        </div>';
                }

                else{
                    echo '<div class="tab-pane" id="download_' . $i . '" role="tabpanel">
                            <div class="text-center lead"> ' . $rowDownloads['tituloDownload'] . ' </div>
                            <div class="editar" style="display: none; margin-top: 25px;">
                                <button type="button" onclick="editar_modal('. $i .')" id="rowEditarDownloads_'. $i .'" data-id="'. $rowDownloads['codDownload'] .'" data-titulo="'. $rowDownloads['tituloDownload'] .'" data-referencia="'. $rowDownloads['referenciaDownload'] .'" data-slides="'. $rowDownloads['slidesDownload'] .'" data-algoritmo="'. $rowDownloads['algoritmoDownload'] .'" data-link="'. $rowDownloads['linkDownload'] .'"  class="btn" style="border-radius: 50px; position: relative; float: right; background-color: #8FBC8F;" aria-label="Editar">
                                    <i class="fa fa-pencil" aria-hidden="true" ></i>
                                </button>
                            </div>
                            <div class="container" style="margin-top: 15px;">
                                '. $srcSlides .'
                                '. $srcAlgoritmo .'
                                '. $srcLink .'
                            </div>
                        </div>';
                }
                $i++;
            }

            ?>

        </div>
    </div>

    <div class="list-group" id="myList" style="top: 50px; position: relative; margin-bottom: 50px;" role="tablist">

        <?php

        $j = 1;

        while ($rowDownloadsList = $stmtDownloadsList->fetch(PDO::FETCH_ASSOC)) {

            if($j == 1){
                echo '<a class="list-group-item list-group-item-action active list-group-item-success" data-toggle="list" href="#download_' . $j . '" role="tab" onclick="up()">' . $rowDownloadsList['referenciaDownload'] . ': ' . $rowDownloadsList['tituloDownload'] . '</a>';
            }
            else{
                echo '<a class="list-group-item list-group-item-action list-group-item-success" data-toggle="list" href="#download_' . $j . '" role="tab" onclick="up()">' . $rowDownloadsList['referenciaDownload'] . ': ' . $rowDownloadsList['tituloDownload'] . '</a>';
            }

            $j++;
        }

        ?>

    </div>

    
    <div class="editar" style="display: none;">
        <button type="button" onclick="adicionar_modal()" class="btn" style="background-color: #8FBC8F; top: 30px; margin-bottom: 20px; border-radius: 50px; position: relative; left:50%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" aria-label="Adicionar">
            <i class="fa fa-plus" aria-hidden="true" ></i>
        </button>
    </div>

    <?php
    echo '<nav class="container" style="margin-bottom: 100px; top:50px; position: relative;">
        <ul class="pagination justify-content-center">';
    if ($pagina == 1) {
        echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                </li>';
    } else {
        echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo" onclick="listarDownloads(1, ' . $quantidadePg . ')">Primeira</a>
                </li>';
    }

    for ($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++) {
        if ($pagAnt >= 1) {
            echo  '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarDownloads(' . $pagAnt . ', ' . $quantidadePg . ')">' . $pagAnt . '</a>
                      </li>';
        }
    }
    echo '<li class="page-item">
                <a class="page-link bg-success text-white" href="#corpo" onclick="listarDownloads(' . $pagina . ', ' . $quantidadePg . ')">' . $pagina . '</a>
            </li>';

    for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
        if ($pagDep <= $totalPg) {
            echo '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarDownloads(' . $pagDep . ', ' . $quantidadePg . ')">' . $pagDep . '</a>
                    </li>';
        }
    }
    if (($pagina == $totalPg) || ($pagina > $totalPg)) {
        echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
    } else {
        echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo"  onclick="listarDownloads(' . $totalPg . ', ' . $quantidadePg . ')">Última</a>
                </li>';
    }
    echo '</ul>
        </nav>';
    ?>

</div>
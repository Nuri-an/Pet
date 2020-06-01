<?php

require_once("../dao/daoNoticias.php");

$noticiasDao = new DaoNoticias();
?>

<?php
$pagina = filter_input(INPUT_POST, 'paginaIn', FILTER_SANITIZE_NUMBER_INT);
$quantidadePg = filter_input(INPUT_POST, 'quantidadePgIn', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $quantidadePg) - $quantidadePg;

$stmtNoticias = $noticiasDao->runQuery("SELECT * FROM noticias ORDER BY dataNoticia DESC LIMIT $inicio, $quantidadePg");
$stmtNoticias->execute();

$totalNoticias = $noticiasDao->runQuery("SELECT COUNT(codNoticia) AS numResult FROM noticias");
$totalNoticias->execute();
$rowTotalNoticias = $totalNoticias->fetch(PDO::FETCH_ASSOC);

$totalPg = ceil($rowTotalNoticias['numResult'] / $quantidadePg);
?>


<?php
$i = 1;

while ($rowNoticias = $stmtNoticias->fetch(PDO::FETCH_ASSOC)) {

    if ($rowNoticias['dataNoticia'] != '0000-00-00') {
        $newDate = date('d/m/Y', strtotime($rowNoticias['dataNoticia']));
    } else {
        $newDate = 'dd/mm/aaaa';
    }
    $midia = "../assets/media/noticias/" . $rowNoticias['midiaNoticia'];

    if (($rowNoticias['midiaNoticia'] != '') && (file_exists($midia))) {
        $srcMidia = '<img class="rounded imgMobile img-fluid" id="collapseMidia_'. $i .'" src="' . $midia . '" style=" margin-right: 20px; margin-bottom: 10px;" name="midia">';
    } else {
        $srcMidia = "";
    }

    echo '<div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="heading_'. $i .'" style="border-bottom: 0px; margin-bottom: 0px;">
                    <div class="">
                        '. $srcMidia .'
                        <h5 class="mt-0" style="padding-top: 10px;" >' . $rowNoticias['tituloNoticia'] . '</h5>
                        <br>
                        <p class="text-justify" id="collapseResumo_'. $i .'" > ' . $rowNoticias['resumoNoticia'] . '  </p>
                    </div>
                </div>
                <div id="collapse_'. $i .'" style="background-color: rgba(0,0,0,.03);" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body text-justify">
                        ' . nl2br($rowNoticias['descricaoNoticia']) . '
                    </div>
                </div>
                <div style="padding: .75rem 1.25rem; background-color: rgba(0,0,0,.03);">
                    <footer class="blockquote-footer  text-right" > Publicado em: ' . $newDate . '</footer>
                    <div class="editar" style="float: left; margin-bottom: 5px; display: none;">
                        <button type="button" style="background-color: #8FBC8F;" class="btn" data-toggle="tooltip" title="Editar" id="rowEditarNoticia_' . $i . '" data-id="' . $rowNoticias['codNoticia'] . '"  data-titulo="' . $rowNoticias['tituloNoticia'] . '" data-descricao="' . $rowNoticias['descricaoNoticia'] . '" data-resumo="' . $rowNoticias['resumoNoticia'] . '" data-midia="' . $rowNoticias['midiaNoticia'] . '" data-data="' . $rowNoticias['dataNoticia'] . '" onclick="editar_modal(' . $i . ')" >
                            <i class="fa fa-pencil"></i>
                        </button>
                    </div>
                    <div style="display: inline; float: right; margin-bottom: 5px;">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-success" type="button" data-toggle="collapse" data-target="#collapse_'. $i .'" aria-expanded="true" aria-controls="collapseOne" id="rowLerMais_' . $i . '" onclick="lerMais(' . $i . ')">
                                Ler mais
                            </button>
                        </h5>
                        <h5 class="mb-0">
                            <button class="btn btn-link text-success lerMenos" type="button" style="float: right;" data-toggle="collapse" data-target="#collapse_'. $i .'" aria-expanded="true" aria-controls="collapseOne" id="rowLerMenos_' . $i . '" onclick="lerMenos(' . $i . ')">
                                Ler menos
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    <br><br>';
    $i++;
}

echo '<div class="editar" style="display: none;">
        <button type="button" onclick="adicionar_modal()" class="btn" style="background-color: #8FBC8F; border-radius: 50px; position: absolute; left:50%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="adicionar uma publicação">
            <i class="fa fa-plus" aria-hidden="true" ></i>
        </button>
    </div>';


echo '<nav aria-label="Page navigation" style="margin-bottom: 100px; margin-top: 50px">
        <ul class="pagination justify-content-center">';
if ($pagina == 1) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo" onclick="listarNoticias(1, ' . $quantidadePg . ')">Primeira</a>
                </li>';
}

for ($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++) {
    if ($pagAnt >= 1) {
        echo  '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarNoticias(' . $pagAnt . ', ' . $quantidadePg . ')">' . $pagAnt . '</a>
                      </li>';
    }
}
echo '<li class="page-item">
                <a class="page-link  bg-success text-white" href="#corpo" onclick="listarNoticias(' . $pagina . ', ' . $quantidadePg . ')">' . $pagina . '</a>
            </li>';

for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
    if ($pagDep <= $totalPg) {
        echo '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarNoticias(' . $pagDep . ', ' . $quantidadePg . ')">' . $pagDep . '</a>
                    </li>';
    }
}
if (($pagina == $totalPg) || ($pagina > $totalPg)) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo"  onclick="listarNoticias(' . $totalPg . ', ' . $quantidadePg . ')">Última</a>
                </li>';
}
echo '</ul>
    </nav>';

?>
<?php

require_once("../dao/daoNoticias.php");

$noticiasDao = new DaoNoticias();
?>

<?php
$pagina = filter_input(INPUT_POST, 'paginaIn', FILTER_SANITIZE_NUMBER_INT);
$quantidadePg = filter_input(INPUT_POST, 'quantidadePgIn', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $quantidadePg) - $quantidadePg;

$stmtNoticiasIn = $noticiasDao->runQuery("SELECT * FROM noticias WHERE localNoticia LIKE 'Interna' LIMIT $inicio, $quantidadePg");
$stmtNoticiasIn->execute();

$totalNoticiasIn = $noticiasDao->runQuery("SELECT COUNT(codNoticia) AS numResult FROM noticias WHERE localNoticia LIKE 'Interna'");
$totalNoticiasIn->execute();
$rowTotalNoticiasIn = $totalNoticiasIn->fetch(PDO::FETCH_ASSOC);

$totalPgIn = ceil($rowTotalNoticiasIn['numResult'] / $quantidadePg);
?>
<?php
$i = 1;

while ($rowNoticiasIn = $stmtNoticiasIn->fetch(PDO::FETCH_ASSOC)) {

    if ($rowNoticiasIn['dataNoticia'] != '0000-00-00') {
        $newDateIn = date('d/m/Y', strtotime($rowNoticiasIn['dataNoticia']));
    } else {
        $newDateIn = 'dd/mm/aaaa';
    }
    $midia = "../assets/media/noticias/" . $rowNoticiasIn['midiaNoticia'];

    if (($rowNoticiasIn['midiaNoticia'] != '') && (file_exists($midia))) {
        $srcMidiaIn = '<img class="card-img-top mx-auto rounded img-fluid d-block" src="' . $midia . '" style="height: 200px; position: center; width: auto;" name="midia">';
    } else {
        $srcMidiaIn = "";
    }

    echo '
                <h2 class="display-5" style="">' . $rowNoticiasIn['tituloNoticia'] . ' </h2>
                <div class="row">
                    <div class="col-10 text-truncate lead " id="descricaoCurtaIn_' . $i . '">
                    ' . $rowNoticiasIn['descricaoNoticia'] . '
                    </div>
                    <div class="col-15 lead " style="display: none; margin-left: 15px; margin-right: 15px;" id="descricaoGrandeIn_' . $i . '">
                    ' . nl2br($rowNoticiasIn['descricaoNoticia']) . '
                    </div>
                </div>
                <div align="center" id="midiaIn_' . $i . '" style="display: none; width: 100%; margin-top: 10px;">
                    ' . $srcMidiaIn . '
                </div>
                <footer class="blockquote-footer  text-right" style="margin-right:90px;"> Publicado em: ' . $newDateIn . '</footer>
                <div class="editar" style="float: left; margin-bottom: 5px; display: none;">
                    <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Editar" id="rowEditarNoticiaIn_' . $i . '" data-id="' . $rowNoticiasIn['codNoticia'] . '"  data-titulo="' . $rowNoticiasIn['tituloNoticia'] . '" data-descricao="' . $rowNoticiasIn['descricaoNoticia'] . '" data-midia="' . $rowNoticiasIn['midiaNoticia'] . '" data-data="' . $rowNoticiasIn['dataNoticia'] . '" onclick="editar_modal_in(' . $i . ')" >
                        <i class="fa fa-pencil"></i>
                    </button>
                </div>
                <div style="display: inline; float: right; margin-bottom: 5px;">
                    <button type="button" class="btn btn-primary"  id="rowLerMaisIn_' . $i . '" onclick="lerMaisIn(' . $i . ')">
                        Ler mais
                    </button>
                    <button type="button" style="display: none;" class="btn btn-primary"  id="rowLerMenosIn_' . $i . '" onclick="lerMenosIn(' . $i . ')">
                        Ler menos
                    </button> 
                </div>
                <hr class="rows">
                <br><br>';
    $i++;
}

echo '<div class="editar" style="display: none;">
        <button type="button" onclick="adicionar_modal_in()" class="btn btn-primary" style="border-radius: 50px; position: absolute; left:50%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="adicionar uma publicação">
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
                    <a class="page-link" href="#internas" onclick="listarNoticiasEx(1, ' . $quantidadePg . ')">Primeira</a>
                </li>';
}

for ($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++) {
    if ($pagAnt >= 1) {
        echo  '<li class="page-item">
                        <a class="page-link" href="#internas" onclick="listarNoticiasEx(' . $pagAnt . ', ' . $quantidadePg . ')">' . $pagAnt . '</a>
                      </li>';
    }
}
echo '<li class="page-item active">
                <a class="page-link" href="#internas" onclick="listarNoticiasEx(' . $pagina . ', ' . $quantidadePg . ')">' . $pagina . '</a>
            </li>';

for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
    if ($pagDep <= $totalPgIn) {
        echo '<li class="page-item">
                        <a class="page-link" href="#internas" onclick="listarNoticiasEx(' . $pagDep . ', ' . $quantidadePg . ')">' . $pagDep . '</a>
                    </li>';
    }
}
if (($pagina == $totalPgIn) || ($pagina > $totalPgIn)) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link" href="#internas"  onclick="listarNoticiasEx(' . $totalPgIn . ', ' . $quantidadePg . ')">Última</a>
                </li>';
}
echo '</ul>
    </nav>';

?>


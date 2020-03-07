<?php
require_once("../dao/daoPublicacoes.php");

$publicacoesDao = new DaoPublicacoes();
?>

<?php
$stmtAnoPublicacoes = $publicacoesDao->runQuery("SELECT DISTINCT Year(dataPublicacao) as ano FROM publicacoes ");
$stmtAnoPublicacoes->execute();

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$quantidadePg = filter_input(INPUT_POST, 'quantidadePg', FILTER_SANITIZE_NUMBER_INT);
$ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $quantidadePg) - $quantidadePg;

$stmtPublicacoes = $publicacoesDao->runQuery("SELECT * FROM publicacoes WHERE dataPublicacao LIKE '$ano%' LIMIT $inicio, $quantidadePg");
$stmtPublicacoes->execute();

$totalPublicacoesAno = $publicacoesDao->runQuery("SELECT COUNT(codPublicacao) AS numResult FROM publicacoes WHERE dataPublicacao LIKE '$ano%'");
$totalPublicacoesAno->execute();
$rowTotalPublicacoesAno = $totalPublicacoesAno->fetch(PDO::FETCH_ASSOC);

$totalPg = ceil($rowTotalPublicacoesAno['numResult'] / $quantidadePg);
?>

<div class="btn-group" style="margin-bottom: 30px; padding-left: 15px; margin-left: auto;">
    <button type="button" class="btn btn-info">Selecionar ano da publicação</button>
    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">

        <?php

        while ($rowAnoPublicacoes = $stmtAnoPublicacoes->fetch(PDO::FETCH_ASSOC)) {

            echo '<a class="dropdown-item" href="#corpo" onclick="listarPublicacoes(' . $pagina . ', ' . $quantidadePg . ', ' . $rowAnoPublicacoes['ano'] . ')">' . $rowAnoPublicacoes['ano'] . ' ';
            echo '</a>';
            echo '<div class="dropdown-divider"></div>';
        }

        ?>
    </div>
</div>
<hr>

<?php

if ($stmtPublicacoes->rowCount() == 0) {
    echo '<div class = "container" style="margin-bottom: 20px;">
            <small class="text-muted " style="font-size:50; ">
                <i>Ainda não há publicações no ano de ' . $ano . '</i>
            </small> 
        </div>';
} else {

    echo '<table class="table table-striped container" style="margin-top: 30px;">
        <thead>
            <tr>
                <th scope="col">Ano</th>
                <th scope="col">Publicação</th>
                <th scope="col">Link</th>
            </tr>
        </thead>
        <tbody>';

    while ($rowPublicacoes = $stmtPublicacoes->fetch(PDO::FETCH_ASSOC)) {

        if ($rowPublicacoes['linkPublicacao'] == '') {
            $link = 'https://www.google.com/search?sxsrf=ALeKk01hhM_ik3CfUup1Am3OKbwKp1Z_HA%3A1583534324873&ei=9NBiXq-CNYXD5OUPtYOuuAQ&q=' . $rowPublicacoes['descricaoPublicacao'] . '';
        } else {
            $link = $rowPublicacoes['linkPublicacao'];
        }
        echo '<tr>
            <th scope="row">' . $ano . '</th>
            <td>' . $rowPublicacoes['descricaoPublicacao'] . '</td>
            <td> <a href="' . $link . '" target = _blank> <i class="fa fa-external-link" aria-hidden="true">  </i> </a> </td>
        </tr>';
    }

    echo '</tbody>
    </table>';
}
?>

<?php
echo '<nav aria-label="Page navigation" class="container" style="margin-bottom: 100px;">
        <ul class="pagination justify-content-center">';
if ($pagina == 1) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link" href="#corpo" onclick="listarPublicacoes(1, ' . $quantidadePg . ', ' . $ano . ')">Primeira</a>
                </li>';
}

for ($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++) {
    if ($pagAnt >= 1) {
        echo  '<li class="page-item">
                        <a class="page-link" href="#corpo" onclick="listarPublicacoes(' . $pagAnt . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagAnt . '</a>
                      </li>';
    }
}
echo '<li class="page-item active">
                <a class="page-link" href="#corpo" onclick="listarPublicacoes(' . $pagina . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagina . '</a>
            </li>';

for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
    if ($pagDep <= $totalPg) {
        echo '<li class="page-item">
                        <a class="page-link" href="#corpo" onclick="listarPublicacoes(' . $pagDep . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagDep . '</a>
                    </li>';
    }
}
if (($pagina == $totalPg) || ($pagina > $totalPg)) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link" href="#corpo"  onclick="listarPublicacoes(' . $totalPg . ', ' . $quantidadePg . ', ' . $ano . ')">Última</a>
                </li>';
}
echo '</ul>
        </nav>';
?>
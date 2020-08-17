<?php
require_once("../dao/daoPublicacoes.php");

$publicacoesDao = new DaoPublicacoes();
?>

<?php
$stmtAnoPublicacoes = $publicacoesDao->runQuery("SELECT DISTINCT dataPublicacao as ano FROM publicacoes ORDER BY dataPublicacao DESC");
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

<p class="badge badge-danger text-wrap">Publicações</p>
<hr class="bg-danger" style="margin-top: -17px; margin-bottom: 20px;" />

<div class="btn-group" style="margin-bottom: 30px; padding-left: 15px; margin-left: auto; float: right;">
    <button type="button" class="btn border border-success" style="color: rgba(0,0,0,.5);">Selecionar ano da publicação</button>
    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" style="background-color: #8FBC8F; " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<table class="table table-striped container" style="margin-top: 30px;">
    <?php

    if ($stmtPublicacoes->rowCount() == 0) {
        echo '<div class = "container" style="margin-bottom: 20px;" id="semPubicacoes">
            <small class="text-muted " style="font-size:50; ">
                <i>Ainda não há publicações no ano de ' . $ano . '</i>
            </small> 
        </div>';
    } else {

        echo '
        <thead>
            <tr>
                <th scope="col">Ano</th>
                <th scope="col">Publicação</th>
                <th scope="col">Link</th>
                <th scope="col"> <div class="editar" style="display: none;" > Editar </div> </th>
            </tr>
        </thead>
        <tbody>';

        $i = 1;

        while ($rowPublicacoes = $stmtPublicacoes->fetch(PDO::FETCH_ASSOC)) {

            if ($rowPublicacoes['linkPublicacao'] == '') {
                $link = 'https://www.google.com/search?sxsrf=ALeKk01hhM_ik3CfUup1Am3OKbwKp1Z_HA%3A1583534324873&ei=9NBiXq-CNYXD5OUPtYOuuAQ&q=' . $rowPublicacoes['descricaoPublicacao'] . '';
            } else {
                $link = $rowPublicacoes['linkPublicacao'];
            }
            echo '<tr>
            <th scope="row">' . $ano . '</th>
            <td>' . $rowPublicacoes['descricaoPublicacao'] . '</td>
            <td> <a href="' . $link . '" target = _blank> <i class="fa fa-external-link text-danger" aria-hidden="true">  </i> </a> </td>
            <td>
                <a  class="editar" style="color: #8FBC8F; cursor: pointer; float: left; margin-bottom: 5px; display: none;" title="Editar" id="rowEditarPublicacao_' . $i . '" data-id="' . $rowPublicacoes['codPublicacao'] . '"  data-data="' . $rowPublicacoes['dataPublicacao'] . '" data-descricao="' . $rowPublicacoes['descricaoPublicacao'] . '" data-link="' . $rowPublicacoes['linkPublicacao'] . '" onclick="editar_modal(' . $i . ')">
                    <i class="fa fa-pencil"></i>
                </a>
            </td>
                
        </tr>';

            $i++;
        }

        echo '</tbody> ';
    }

    ?>
    <tfoot>
        <tr>
            <th scope="col" coslpan="4">
                <div class="editar" style="display: none; margin-top: 20px;">
                    <button type="button" onclick="adicionar_modal()" class="btn" style="background-color: #8FBC8F; border-radius: 50px; position: absolute; left:50%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="adicionar uma publicação">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </th>
    </tfoot>
</table>

<?php
echo '<nav aria-label="Page navigation" class="container" style="margin-bottom: 100px; margin-top:50px;">
        <ul class="pagination justify-content-center">';
if ($pagina == 1) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo" onclick="listarPublicacoes(1, ' . $quantidadePg . ', ' . $ano . ')">Primeira</a>
                </li>';
}

for ($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++) {
    if ($pagAnt >= 1) {
        echo  '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarPublicacoes(' . $pagAnt . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagAnt . '</a>
                      </li>';
    }
}
echo '<li class="page-item">
                <a class="page-link bg-success text-white" href="#corpo" onclick="listarPublicacoes(' . $pagina . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagina . '</a>
            </li>';

for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
    if ($pagDep <= $totalPg) {
        echo '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarPublicacoes(' . $pagDep . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagDep . '</a>
                    </li>';
    }
}
if (($pagina == $totalPg) || ($pagina > $totalPg)) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo"  onclick="listarPublicacoes(' . $totalPg . ', ' . $quantidadePg . ', ' . $ano . ')">Última</a>
                </li>';
}
echo '</ul>
        </nav>';
?>
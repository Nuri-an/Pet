<?php
require_once("../dao/daoProjetos.php");

$projetosDao = new DaoProjetos();
?>

<?php
$stmtAnoProjetos = $projetosDao->runQuery("SELECT DISTINCT anoProjeto as ano FROM projetos  ORDER BY anoProjeto DESC");
$stmtAnoProjetos->execute();

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$quantidadePg = filter_input(INPUT_POST, 'quantidadePg', FILTER_SANITIZE_NUMBER_INT);
$ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $quantidadePg) - $quantidadePg;

$stmtProjetos = $projetosDao->runQuery("SELECT * FROM projetos WHERE anoProjeto LIKE '$ano' LIMIT $inicio, $quantidadePg");
$stmtProjetos->execute();

$totalProjetosAno = $projetosDao->runQuery("SELECT COUNT(codProjeto) AS numResult FROM projetos WHERE anoProjeto LIKE '$ano'");
$totalProjetosAno->execute();
$rowTotalProjetosAno = $totalProjetosAno->fetch(PDO::FETCH_ASSOC);

$totalPg = ceil($rowTotalProjetosAno['numResult'] / $quantidadePg);
?>

<p class="badge badge-danger text-wrap">Projetos</p>
<hr class="bg-danger" style="margin-top: -17px; margin-bottom: 20px;" />

<div class="btn-group" style="margin-bottom: 30px; padding-left: 15px; margin-left: auto; float: right;">
    <button type="button" style="color: rgba(0,0,0,.5);" class="btn border border-success">Selecionar o ano do projeto</button>
    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" style="background-color: #8FBC8F; " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">

        <?php

        while ($rowAnoProjetos = $stmtAnoProjetos->fetch(PDO::FETCH_ASSOC)) {

            echo '<a class="dropdown-item btn-success" href="#corpo" onclick="listarProjetos(' . $pagina . ', ' . $quantidadePg . ', ' . $rowAnoProjetos['ano'] . ')">' . $rowAnoProjetos['ano'] . ' ';
            echo '</a>';
            echo '<div class="dropdown-divider"></div>';
        }

        ?>
    </div>
</div>

<table class="table table-hover container" style="margin-top: 30px;">

    <?php

    if ($stmtProjetos->rowCount() == 0) {
        echo '<div class = "container" style="margin-bottom: 20px;" id="semPubicacoes">
            <small class="text-muted " style="font-size:50; ">
                <i>Ainda não há projetos em execução no ano de ' . $ano . '</i>
            </small> 
        </div>';
    } else {

        echo '
        <thead>
        </thead>
        <tbody>';

        $i = 1;

        while ($rowProjetos = $stmtProjetos->fetch(PDO::FETCH_ASSOC)) {

            $midia = "../assets/media/projetos/" . $rowProjetos['midiaProjeto'];

            if (($rowProjetos['midiaProjeto'] != '') && (file_exists($midia))) {
                $srcMidia = '<img class="card-img-top mx-auto rounded img-fluid d-block" src="' . $midia . '" style="height: 200px; position: center; width: auto;" name="midia">';
            } else {
                $srcMidia = "";
            }

            if (empty($rowProjetos['publicacaoProjeto'])) {
                $publicacao = '';
            } else {
                $publicacao = ' <footer class="blockquote-footer"> 
                                <p style="font-weight: bold;"> Publicado em: </p>
                                <p style="margin-left: 15px;  margin-right: 15px;">
                                    ' . $rowProjetos['publicacaoProjeto'] . ' 
                                </p>
                            </footer>';
            }

            if (empty($rowProjetos['parceriaProjeto'])) {
                $parceria = '';
            } else {
                $parceria = '<footer class="blockquote-footer"> 
                            <p style="font-weight: bold;"> Projeto desenvolvido em parceria com: </p>
                            <p style="margin-left: 15px;  margin-right: 15px;">
                                ' . $rowProjetos['parceriaProjeto'] . ' 
                            </p>
                        </footer>';
            }

            echo '<tr style="border-bottom: 20px solid #f4f4f4;">
                <td style="border-top: 0px; background-color: #f9f9f9;">
                    <h3 class="display-5 text-secundary" style="margin-top: 10px;">' . $rowProjetos['tituloProjeto'] . '</h3>
                    <div  class="lead " style="display: none;  margin-left: 15px;  margin-right: 15px;" id="descricao_' . $i . '"
                        <p>' . nl2br($rowProjetos['descricaoProjeto']) . '</p>
                        <p align="center" style=" width: 100%; margin-top: 10px;">
                            ' . $srcMidia . ' 
                        </p>
                        ' . $parceria . ' 
                        ' . $publicacao . ' 
                        <footer class="blockquote-footer"> 
                            <p style="font-weight: bold;"> Desenvolvido em: </p> 
                            <p style="margin-left: 15px;  margin-right: 15px;"> ' . $ano . ' </p>
                        </footer>
                    </div>
                    <div class="editar" style="cursor: pointer; float: left; margin-top: 10px; margin-left: 10px; display: none;">
                        <a aria-label="Editar"  id="rowEditarProjetos_' . $i . '" data-id="' . $rowProjetos['codProjeto'] . '"  data-titulo="' . $rowProjetos['tituloProjeto'] . '" data-descricao="' . $rowProjetos['descricaoProjeto'] . '" data-midia="' . $rowProjetos['midiaProjeto'] . '" data-ano="' . $rowProjetos['anoProjeto'] . '" data-publicacao="' . $rowProjetos['publicacaoProjeto'] . '" data-parceria="' . $rowProjetos['parceriaProjeto'] . '" onclick="editar_modal(' . $i . ')" >
                            <i class="fa fa-pencil" style="color: #8FBC8F;" ></i>
                        </a>
                    </div>
                    <div style="display: inline; float: right; margin-bottom: 5px;">
                        <a class="text-success"  style="cursor: pointer;" id="rowLerMais_' . $i . '" onclick="lerMais(' . $i . ')">
                            Ler mais
                        </a>
                        <a style="cursor: pointer; display: none;" class="text-success"  id="rowLerMenos_' . $i . '" onclick="lerMenos(' . $i . ')">
                            Ler menos
                        </a>
                    </div>
                </td>
            </tr>';

            $i++;
        }

        echo '  </tbody>';
    }

    ?>

    <tfoot>
        <tr>
            <td>
                <div class="editar" style="display: none; margin-top: 20px;">
                    <button type="button" onclick="adicionar_modal()" class="btn" style="background-color: #8FBC8F; border-radius: 50px; position: absolute; left:50%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" aria-label="adicionar uma publicação">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </td>
        </tr>
    </tfoot>
</table>

<?php
echo '<nav class="container" style="margin-bottom: 100px; margin-top:50px;">
        <ul class="pagination justify-content-center">';
if ($pagina == 1) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo" onclick="listarProjetos(1, ' . $quantidadePg . ', ' . $ano . ')">Primeira</a>
                </li>';
}

for ($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++) {
    if ($pagAnt >= 1) {
        echo  '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarProjetos(' . $pagAnt . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagAnt . '</a>
                      </li>';
    }
}
echo '<li class="page-item">
                <a class="page-link bg-success text-white" href="#corpo" onclick="listarProjetos(' . $pagina . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagina . '</a>
            </li>';

for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
    if ($pagDep <= $totalPg) {
        echo '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarProjetos(' . $pagDep . ', ' . $quantidadePg . ', ' . $ano . ')">' . $pagDep . '</a>
                    </li>';
    }
}
if (($pagina == $totalPg) || ($pagina > $totalPg)) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo"  onclick="listarProjetos(' . $totalPg . ', ' . $quantidadePg . ', ' . $ano . ')">Última</a>
                </li>';
}
echo '</ul>
        </nav>';
?>
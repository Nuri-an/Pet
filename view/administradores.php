<?php
require_once("../dao/daoAdministradores.php");

$administradoresDao = new DaoAdministradores();
session_start();
?>

<?php

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$quantidadePg = filter_input(INPUT_POST, 'quantidadePg', FILTER_SANITIZE_NUMBER_INT);

//calcular o inicio visualização
$inicio = ($pagina * $quantidadePg) - $quantidadePg;

$stmtAdministradores = $administradoresDao->runQuery("SELECT i.codIntegrante, i.nomeIntegrante, i.emailIntegrante, i.dataInicioIntegrante FROM integrantes i, administradores a WHERE i.codIntegrante <> a.codIntegrante AND i.situacaoIntegrante LIKE 'Administrador' AND i.dataInicioIntegrante like '0000-00-00' GROUP BY i.codIntegrante LIMIT $inicio, $quantidadePg");
$stmtAdministradores->execute();

$totalAdministradores = $administradoresDao->runQuery("SELECT COUNT(codIntegrante) AS numResult FROM integrantes WHERE situacaoIntegrante LIKE 'Administrador'");
$totalAdministradores->execute();
$rowTotalAdministradores = $totalAdministradores->fetch(PDO::FETCH_ASSOC);

$totalAdministradoresAtivos = $administradoresDao->runQuery("SELECT COUNT(codIntegrante) AS numResult FROM administradores");
$totalAdministradoresAtivos->execute();
$rowTotalAdministradoresAtivos = $totalAdministradoresAtivos->fetch(PDO::FETCH_ASSOC);

$totalAdministradoresInativos = $rowTotalAdministradores['numResult'] - $rowTotalAdministradoresAtivos['numResult'];
$totalPg = ceil($totalAdministradoresInativos / $quantidadePg);
?>

<?php

echo '<p class="text-danger" onClick="excluirPerfil()" style="float: right; cursor: pointer; margin-bottom: 50px;"  id="buttonExcluirPerfil" data-id="'. $_SESSION['adm_session'] .'"> Excluir meu perfil administrativo </p>';

if ($stmtAdministradores->rowCount() == 0) {
    echo '<div class = "container" style="margin-bottom: 20px;" id="semAdministradores">
            <small class="text-muted " style="font-size:50; ">
                <i>Ainda não há solicitações</i>
            </small> 
        </div>';
} else {

    echo '<table class="table table-striped container" style="margin-top: 30px;">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" style="width:30px;">Resposta</th>
            </tr>
        </thead>
        <tbody>';

        $i=1;

    while ($rowAdministradores = $stmtAdministradores->fetch(PDO::FETCH_ASSOC)) {

        echo '<tr>
            <td>' . $rowAdministradores['nomeIntegrante'] . ' </td>
            <td>
                <div style="cursor: pointer;"> 
                    <i class="text-warning fa fa-check fa-2x" title="Aceitar solicitação" aria-hidden="true" id="rowAceitarAdm_'. $i .'" data-id="'. $rowAdministradores['codIntegrante'] .'" data-nome="'. explode(' ', $rowAdministradores['nomeIntegrante'])[0] .'" onclick="aceitarAdm('. $i .')"></i>
                    <i class="text-danger fa fa-times fa-2x" title="Cancelar solicitação" aria-hidden="true" id="rowCancelarAdm_'. $i .'" data-id="'. $rowAdministradores['codIntegrante'] .'" data-nome="'. explode(' ', $rowAdministradores['nomeIntegrante'])[0] .'" onclick="cancelarAdm('. $i .')"></i>
                </div>    
            </td>
        </tr>';

        $i++;
    }

    echo '</tbody>
        </table>';
}

?>

<?php
echo '<nav aria-label="Page navigation" class="container" style="margin-bottom: 100px; margin-top:50px;">
        <ul class="pagination justify-content-center">';
if ($pagina == 1) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo" onclick="listarAdministradores(1, ' . $quantidadePg . ')">Primeira</a>
                </li>';
}

for ($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++) {
    if ($pagAnt >= 1) {
        echo  '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarAdministradores(' . $pagAnt . ', ' . $quantidadePg . ')">' . $pagAnt . '</a>
                      </li>';
    }
}
echo '<li class="page-item">
                <a class="page-link bg-success text-white" href="#corpo" onclick="listarAdministradores(' . $pagina . ', ' . $quantidadePg . ')">' . $pagina . '</a>
            </li>';

for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
    if ($pagDep <= $totalPg) {
        echo '<li class="page-item">
                        <a class="page-link text-success" href="#corpo" onclick="listarAdministradores(' . $pagDep . ', ' . $quantidadePg . ')">' . $pagDep . '</a>
                    </li>';
    }
}
if (($pagina == $totalPg) || ($pagina > $totalPg)) {
    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
} else {
    echo '<li class="page-item">
                    <a class="page-link text-success" href="#corpo"  onclick="listarAdministradores(' . $totalPg . ', ' . $quantidadePg . ')">Última</a>
                </li>';
}
echo '</ul>
        </nav>';
?>
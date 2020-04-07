<?php

require_once("../dao/daoNoticias.php");

$noticiasDao = new DaoNoticias();
?>

<?php
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$quantidadePg = filter_input(INPUT_POST, 'quantidadePg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $quantidadePg) - $quantidadePg;

$stmtNoticiasEx = $noticiasDao->runQuery("SELECT * FROM noticias WHERE localNoticia LIKE 'Externa' LIMIT $inicio, $quantidadePg");
$stmtNoticiasEx->execute();

$totalNoticiasEx = $noticiasDao->runQuery("SELECT COUNT(codNoticia) AS numResult FROM noticias WHERE localNoticia LIKE 'Externa'");
$totalNoticiasEx->execute();
$rowTotalNoticiasEx = $totalNoticiasEx->fetch(PDO::FETCH_ASSOC);

$totalPgEx = ceil($rowTotalNoticiasEx['numResult'] / $quantidadePg);
?>
<?php
$i = 1;

while ($rowNoticiasEx = $stmtNoticiasEx->fetch(PDO::FETCH_ASSOC)) {

    $newDateEx = date('d/m/Y', strtotime($rowNoticiasEx['dataNoticia']));
    $midia = "../assets/media/noticias/" . $rowNoticiasEx['midiaNoticia'];

    if (($rowNoticiasEx['midiaNoticia'] != '') && (file_exists($midia))) {
        $srcMidiaEx = '<img class="card-img-top mx-auto rounded img-fluid d-block" src="'. $midia .'" style="height: 200px; position: center; width: auto;" name="midia">';
    } else {
        $srcMidiaEx = "";
    }

    echo '
                <h2 class="display-5" style="">' . $rowNoticiasEx['tituloNoticia'] . ' </h2>
                <div class="row">
                    <div class="col-10 text-truncate lead " id="descricaoCurtaEx_' . $i . '">
                    ' . $rowNoticiasEx['descricaoNoticia'] . '
                    </div>
                    <div class="col-15 lead " style="display: none; margin-left: 15px; margin-right: 15px;" id="descricaoGrandeEx_' . $i . '">
                    ' . nl2br($rowNoticiasEx['descricaoNoticia']) . '
                    </div>
                </div>
                <div align="center" id="midiaEx_' . $i . '" style="display: none; width: 100%; margin-top: 10px;">
                    ' . $srcMidiaEx . '
                </div>
                <footer class="blockquote-footer  text-right" style="margin-right:90px;"> Publicado em: ' . $newDateEx . '</footer>
                <div style="display: inline; float: right; margin-bottom: 5px;">
                    <button type="button" class="btn btn-primary"  id="rowLerMaisEx_' . $i . '" onclick="lerMaisEx(' . $i . ')">
                        Ler mais
                    </button>
                    <button type="button" style="display: none;" class="btn btn-primary"  id="rowLerMenosEx_' . $i . '" onclick="lerMenosEx(' . $i . ')">
                        Ler menos
                    </button>
                </div>
                <hr>
                <br><br>';
                $i++;
}
echo '<nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">';
        if($pagina == 1){ 
            echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                </li>';
        }else{ 
            echo '<li class="page-item">
                    <a class="page-link" href="#externas" onclick="listarNoticiasEx(1, '. $quantidadePg .')">Primeira</a>
                </li>';
        }
        
        for($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++){
            if($pagAnt >= 1){
                echo  '<li class="page-item">
                        <a class="page-link" href="#externas" onclick="listarNoticiasEx('. $pagAnt .', '. $quantidadePg .')">'. $pagAnt .'</a>
                      </li>';
            }
        }
        echo '<li class="page-item active">
                <a class="page-link" href="#externas" onclick="listarNoticiasEx('. $pagina .', '. $quantidadePg .')">'. $pagina .'</a>
            </li>';

        for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
            if($pagDep <= $totalPgEx){
                echo '<li class="page-item">
                        <a class="page-link" href="#externas" onclick="listarNoticiasEx('. $pagDep .', '. $quantidadePg .')">'. $pagDep .'</a>
                    </li>';
            }
        }
        if(($pagina == $totalPgEx) || ($pagina > $totalPgEx)){ 
            echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
        }else{
            echo '<li class="page-item">
                    <a class="page-link" href="#externas"  onclick="listarNoticiasEx('. $totalPgEx .', '. $quantidadePg .')">Última</a>
                </li>';
        }
        echo '</ul>
    </nav>';
?>


<script type="text/javascript">

function lerMaisEx(id) {
  var div = $('#descricaoCurtaEx_' + id);
  var newDiv = $('#descricaoGrandeEx_' + id);
  var botao = $('#rowLerMaisEx_' + id);
  var newBotao = $('#rowLerMenosEx_' + id);
  var imagem = $('#midiaEx_' + id);

  div.hide();
  newDiv.show();
  botao.hide();
  newBotao.show();
  imagem.show();
}

function lerMenosEx(id) {
  var div = $('#descricaoCurtaEx_' + id);
  var newDiv = $('#descricaoGrandeEx_' + id);
  var botao = $('#rowLerMaisEx_' + id);
  var newBotao = $('#rowLerMenosEx_' + id);
  var imagem = $('#midiaEx_' + id);

  newDiv.hide();
  div.show();
  newBotao.hide();
  botao.show();
  imagem.hide();
}
</script>
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

while ($rowNoticiasEx = $stmtNoticiasIn->fetch(PDO::FETCH_ASSOC)) {

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
                    <div class="col-10 text-truncate lead " id="descricaoCurtaIn_' . $i . '">
                    ' . $rowNoticiasEx['descricaoNoticia'] . '
                    </div>
<<<<<<< HEAD
                    <div class="col-15 lead " style="display: none; margin-left: 15px; margin-right: 15px;" id="descricaoGrandeIn_' . $i . '">
=======
                    <div class="col-15 lead " style="display: none;" id="descricaoGrandeIn_' . $i . '">
>>>>>>> e9111380f06c02f3c445003019b3eb39a06a1853
                    ' . nl2br($rowNoticiasEx['descricaoNoticia']) . '
                    </div>
                </div>
                <div align="center" id="midiaIn_' . $i . '" style="display: none; width: 100%; margin-top: 10px;">
                    ' . $srcMidiaEx . '
                </div>
                <footer class="blockquote-footer  text-right" style="margin-right:90px;"> Publicado em: ' . $newDateEx . '</footer>
                <div style="display: inline; float: right; margin-bottom: 5px;">
                    <button type="button" class="btn btn-primary"  id="rowLerMaisIn_' . $i . '" onclick="lerMaisIn(' . $i . ')">
                        Ler mais
                    </button>
                    <button type="button" style="display: none;" class="btn btn-primary"  id="rowLerMenosIn_' . $i . '" onclick="lerMenosIn(' . $i . ')">
                        Ler menos
<<<<<<< HEAD
                    </button> 
=======
                    </button>
>>>>>>> e9111380f06c02f3c445003019b3eb39a06a1853
                </div>
                <hr>
                <br><br>';
                $i++;
}
echo '<nav aria-label="Page navigation" style="margin-bottom: 100px;">
        <ul class="pagination justify-content-center">';
        if($pagina == 1){ 
            echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                </li>';
        }else{ 
            echo '<li class="page-item">
                    <a class="page-link" href="#internas" onclick="listarNoticiasEx(1, '. $quantidadePg .')">Primeira</a>
                </li>';
        }
        
        for($pagAnt = $pagina - 2; $pagAnt < $pagina; $pagAnt++){
            if($pagAnt >= 1){
                echo  '<li class="page-item">
                        <a class="page-link" href="#internas" onclick="listarNoticiasEx('. $pagAnt .', '. $quantidadePg .')">'. $pagAnt .'</a>
                      </li>';
            }
        }
        echo '<li class="page-item active">
                <a class="page-link" href="#internas" onclick="listarNoticiasEx('. $pagina .', '. $quantidadePg .')">'. $pagina .'</a>
            </li>';

        for ($pagDep = $pagina + 1; $pagDep < $pagina + 3; $pagDep++) {
            if($pagDep <= $totalPgIn){
                echo '<li class="page-item">
                        <a class="page-link" href="#internas" onclick="listarNoticiasEx('. $pagDep .', '. $quantidadePg .')">'. $pagDep .'</a>
                    </li>';
            }
        }
        if(($pagina == $totalPgIn) || ($pagina > $totalPgIn)){ 
            echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Última</a>
                </li>';
        }else{
            echo '<li class="page-item">
                    <a class="page-link" href="#internas"  onclick="listarNoticiasEx('. $totalPgIn .', '. $quantidadePg .')">Última</a>
                </li>';
        }
        echo '</ul>
    </nav>';
?>


<script type="text/javascript">

function lerMaisIn(id) {
<<<<<<< HEAD
  var div = $('#descricaoCurtaIn_' + id);
=======
  var div = $('#descricaoCurtIn_' + id);
>>>>>>> e9111380f06c02f3c445003019b3eb39a06a1853
  var newDiv = $('#descricaoGrandeIn_' + id);
  var botao = $('#rowLerMaisIn_' + id);
  var newBotao = $('#rowLerMenosIn_' + id);
  var imagem = $('#midiaIn_' + id);

  div.hide();
  newDiv.show();
  botao.hide();
  newBotao.show();
  imagem.show();
}

<<<<<<< HEAD
function lerMenosIn(id) {
=======
function lerMenos(id) {
>>>>>>> e9111380f06c02f3c445003019b3eb39a06a1853
  var div = $('#descricaoCurtaIn_' + id);
  var newDiv = $('#descricaoGrandeIn_' + id);
  var botao = $('#rowLerMaisIn_' + id);
  var newBotao = $('#rowLerMenosIn_' + id);
  var imagem = $('#midiaIn_' + id);

  newDiv.hide();
  div.show();
  newBotao.hide();
  botao.show();
  imagem.hide();
}
</script>
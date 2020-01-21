<?php
require '../inc/global/banner.php';
require '../inc/global/head_start.php';
require '../inc/global/config.php';

require_once("../dao/DaoInformacoes.php"); 

$informacoesDao = new DaoInformacoes(); 
    
?>

<script type='text/javascript'>
function submit(){
    var formulario = document.getElementById('adicionarImagem-form');
    formulario.submit();
  }


</script>
<div id="atualiza">
<div class="jumbotron " style="overflow:hidden; width:100%; " >
    <div class="container" style="overflow:hidden;" id="corpoInfo">
    <?php 

    $stmtInformacoes = $informacoesDao->runQuery("SELECT * FROM informacoes");
    $stmtInformacoes->execute();

    $stmtGaleria = $informacoesDao->runQuery("SELECT * FROM galeria");
    $stmtGaleria->execute();

    while ($rowInformacoes = $stmtInformacoes->fetch(PDO::FETCH_ASSOC)) {
        echo '<h1 class="display-4">' .$rowInformacoes['tituloInfo']. ' </h1>'; 
        echo '<p class="lead">';
        echo nl2br($rowInformacoes['descricaoInfo']); 
        echo '<p> <b>' .$rowInformacoes['subTituloInfo']. ' </b> </p>'; 
        echo  nl2br($rowInformacoes['subDescricaoInfo']); 
        echo '<br>';
        echo '<br>
                <div style="display: inline;float: right; margin-bottom: 5px;">
                    <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Editar" id="rowEditarInfo" data-id="'. $rowInformacoes['codInfo'] .'" data-tituloP="'. $rowInformacoes['tituloInfo'] .'" data-infoP="'. $rowInformacoes['descricaoInfo'] .'" data-tituloS="'. $rowInformacoes['subTituloInfo'] .'" data-infoS="'. $rowInformacoes['subDescricaoInfo'] .'" onclick="editarInfo()" >
                        <i class="fa fa-pencil"></i>
                    </button>
                </div>' ;   
    } 
    ?> 
    </div>

<iframe src="../controller/controllerGaleria.php" name="controlador" style="display: none;"> </iframe>
             
<div id="carosel" class="carousel slide" data-ride="carousel" >
    <div class="carousel-inner" >
        <div class="carousel-item active" >
            <!-- <form id="adicionarImagem-form" action="../controller/controllerGaleria.php"  method="POST" encyte="multipart/form-data">-->   
            <img src="../assets/media/galeria/imagem_0.png" class="rounded mx-auto img-fluid d-block " style=" height: 400px; margin-top:100px; cursor: pointer;" alt="Adicione uma foto" title="Adicione uma foto" onclick="adicionarFoto_modal()"> 
        </div>
        <?php 
            $i=1;
            while ($rowGaleria = $stmtGaleria->fetch(PDO::FETCH_ASSOC)) {

                $titulo = $rowGaleria['tituloGaleria'];
                $arquivo="../assets/media/galeria/". $rowGaleria['fotoGaleria'];

                if (($rowGaleria['fotoGaleria'] != '') && (file_exists($arquivo))){

                echo '<div class="carousel-item" >
                        <img src="'. $arquivo .'"  class="rounded mx-auto img-fluid d-block" style=" height: 400px; margin-top:100px;" data-toggle="tooltip" alt="'. $titulo .'" title="Clique para substituir imagem"  id="rowEditarFoto_' . $i . '" data-id="'. $rowGaleria['codGaleria'] .'" data-titulo="'. $rowGaleria['tituloGaleria'] .'" onclick="editarFoto_modal(' . $i . ')">
                        <div class="carousel-caption d-none d-md-block" style="display: inline;float: right; ">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Excluir imagem" id="rowExcluirFoto_' . $i . '" data-id="'. $rowGaleria['codGaleria'] .'" onclick="excluirFoto(' . $i . ')" >
                                    <i class="fa fa-trash "></i> 
                            </button>
                        </div>
                    </div>';
                $i++;
                }
            }
        ?>
      
        <a class="carousel-control-prev" href="#carosel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carosel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Proximo</span>
        </a>
    </div>
</div>
</div>
</div>

<!-- Normal Modal -->

<div class="modal" id="verEditarInfo"  role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="editarInfoLabel"> Edite as informações </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editarInfo-form" method="POST">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="tituloP"> <h5> Título: </h5> </label>
						        <input type="text" class="form-control" id="tituloP" name="tituloP"> </input>
						    </div>
					    </div> 
                    </div>
                    <hr>      
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="infoP"> <h5> Descrição principal: </h5> </label>
						        <textarea class="form-control" id="infoP" name="infoP" rows="10" >  </textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                               <label class="" for="tituloS"> <h5> Sub Titulo: </h5> </label>
						        <input type="text" class="form-control" wrap="hard" id="tituloS" name="tituloS" > </input>
                            </div>
                        </div>
                    </div> 
                    <hr>   
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="infoS"> <h5> Informações complementares: </h5></label>
						        <textarea class="form-control" id="infoS" name="infoS" rows="50"> </textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-lg btn-danger" data-continer="body" data-toggle="popover" data-placement="left" title="Ajuda" data-content="As caixas de texto podem ser regulavéis <BR> U">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="btnEditarInfo" onclick="enviarDadosInfo()">
                    <i class="fa fa-check"></i> Salvar
                </button> 
            </div>   
        </div>
        
    </div>
</div>

<div class="modal" id="verModalFoto"  role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="nomeP">  </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" enctype="multipart/form-data" id="adicionarFoto" name="adicionarFoto" action="../controller/controllerGaleria.php" target="controlador" >
                    <input type="hidden" name="acao" id="acao">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="titulo"> <h5> Título da imagem: </h5> </label>
						        <input type="text" class="form-control" id="titulo" name="titulo"> </input>
						    </div>
					    </div> 
                    </div>
                    <hr>      
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="foto"> <h5> Upload: </h5> </label>
						        <input type="file" class="form-control-file" id="arquivo" name="arquivo"  accept="image/*">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-lg btn-danger" data-continer="body" data-toggle="popover" data-placement="left" title="Ajuda" data-content="As caixas de texto podem ser regulavéis <BR> U">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="btnAdicionarFoto"  onclick="enviarFotoG()">
                    <i class="fa fa-check"></i> Adicionar
                </button> 
            </div>   
        </div>
    </div>
</div> 
        
<!-- END Normal Modal -->
<script>
function tamanhoDinamico() {

    $("textarea").bind("input", function(e) {
        while( $(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
        $(this).height($(this).height()+1);
    };
});
}

</script>
<script src="../assets/js/admin.js"></script>

<?php
//$cb->get_js('/js/admin.js');
require '../inc/global/head_end.php';
?>
<?php
require_once("../dao/daoAdministradores.php");

$settingsDao = new DaoAdministradores();

$stmtSettings = $settingsDao->runQuery("SELECT * FROM configuracoes WHERE 1");
$stmtSettings->execute();
$settingsRow = $stmtSettings->fetch(PDO::FETCH_ASSOC);

?>

<div class="modal" id="verSettings" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title"> Altere as configurações do site </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="Settings-form" name="Settings-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" id="acao" value="edite">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <h5> Capa </h5>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <?php
                                            echo '
                                            <label class="custom-file-label" for="capa" id="midia-settings">'. $settingsRow['capa'] .'</label>
                                            <input type="file" class="custom-file-input" id="capa-settings" name="capa-settings" lang="pt" value="'. $settingsRow['capa'] .'" onchange="nomeMidia()">';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="facebook-settings">
                                    <h5> Facebook: </h5>
                                </label>
                                <?php
                                    echo ' <input type="text" class="form-control" id="facebook-settings" name="facebook-settings" rows="10" value="'. $settingsRow['facebook'] .'">';
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="instagram-settings">
                                    <h5> Instagram: </h5>
                                </label>
                                <?php
                                    echo '<input type="text" class="form-control" id="instagram-settings" name="instagram-settings" rows="10" value="'. $settingsRow['instagram'] .'">';
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="rodape-settings">
                                    <h5> Rodapé: </h5>
                                </label>
                                <?php
                                    echo'<textarea type="text" class="form-control" rows="5" id="rodape-settings" name="rodape-settings">'. $settingsRow['rodape'] .'</textarea>';
                                ?>
                            </div>
                        </div>
                    </div>
            </div>
            <div style="width: 100%; border-top: 1px solid #dee2e6;">
                <div class="modal-footer" style="width: 50%; float: right; border-top: 0px solid #fff;">
                    <button type="button" class="btn btn-secondary" style="float: right; margin-left: 10px; margin-top: 0px;" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                    <button type="submit" class="btn btn-warning" style="float: right" id="btnSettings">
                        <i class="fa fa-check"></i> Salvar
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require '../inc/global/head_start.php';
?>

<link rel="stylesheet" href="../assets/css/login.css">

<script type="text/javascript" src="../assets/js/plugins/jquery-3.3.1.min.js"> </script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/localization/messages_pt_BR.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jQuery-Mask/jquery.mask.js"></script>
<script type="text/javascript" src="../assets/js/login.js"></script>

<div class="container fundoLogin" id="login">
    <div class="container">
        <a href='index.php'>
            <i class="fa fa-chevron-circle-left fa-4x" style="margin-top: 5px; color: #8FBC8F;" id="back" aria-hidden="true"></i>
        </a>
        <div id="title" style="margin-bottom: 20px; text-align:center;">
            <h2 class="display-4"> Login </h2>
        </div>
        <form method="POST" id="logar-form" name="logar-form">
            <input type="hidden" id="acao" name="acao" value="logar">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="999.999.999-99"> </input>
                <small id="cpfHelp" class="form-text text-muted">Digite o cpf cadastrado.</small>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="***********"> </input>
                <small id="senhaHelp" class="form-text text-muted">Digite a senha cadastrada.</small>
            </div>
            <div class="form-group form-check" id="mostrar">
                <input type="checkbox" class="form-check-input" id="checkMostarSenha" name="checkMostarSenha" onclick="mostraSenha()">
                <label class="form-check-label" for="mostrar">Mostrar Senha</label>
            </div>
            <div class="form-group form-check" id="esconder" style="display:none;">
                <input type="checkbox" class="form-check-input" id="checkMostarSenha" name="checkMostarSenha" onclick="escondeSenha()">
                <label class="form-check-label" for="esconder">Esconder Senha</label>
            </div>
            <button type="submit" class="btn btn-success" id="btnEntrar" style="position:relative; left:50%; top: 10px; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);">Entrar</button>
            <div style="text-align:center;">
                <button type="submit" class="text-danger" style="cursor: pointer; border: 0px; background: transparent;" id="btnEsqueceuSenha"> Esqueceu a senha? </button>
                <br>
                <button type="button" class="text-danger" style="cursor: pointer; border: 0px; background: transparent;" onclick="cadastroAdm()"> Solicitar acesso </button>
            </div>
        </form>
    </div>
</div>

<div class="container fundoLogin" style="display: none;" id="esqueceuSenha">
    <a class="text-primary" style="cursor: pointer;" onclick="backLoginS()">
        <i class="fa fa-chevron-circle-left fa-4x" style="margin-top: 5px;  color: #8FBC8F;" id="back" aria-hidden="true"></i>
    </a>
    <div id="title" style="margin-bottom: 20px; text-align:center;">
        <h2 class="display-4"> Redefinir senha </h2>
    </div>
    <div class="form-group container" style="margin-top: 50px;" id="ValidaCod">
        <form class="form-horizontal" id="ValidaCod-form" name="ValidaCod-form" method="POST">
            <input type="hidden" name="acao" id="acao" value="validaCod">
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <label class="" for="codigo">
                            <h5> Insira o código que você recebeu por email: </h5>
                        </label>
                        <input type="number" maxlength="4" class="form-control" id="codigo" name="codigo"> </input>
                        <small id="codHelp" class="form-text text-muted">
                            Aguarde alguns minutos. Caso não receba o email, tente novamente mais tarde
                        </small>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <button type="submit" class="btn btn-success" style="margin-bottom: 30px;" id="btnValidaCod">
                            <i class="fa fa-check"></i> Seguinte
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="form-group container" id="RedefinirSenha" style="display: none; ">
        <form class="form-horizontal" style="margin-top: 30px;" id="RedefinirSenha-form" name="RedefinirSenha-form" method="POST">
            <input type="hidden" name="acao" id="acao" value="redefinir">
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <label for="senhaAdm">
                            <h5> Nova senha: </h5>
                        </label>
                        <input type="password" class="form-control" id="newSenha" name="newSenha"> </input>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <label for="equalSenha">
                            <h5> Repita a senha: </h5>
                        </label>
                        <input type="password" class="form-control" id="equalNewSenha" name="equalNewSenha"> </input>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <button type="submit" class="btn btn-success" style="margin-bottom: 30px;" id="btnRedefinirSenha">
                            <i class="fa fa-check"></i> Salvar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="container fundoCadastro" style="display: none; " id="cadastro">
    <a class="text-primary" style="cursor: pointer;" onclick="backLoginC()">
        <i class="fa fa-chevron-circle-left fa-4x" style="margin-top: 5px;  color: #8FBC8F;" id="back" aria-hidden="true"></i>
    </a>
    <div id="title" style="margin-bottom: 20px; text-align:center;">
        <h2 class="display-4"> Solicitar acesso </h2>
    </div>
    <div class="form-group container">
        <form class="form-horizontal" style="margin-top: 30px;" id="Cadastro-form" name="Cadastro-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="acao" id="acao" value="cadastrar">
            <input type="hidden" name="situacao" id="situacao" value="Administrador">
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <label class="" for="nome">
                            <h5> Nome completo: </h5>
                        </label>
                        <input type="text" class="form-control" id="nome" name="nome"> </input>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <label class="" for="email">
                            <h5> Email: </h5>
                        </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com"> </input>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <label for="cpf">
                            <h5> Cpf: </h5>
                        </label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="999.999.999-99"> </input>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <label for="senhaAdm">
                            <h5> Senha para acessar o sistema: </h5>
                        </label>
                        <input type="password" class="form-control" id="senhaAdm" name="senhaAdm"> </input>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <label for="equalSenha">
                            <h5> Repita a senha: </h5>
                        </label>
                        <input type="password" class="form-control" id="equalSenha" name="equalSenha"> </input>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-material">
                        <button type="submit" class="btn btn-success" style="margin-bottom: 30px;" id="btnCadastroAdm">
                            <i class="fa fa-check"></i> Solicitar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require '../inc/global/head_end.php';
?>
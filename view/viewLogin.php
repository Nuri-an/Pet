<?php
require '../inc/global/head_start.php';
?>

<link rel="stylesheet" href="../assets/css/login.css">

<script type="text/javascript" src="../assets/js/login.js"></script>

<div class="container fundo">
    <div class="container">
        <a href='index.php'>
            <i class="fa fa-chevron-circle-left fa-4x" style="margin-top: 5px;" id="back" aria-hidden="true"></i>
        </a>
        <div id="title" style="margin-bottom: 20px; text-align:center;">
            <h2 class="display-4"> Login </h2>
        </div>
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Endereço de email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Digite o endereço de email cadastrado.</small>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" aria-describedby="senhaHelp">
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
            <button type="submit" class="btn btn-primary" style="position:relative; left:50%; top: 10px; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);">Entrar</button>
        </form>
        <div style="text-align:center;">
            <a href="#"> Esqueceu a senha? </a>
            <br>
            <a href="#"> Solicitar acesso </a>
        </div>
    </div>
</div>

</div>
<?php
require '../inc/global/head_end.php';
?>
$(document).ready(function () {

    $("#back").click(function () {
        $('body').css('overflowY', 'hidden');
        $('#loader').show();
        $("#inicio").addClass('menuAtivo');
        $("#inicio").addClass('text-white');
    });

    $('#loader').slideUp(1000);
    $('body').css('overflowY', 'auto');
});

function mostraSenha(){
    $("input[name='checkMostarSenha']").prop('checked', true);
    $('#senha').attr('type', 'text');
    $('#mostrar').hide();
    $('#esconder').show();
}

function escondeSenha(){
    $("input[name='checkMostarSenha']").prop('checked', false);
    $('#senha').attr('type', 'password');
    $('#esconder').hide();
    $('#mostrar').show();
}


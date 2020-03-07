$(document).ready(function () {
    var quantidadePg = 10; //quantidade de registro por página
    var pagina = 1; //página inicial
    var now = new Date();
    var ano = now.getFullYear();

    listarPublicacoes(pagina, quantidadePg, ano); //Chamar a função para listar os registros

    $("#publicacoes").addClass('menuAtivo');
    $("#publicacoes").addClass('text-white');

    $(".nav-link").click(function () {
        $('body').css('overflowY', 'hidden');
        $('#loader').show();
    });

    $('#loader').slideUp(1000);
    $('body').css('overflowY', 'auto');
});



function listarPublicacoes(pagina, quantidadePg, ano) {
    var dados = {
        pagina: pagina,
        quantidadePg: quantidadePg,
        ano: ano
    }
    $.post('publicacoes.php', dados, function (retorna) {
        //Subtitui o valor no seletor id="externas"
        $("#corpo").html(retorna);
    });
}

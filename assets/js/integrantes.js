function atualizarInicio() {

    // carrega = #IdDeOndeVaiSerCarregadoOConteudo
    var carrega = $('#atualiza');

    //load(' ArquivoQueVaiSerCarregado.php #IdDaDivDoArquivoQueVAiSerCarregada')
    carrega.load('viewIntegrantesAdm.php #atualiza'); // carrega todo o conteúdo da div# do arquivo


    /******  Extrasss - Apagar Furamente *****/
    //load( 'arquivo.php', { 'cidades[]': ['Curitiba', 'Manaus'] } ); // carrega o arquivo e passa dados para o servidor
    //load( 'meu-arquivo.json', minha_funcao ) // carrega o arquivo e executa minha_funcao
    /*****************/

}

function atualizarInformacoes() {

    var formdata = new FormData($("form[name='atualizar-form']")[0]);

    dialog = bootbox.dialog({
        message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
        closeButton: false
    });

    $.ajax({
        type: 'POST',
        url: "../controller/ControllerIntegrantes.php",
        data: formdata,
        processData: false,
        contentType: false,

        success: function (result) {
            //alert(result);

            if (result == 1) {
                dialog.init(function () {
                    dialog.find('.bootbox-body').html('Dados alterados com sucesso!');
                });
                setTimeout(function () {
                    dialog.modal('hide');
                }, 3000); //3 segundos depois executa
            }
            if (result == 2) {
                dialog.init(function () {
                    dialog.find('.bootbox-body').html('Ocorreu um erro no processamento. Tente novamente mais tarde.');
                });
                setTimeout(function () {
                    dialog.modal('hide');
                }, 3000); //3 segundos depois executa
            }
        }
    });

    atualizarInicio();
    $('#modalAtualizar').modal('hide');
}

function verInformacoes(id) {
    var idIntegrante = $('#rowEditarInformacoes_' + id).attr("data-id");
    var nome = $('#rowEditarInformacoes_' + id).attr("data-nome");
    var email = $('#rowEditarInformacoes_' + id).attr("data-email");
    var cpf = $('#rowEditarInformacoes_' + id).attr("data-cpf");
    var dataInicio = $('#rowEditarInformacoes_' + id).attr("data-dataInicio");
    var dataFim = $('#rowEditarInformacoes_' + id).attr("data-dataFim");
    var situacao = $('#rowEditarInformacoes_' + id).attr("data-situacao");
    var social = $('#rowEditarInformacoes_' + id).attr("data-social");


    $('#modalAtualizar').modal('show');

    $("input[name='situacao'][value='" + situacao + "']").prop('checked', true);
    
    $('.modal .modal-dialog .modal-content #id').val(idIntegrante);
    $('.modal .modal-dialog .modal-content #nome').val(nome);
    $('.modal .modal-dialog .modal-content #email').val(email);
    $('.modal .modal-dialog .modal-content #cpf').val(cpf);
    $('.modal .modal-dialog .modal-content #dataInicio').val(dataInicio);
    $('.modal .modal-dialog .modal-content #dataFim').val(dataFim);
    $('.modal .modal-dialog .modal-content #social').val(social);
  
}
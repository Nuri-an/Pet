
    $(document).ready(function() {
        $("#integrantes").addClass('menuAtivo');
        $("#integrantes").addClass('text-white');

        $(".nav-link").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $('body').css('overflowY', 'hidden');
            $('#loader').show();
        });


        $('#loader').slideUp(1000);
        $('body').css('overflowY', 'auto');

        $("#cpf").mask("999.999.999-99", {
            reverse: true
        });

    });

    function abreT(indice) {
        var conteudo = $('#conteudoT' + indice);
        var foto = $('#fotoT' + indice);
        if (conteudo.hasClass('info')) {
            foto.slideUp();
            conteudo.removeClass('info');
        } else {
            conteudo.slideDown();
            foto.show();
            conteudo.addClass('info');
        }
    }

    function abreD(indice) {
        var conteudo = $('#conteudoD' + indice);
        var foto = $('#fotoD' + indice);
        if (conteudo.hasClass('info')) {
            foto.slideUp();
            conteudo.removeClass('info');
        } else {
            conteudo.slideDown();
            foto.show();
            conteudo.addClass('info');
        }
    }

    function nomeFoto() {
        if ($('#arquivo').val()) {
            var foto = $('#arquivo').val();
            var letra = '\\';

            posic = foto.indexOf(letra); //pega a posicao da letra
            while (foto.includes(letra)) {
                foto = foto.substring(posic); //exclui da string todas as letras ate a posicao desejada
            }
            $('.form-group .col-md-12 .form-material .custom-file #foto').html(foto);
        }
    }

$.validator.addMethod("nomeCompleto", function (value, element) {
    if (value.includes(' ')) {
        return true
    } else {
        return false
    }
}, "Digite o nome completo do integrante")


$(document).ready(function () {
    $('#btnEditarInfo').click(function () {
        jQuery("#atualizar-form").validate({
            focusInvalid: true,
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: (error, e) => {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: e => {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: e => {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: {
                'nome': {
                    required: true,
                    nomeCompleto: true
                },
                'email': {
                    email: true
                },
                'social': {
                    url: true
                },
                'cpf': {
                    cpfBR: true
                },
                'dataInicio': {
                    required: true,
                    date: true
                },
                'situacao': {
                    required: true,
                },
                'arquivo': {
                    extension: "jpg|JPG|png|PNG|jpeg|JPEG"
                }
            },
            messages: {
                'nome': {
                    required: 'Por favor, preeencha este campo'
                },
                'email': {
                    email: 'Digite um endereço de email válido',
                },
                'social': {
                    url: 'Digite um link válido',
                },
                'cpf': {
                    cpfBR: 'Digite um cpf válido'
                },
                'dataInicio': {
                    required: 'Por favor, insira a data de entrada do integrante no grupo',
                },
                'situacao': {
                    required: 'Por favor, selecione a situação atual do integrante',
                }
            },
            submitHandler: function (form) {
                //alert("enta coletando dados do form");
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
                                dialog.find('.bootbox-body').html('Operação realizada com sucesso!');
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
                        atualizarInicio();
                    }
                });
                $('#modalAtualizar').modal('hide');
                $('#atualizar-form').trigger("reset");
                return false;
            }

        });
        //alert("entrou");
    });
});

function excluir(id) {
    var cod = $('#rowExcluirFoto_' + id).attr("data-id");
    var tipo = $('#rowExcluirFoto_' + id).attr("data-tipo");
    bootbox.dialog({
        title: 'Opções para excluir',
        message: "<p>Escolha o que você deseja excluir.</p>",
        buttons: {
            foto: {
                label: "Excluir somente foto",
                className: 'btn-warning',
                callback: function () {
                    dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                        closeButton: false
                    });
                    $.ajax({
                        type: "POST",
                        url: "../controller/ControllerIntegrantes.php",
                        data: {
                            acao: "excluirFoto",
                            id: cod
                        },
                        success: function (resultado) {
                            //alert(resultado);
                            if (resultado == 1) {
                                dialog.init(function () {
                                    dialog.find('.bootbox-body').html('A foto foi excluída com sucesso!');
                                });
                                setTimeout(function () {
                                    dialog.modal('hide');
                                }, 3000); //3 segundos depois executa
                            }

                            else {
                                dialog.init(function () {
                                    dialog.find('.bootbox-body').html('Não foi possível excluir a foto. Tente novamente mais tarde.');
                                });
                                setTimeout(function () {
                                    dialog.modal('hide');
                                }, 3000); //3 segundos depois executa
                            }
                            atualizarInicio();
                        }
                    });
                }
            },
            user: {
                label: "Excluir integrante",
                className: 'btn-info',
                callback: function () {
                    dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                        closeButton: false
                    });
                    $.ajax({
                        type: "POST",
                        url: "../controller/ControllerIntegrantes.php",
                        data: {
                            acao: "excluirInt",
                            id: cod,
                            tipo: tipo
                        },
                        success: function (resultado) {
                            //alert(resultado);
                            if (resultado == 1) {
                                dialog.init(function () {
                                    dialog.find('.bootbox-body').html('Integrante excluído com sucesso!');
                                });
                                setTimeout(function () {
                                    dialog.modal('hide');
                                }, 3000); //3 segundos depois executa
                            }

                            else {
                                dialog.init(function () {
                                    dialog.find('.bootbox-body').html('Não foi possível excluir o integrante. Tente novamente mais tarde.');
                                });
                                setTimeout(function () {
                                    dialog.modal('hide');
                                }, 3000); //3 segundos depois executa
                            }
                            atualizarInicio();
                        }
                    });
                }
            }
        }
    });
}
function atualizarInicio() {
    $("#atualiza").load('viewIntegrantesAdm.php #atualiza');
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
    var foto = $('#rowEditarInformacoes_' + id).attr("data-foto");
    var acao = "editar";


    $('#atualizar-form').trigger("reset");
    $('#modalAtualizar').modal('show');

    $('.form-group .col-md-12 .form-material .custom-file #foto').html(foto);
    $("input[name='situacao'][value='" + situacao + "']").prop('checked', true);

    if(situacao == 'Tutor(a)'){
        $("input[name='situacao'][value='Bolsista']").prop('disabled', true);
        $("input[name='situacao'][value='Voluntário']").prop('disabled', true);
        $("input[name='situacao'][value='Tutor(a)']").prop('disabled', false);
    }
    else if(situacao != 'Tutor(a)'){
        $("input[name='situacao'][value='Bolsista']").prop('disabled', false);
        $("input[name='situacao'][value='Voluntário']").prop('disabled', false);
        $("input[name='situacao'][value='Tutor(a)']").prop('disabled', true);
    }

    $('.modal .modal-dialog .modal-content #tituloP').text("Edite as informações");
    $('.modal .modal-dialog .modal-content #id').val(idIntegrante);
    $('.modal .modal-dialog .modal-content #nome').val(nome);
    $('.modal .modal-dialog .modal-content #email').val(email);
    $('.modal .modal-dialog .modal-content #cpf').val(cpf);
    $('.modal .modal-dialog .modal-content #dataInicio').val(dataInicio);
    $('.modal .modal-dialog .modal-content #dataFim').val(dataFim);
    $('.modal .modal-dialog .modal-content #social').val(social);
    $('.modal .modal-dialog .modal-content #acao').val(acao);

}


function newDiscente() {

    var acao = 'adicionar';
    var tipo = 'discente';

    $("input[name='situacao'][value='Tutor(a)']").prop('disabled', true);
    $("input[name='situacao'][value='Bolsista']").prop('disabled', false);
    $("input[name='situacao'][value='Voluntário']").prop('disabled', false);

    $('#atualizar-form').trigger("reset");
    $('#modalAtualizar').modal('show');

    $('.modal .modal-dialog .modal-content #tituloP').text("Adicione um novo discente ao grupo");
    $('.modal .modal-dialog .modal-content #acao').val(acao);
    $('.modal .modal-dialog .modal-content #tipo').val(tipo);
}
function newTutores() {

    var acao = 'adicionar';
    var tipo = 'tutor';
    $('#atualizar-form').trigger("reset");

    $("input[name='situacao'][value='Tutor(a)']").prop('disabled', false);
    $("input[name='situacao'][value='Bolsista']").prop('disabled', true);
    $("input[name='situacao'][value='Voluntário']").prop('disabled', true);

    $('#modalAtualizar').modal('show');

    $('.modal .modal-dialog .modal-content #tituloP').text("Adicione um novo tutor ao grupo");
    $('.modal .modal-dialog .modal-content #acao').val(acao);
    $('.modal .modal-dialog .modal-content #tipo').val(tipo);
}


function openNewModal() {
    //fecha o elemento erro na validação
    var feedback = $(".invalid-feedback");
    feedback.hide();
}
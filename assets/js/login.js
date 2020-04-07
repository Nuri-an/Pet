$(document).ready(function () {

    $("#back").click(function () {
        $('body').css('overflowY', 'hidden');
        $('#loader').show();
        $("#inicio").addClass('menuAtivo');
        $("#inicio").addClass('text-white');
    });

    $('#loader').slideUp(1000);
    $('body').css('overflowY', 'auto');

    $("#cpf").mask("999.999.999-99", {
        reverse: true
    });
});

$(document).ready(function () {
    $('#btnEntrar').click(function () {
        alert('entrou');
        $('#cpfHelp').hide();
        $('#senhaHelp').hide();
        jQuery("#logar-form").validate({
            focusInvalid: true,
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: (error, e) => {
                jQuery(e).parents('.form-group').append(error);
            },
            highlight: e => {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: e => {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: {
                'cpf': {
                    required: true,
                    cpfBR: true,
                },
                'senha': {
                    required: true,
                }
            },
            messages: {
                'cpf': {
                    required: 'É necessário informar o cpf cadastrado',
                    cpfBR: 'Digite um cpf válido',
                },
                'senha': {
                    required: 'É necessário informar a senha cadastrada',
                }
            },
            submitHandler: function (form) {
                alert("está coletando dados do form");
                var dados = $('#logar-form').serializeArray();
                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });

                $.ajax({
                    type: 'POST',
                    url: "../controller/controllerLogin.php",
                    data: dados,

                    success: function (result) {
                        alert(result);

                        if (result == 0) {
                            dialog.init(function () {
                                dialog.modal('hide');
                            });
                            $('body').css('overflowY', 'hidden');
                            $('#loader').show();
                            window.location="../view/index.php";
                        }
                        if (result == 1) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Senha incorreta.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }
                        if (result == 2) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('O cpf digitado não foi encontrado.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }
                    }
                });
                return false;
            }

        });
    });
});

function mostraSenha() {
    $("input[name='checkMostarSenha']").prop('checked', true);
    $('#senha').attr('type', 'text');
    $('#mostrar').hide();
    $('#esconder').show();
}

function escondeSenha() {
    $("input[name='checkMostarSenha']").prop('checked', false);
    $('#senha').attr('type', 'password');
    $('#esconder').hide();
    $('#mostrar').show();
}


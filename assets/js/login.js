$(document).ready(function () {

    $("#back").click(function () {
        $('body').css('overflowY', 'hidden');
        $('#loader').show();
        $("#inicio").addClass('menuAtivo');
        $("#inicio").addClass('text-white');
    });

    $('#loader').slideUp(1000);
    $('body').css('overflowY', 'auto');

    $("#login #cpf").mask("999.999.999-99", {
        reverse: true
    });
    
    $("#cadastro #cpf").mask("999.999.999-99", {
        reverse: true
    });
});

$(document).ready(function () {
    $('#btnEntrar').click(function () {
        var validator = $("#logar-form").validate();
        validator.destroy();
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
                //alert("está coletando dados do form");
                var dados = $('#logar-form').serializeArray();
                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });

                $.ajax({
                    type: 'POST',
                    url: "../controller/ControllerLogin.php",
                    data: dados,

                    success: function (result) {
                        //alert(result);

                        if (result == 0) {
                            dialog.init(function () {
                                dialog.modal('hide');
                            });
                            $('body').css('overflowY', 'hidden');
                            $('#loader').show();
                            window.location = "../view/index.php";
                        }
                        else if (result == 2) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('O cpf digitado não foi encontrado.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }
                        else if (result == 3) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Sua solicitação de acesso precisa ser aprovada por um administrador. Aguarde a resposta em seu email.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 10000); //3 segundos depois executa
                        }
                        else {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Senha incorreta.');
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


function cadastroAdm() {
    $('#login').slideUp(1000);
    $('#cadastro').show();
}


function backLoginC() {
    $('#cadastro').hide();
    $('#login').show();
    $('#logar-form').trigger("reset");
    escondeSenha();
}

function backLoginS() {
    $('#esqueceuSenha').hide();
    $('#login').show();
    $('#logar-form').trigger("reset");
    escondeSenha();
}

$.validator.addMethod("nomeCompleto", function (value, element) {
    if (value.includes(' ')) {
        return true
    } else {
        return false
    }
}, "Digite seu nome completo")

$(document).ready(function () {
    $('#btnEsqueceuSenha').click(function () {
        var validator = $("#logar-form").validate();
        validator.destroy();
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
                    required: false
                }
            },
            messages: {
                'cpf': {
                    required: 'É necessário informar o cpf cadastrado',
                    cpfBR: 'Digite um cpf válido',
                }
            },
            submitHandler: function (form) {
                var dados = $('#logar-form').serializeArray();
                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });

                $.ajax({
                    type: 'POST',
                    url: "../controller/ControllerLogin.php",
                    data: dados,

                    success: function (result) {
                        //alert(result);

                        if (result == 2) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('O cpf digitado não foi encontrado.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }
                        else if (result == 3) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Sua solicitação de acesso precisa ser aprovada por um administrador. Aguarde a resposta em seu email.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 10000); //3 segundos depois executa
                        }
                        else {

                            dialog.modal('hide');
                            dialog = bootbox.dialog({
                                message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Estamos te envindo um código por email...</p>',
                                closeButton: false
                            });

                            $.ajax({
                                type: "POST",
                                url: "../controller/ControllerLogin.php",
                                data: {
                                    acao: "gerarCod",
                                    id: result
                                },
                                success: function (envio) {
                                    alert(envio);
                                    if (envio == 1) {
                                        dialog.init(function () {
                                            dialog.find('.bootbox-body').html('Detectamos algum erro. Caso não tenha recebido o email, tente novamente mais tarde.');
                                        });
                                        setTimeout(function () {
                                            dialog.modal('hide');
                                        }, 3000); //3 segundos depois executa
                                    } else {
                                        dialog.init(function () {
                                            dialog.find('.bootbox-body').html('Email enviado com sucesso!');
                                        });
                                        setTimeout(function () {
                                            dialog.modal('hide');
                                        }, 3000); //3 segundos depois executa
                                    }
                                    $('#login').slideUp(1000);
                                    $('#esqueceuSenha').show();
                                }
                            });
                        }
                    }
                });
                return false;
            }
        });
    });
});


$(document).ready(function () {
    $('#btnValidaCod').click(function () {
        $('#codHelp').hide();
        //alert('clicou');
        jQuery("#ValidaCod-form").validate({
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
                'codigo': {
                    required: true,
                }
            },
            messages: {
                'codigo': {
                    required: 'Por favor, preeencha este campo',
                }
            },
            submitHandler: function (form) {
                //alert('coletando dados');
                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Validando...</p>',
                    closeButton: false
                });
                var dados = $('#ValidaCod-form').serializeArray();
                //alert(dados);
                $.ajax({
                    type: "POST",
                    url: "../controller/ControllerLogin.php",
                    data: dados,

                    success: function (cod) {
                        if (cod == 1) {
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 2000); //3 segundos depois executa
                            $('#ValidaCod').hide();
                            $('#RedefinirSenha').show();
                        } else {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('O código digitado está incorreto.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 2000); //3 segundos depois executa
                        }
                        //alert(cod);
                    }
                });
            }
        });
    });
});




$(document).ready(function () {
    $('#btnRedefinirSenha').click(function () {
        jQuery("#RedefinirSenha-form").validate({
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
                'newSenha': {
                    required: true,
                },
                'equalNewSenha': {
                    required: true,
                    equalTo: '#newSenha'
                },
            },
            messages: {
                'newSenha': {
                    required: 'Por favor, preeencha este campo',
                },
                'equalNewSenha': {
                    required: 'Por favor, preeencha este campo',
                    equalTo: 'Por favor, repita a mesma senha',
                }
            },
            submitHandler: function (form) {
                var dados = $('#RedefinirSenha-form').serializeArray();
                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });
                $.ajax({
                    type: "POST",
                    url: "../controller/ControllerLogin.php",
                    data: dados,

                    success: function (cod) {
                        //alert(cod);
                        if (cod == 1) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Senha alterada com sucesso');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                            backLoginS();
                        } else {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Ocorreu um erro no processamento. Tente novamente mais tarde.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 2000); //3 segundos depois executa
                        }
                    }
                });
            }
        });
    });
});


$(document).ready(function () {
    $('#btnCadastroAdm').click(function () {
        jQuery("#Cadastro-form").validate({
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
                    required: true,
                    email: true
                },
                'cpf': {
                    required: true,
                    cpfBR: true
                },
                'senhaAdm': {
                    required: true,
                    minlength: 6
                },
                'equalSenha': {
                    required: true,
                    equalTo: '#senhaAdm'
                },
            },
            messages: {
                'nome': {
                    required: 'Por favor, preeencha este campo'
                },
                'email': {
                    required: 'Por favor, preeencha este campo',
                    email: 'Digite um endereço de email válido',
                },
                'cpf': {
                    required: 'Por favor, preeencha este campo',
                    cpfBR: 'Digite um cpf válido'
                },
                'senhaAdm': {
                    required: 'Por favor, preeencha este campo',
                    minlength: 'A senha deve ter mais de 6 caracteres',
                },
                'equalSenha': {
                    required: 'Por favor, preeencha este campo',
                    equalTo: 'Por favor, repita a mesma senha de acesso',
                }
            },
            submitHandler: function (form) {
                bootbox.confirm({
                    message: "Confirme se você conferiu as informações e se realmente deseja solicitar acesso a área administrativa do sistema.",
                    buttons: {
                        confirm: {
                            label: 'Sim, conferi as informações e desejo solicitar acesso',
                            className: 'btn-warning'
                        },
                        cancel: {
                            label: 'Não',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            //alert("enta coletando dados do form");
                            var dados = $('#Cadastro-form').serializeArray();

                            dialog = bootbox.dialog({
                                message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                                closeButton: false
                            });

                            $.ajax({
                                type: 'POST',
                                url: "../controller/ControllerLogin.php",
                                data: dados,

                                success: function (result) {
                                    //alert(result);

                                    if (result == 1) {
                                        dialog.init(function () {
                                            dialog.find('.bootbox-body').html('Solicitção realizada. Aguarde a confimação em seu email.');
                                        });
                                        setTimeout(function () {
                                            dialog.modal('hide');
                                        }, 5000); //3 segundos depois executa
                                        backLoginC();
                                    } else if(result == 3) {
                                        dialog.init(function () {
                                            dialog.find('.bootbox-body').html('Seu CPF já está cadastrado no sistema. Se não consegue acessar, volte ao login e redefina sua senha, ou aguarde seu acesso ser aprovado.');
                                        });
                                        setTimeout(function () {
                                            dialog.modal('hide');
                                        }, 7000); //3 segundos depois executa
                                    }
                                    else {
                                        dialog.init(function () {
                                            dialog.find('.bootbox-body').html('Ocorreu um erro no processamento. Tente novamente mais tarde.');
                                        });
                                        setTimeout(function () {
                                            dialog.modal('hide');
                                        }, 3000); //3 segundos depois executa
                                    }
                                    $('#Cadastro-form').trigger("reset");
                                }
                            });
                        }
                    }
                });
                return false;
            }
        });
        //alert("entrou");
    });
});
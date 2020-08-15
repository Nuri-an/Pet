$(document).ready(function () {
    atualizar();
    $("#administradores").addClass('menuAtivo');
    $("#administradores").addClass('font-weight-bold');

    $(".nav-link").click(function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $('body').css('overflowY', 'hidden');
        $('#loader').show();
    });

    $('#loader').slideUp(1000);
    $('body').css('overflowY', 'auto');
});


function atualizar() {

    var quantidadePg = 10; //quantidade de registro por página
    var pagina = 1; //página inicial

    listarAdministradores(pagina, quantidadePg); //Chamar a função para listar os registros

}


function listarAdministradores(pagina, quantidadePg) {

    var dados = {
        pagina: pagina,
        quantidadePg: quantidadePg
    }
    $.post('postAdministradores.php', dados, function (retorna) {
        //Subtitui o valor no seletor id="externas"
        $("#corpo").html(retorna);
    });
}

function aceitarAdm(id) {
    var cod = $('#rowAceitarAdm_' + id).attr("data-id");
    var nome = $('#rowAceitarAdm_' + id).attr("data-nome");
    bootbox.confirm({
        message: 'Você realmente deseja aceitar '+ nome +' como administrador(a) ?',
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-warning'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });


                $.ajax({
                    type: "POST",
                    url: "../controller/ControllerAdministradores.php",
                    data: {
                        id: cod,
                        acao: "aceitar"
                    },

                    success: function (resultado) {
                        if (resultado == 2)  {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Não foi possível aceitar a solicitação. Tente novamente mais tarde.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }
                        else {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Solicitação aceita!');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                            atualizar();
                        }

                    }
                });
            }
        }
    });
}


function cancelarAdm(id) {
    var cod = $('#rowCancelarAdm_' + id).attr("data-id");
    var nome = $('#rowCancelarAdm_' + id).attr("data-nome");
    bootbox.confirm({
        message: 'Você realmente deseja cancelar a solicitação de ' + nome + ' ?',
        buttons: {
            cancel: {
                label: 'Não',
                className: 'btn-warning'
            },
            confirm: {
                label: 'Sim',
                className: 'btn-danger'
            },
        },
        callback: function (result) {
            if (result) {
                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });


                $.ajax({
                    type: "POST",
                    url: "../controller/ControllerAdministradores.php",
                    data: {
                        id: cod,
                        acao: "cancelar"
                    },

                    success: function (resultado) {
                        if (resultado == 2) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Não foi possível cancelar a solicitação. Tente novamente mais tarde.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }
                        else{
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Cancelada com sucesso!');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                            atualizar();
                        }
                    }
                });
            }
        }
    });
}

function excluirPerfil(id) {
    var cod = $('#buttonExcluirPerfil').attr("data-id");
    alert(cod);
    bootbox.confirm({
        message: 'Você realmente deseja excluir seu perfil ?',
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-danger'
            },
            cancel: {
                label: 'Não',
                className: 'btn-warning'
            }
        },
        callback: function (result) {
            if (result) {
                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });


                $.ajax({
                    type: "POST",
                    url: "../controller/ControllerAdministradores.php",
                    data: {
                        id: cod,
                        acao: "excluirPerfil"
                    },

                    success: function (resultado) {
                        alert(resultado);
                        if (resultado == 1)  {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Seu perfil foi excluído com sucesso!');
                            });
                            setTimeout(function () {
                                window.location.href='index.php';
                            }, 5000); //3 segundos depois executa
                        }
                        else {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Não foi possível excluir. Tente novamente mais tarde.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }

                    }
                });
            }
        }
    });
}

$(document).ready(function () {
    atualizar();
    $("#projetos").addClass('menuAtivo');
    $("#projetos").addClass('text-white');

    $(".nav-link").click(function () {
        $('body').css('overflowY', 'hidden');
        $('#loader').show();
    });

    $('#loader').slideUp(1000);
    $('body').css('overflowY', 'auto');
});


function atualizar() {

    var quantidadePg = 5; //quantidade de registro por página
    var pagina = 1; //página inicial
    var now = new Date();
    var ano = now.getFullYear();

    listarProjetos(pagina, quantidadePg, ano); //Chamar a função para listar os registros

}


function listarProjetos(pagina, quantidadePg, ano) {
    if ($("li").hasClass('paginacao')) {
        classe = 1;
    }

    var dados = {
        pagina: pagina,
        quantidadePg: quantidadePg,
        ano: ano
    }
    $.post('projetos.php', dados, function (retorna) {
        //Subtitui o valor no seletor id="externas"
        $("#corpo").html(retorna);

       // alert(classe);
        if (classe == 1) {
            $.get("projetos.php", function () {
                var divEditar = $('.editar');

                divEditar.show();

                $('li').addClass('paginacao');
            });
        }
    });
}

function lerMenos(id) {
    var div = $('#descricao_' + id);
    var botao = $('#rowLerMais_' + id);
    var newBotao = $('#rowLerMenos_' + id);

    div.hide();
    newBotao.hide();
    botao.show();
}


function lerMais(id) {
    var div = $('#descricao_' + id);
    var botao = $('#rowLerMais_' + id);
    var newBotao = $('#rowLerMenos_' + id);

    div.show();
    botao.hide();
    newBotao.show();
}

function editar_modal(id) {
    $.get("viewProjetosAdm.php", function () {

        var cod = $('#rowEditarProjetos_' + id).attr("data-id");
        var titulo = $('#rowEditarProjetos_' + id).attr("data-titulo");
        var descricao = $('#rowEditarProjetos_' + id).attr("data-descricao");
        var midia = $('#rowEditarProjetos_' + id).attr("data-midia");
        var ano = $('#rowEditarProjetos_' + id).attr("data-ano");
        var publicacao = $('#rowEditarProjetos_' + id).attr("data-publicacao");
        var parceria = $('#rowEditarProjetos_' + id).attr("data-parceria");
        //var acao = 'editarF';
//alert(publicacao);

        $('#Projetos-form').trigger("reset");
        $('#excluirProjeto').show();
        $('#verProjetos').modal('show');

        $('.modal .modal-dialog .modal-content #tituloModal').html('Edite as informações sobre o projetos');
        $('.modal .modal-dialog .modal-content #Projetos-form  #acao').val('editar');
        $('.modal .modal-dialog .modal-content #Projetos-form #id').val(cod);
        $('.modal .modal-dialog .modal-content #excluirProjetos-form #id').val(cod);
        $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
        $('.modal .modal-dialog .modal-content  #descricao').val(descricao);
        $('.modal .modal-dialog .modal-content  #data').val(ano);
        $('.modal .modal-dialog .modal-content .custom-file #midia').html(midia);
        $('.modal .modal-dialog .modal-content  #publicacao').val(publicacao);
        $('.modal .modal-dialog .modal-content  #parceria').val(parceria);

    });
}

function adicionar_modal(id) {
    $.get("viewProjetosAdm.php", function () {

        $('#Projetos-form').trigger("reset");
        $('#excluirProjeto').hide();
        $('#verProjetos').modal('show');

        $('.modal .modal-dialog .modal-content #tituloModal').html('Adicione um projetos à lista');
        $('.modal .modal-dialog .modal-content  #acao').val('adicionar');
        $('#midia').html('');
    });
}

function nomeMidiaAdd() {
    if ($('#arquivo').val()) {
        var foto = $('#arquivo').val();
        var letra = '\\';

        posic = foto.indexOf(letra); //pega a posicao da letra
        while (foto.includes(letra)) {
            foto = foto.substring(posic); //exclui da string todas as letras ate a posicao desejada
        }
        $('#midia').html(foto);
    }
}

$(document).ready(function () {
    $('#btnProjeto').click(function () {
        jQuery("#Projetos-form").validate({
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
                'descricao': {
                    required: true
                },
                'titulo': {
                    required: true
                },
                'data': {
                    required: true,
                    maxlength: 4,
                    minlength: 4
                },
                'publicacao': {
                    required: false
                },
                'parceria': {
                    required: false
                },
                'midia': {
                    required: false
                },
            },
            messages: {
                'descricao': {
                    required: 'Por favor, preeencha este campo',
                },
                'data': {
                    required: 'Por favor, preeencha este campo',
                },
                'titulo': {
                    required: 'Por favor, preeencha este campo',
                }
            },
            submitHandler: function (form) {
                //alert("enta coletando dados do form");
                var formdata = new FormData($("form[name='Projetos-form']")[0]);

                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });

                $.ajax({
                    type: 'POST',
                    url: "../controller/ControllerProjetos.php",
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function (result) {
                        //(result);

                        if ((result == 1) || (result == 3)) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Adicionada com sucesso!');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }
                        else {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Ocorreu um erro no processamento. Tente novamente mais tarde.');
                            });
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 3000); //3 segundos depois executa
                        }
                        
                        atualizar();
                    }
                });
                $('#verProjetos').modal('hide');
                $('#Proetos-form').trigger("reset");
                return false;
            }
        });
        //alert("entrou");
    });
});


$(document).ready(function () {
    $('#btnExcluirProjeto').click(function () {
      var dados = $('#excluirProjetos-form').serializeArray();
      $('#verProjetos').modal('hide');
      bootbox.confirm({
        message: "Você realmente deseja excluir esse projeto da lista ?",
        buttons: {
          confirm: {
            label: 'Sim',
            className: 'btn-primary'
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
              url: "../controller/ControllerProjetos.php",
              data: dados,
  
              success: function (resultado) {
                //alert(resultado);
                if (resultado == 1) {
                  dialog.init(function () {
                    dialog.find('.bootbox-body').html('Excluído com sucesso!');
                  });
                  setTimeout(function () {
                    dialog.modal('hide');
                  }, 3000); //3 segundos depois executa
                  atualizar();
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
      return false;
    });
  });


function openNewModal() {
    //fecha o elemento erro na validação
    var feedback = $(".invalid-feedback");
    feedback.hide();
}
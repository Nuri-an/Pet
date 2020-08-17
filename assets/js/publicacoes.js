$(document).ready(function () {
    atualizar();
    $("#publicacoes").addClass('menuAtivo');
    $("#publicacoes").addClass('font-weight-bold');

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
    var now = new Date();
    var ano = now.getFullYear();

    listarPublicacoes(pagina, quantidadePg, ano); //Chamar a função para listar os registros

  }


function listarPublicacoes(pagina, quantidadePg, ano) {
    if ($("li").hasClass('paginacao')) {
        classe = 1;
    }

    var dados = {
        pagina: pagina,
        quantidadePg: quantidadePg,
        ano: ano
    }
    $.post('postPublicacoes.php', dados, function (retorna) {
        //Subtitui o valor no seletor id="externas"
        $("#corpo").html(retorna);

        //alert(classe);
        if (classe == 1) {
            $.get("postPublicacoes.php", function () {
                var divEditar = $('.editar');

                divEditar.show();

                $('li').addClass('paginacao');
            });
        }
    });
}

function editar_modal(id) {

    var cod = $('#rowEditarPublicacao_' + id).attr("data-id");
    var data = $('#rowEditarPublicacao_' + id).attr("data-data");
    var descricao = $('#rowEditarPublicacao_' + id).attr("data-descricao");
    var link = $('#rowEditarPublicacao_' + id).attr("data-link");
    var acao = 'editar';
    var excluir = $('#excluir');


    $('#Publicacoes-form').trigger("reset");
    $('#verPublicacoes').modal('show');
    excluir.show();


    $('.modal .modal-dialog .modal-content .modal-title').html('Edite as informações sobre a publicações');
    $('.modal .modal-dialog .modal-content #Publicacoes-form #acao').val(acao);
    $('.modal .modal-dialog .modal-content #Publicacoes-form #id').val(cod);
    $('.modal .modal-dialog .modal-content #excluirPublicacoes-form #id').val(cod);
    $('.modal .modal-dialog .modal-content  #descricao').val(descricao);
    $('.modal .modal-dialog .modal-content #link').val(link);
    $('.modal .modal-dialog .modal-content  #data').val(data);

}


function adicionar_modal() {

  var excluir = $('#excluir');
  var acao = 'adicionar';


    $('#Publicacoes-form').trigger("reset");
    $('#verPublicacoes').modal('show');
    excluir.hide();


    $('.modal .modal-dialog .modal-content .modal-title').html('Adicione uma publicacão');
    $('.modal .modal-dialog .modal-content #Publicacoes-form #acao').val(acao);

}


$(document).ready(function () {
    $('#btnPublicacao').click(function () {
        jQuery("#Publicacoes-form").validate({
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
                'link': {
                    required: false,
                    url: true
                },
                'data': {
                    required: true,
                    number: true
                }
            },
            messages: {
                'descricao': {
                    required: 'Por favor, preeencha este campo',
                },
                'data': {
                    required: 'Por favor, preeencha este campo',
                }
            },
            submitHandler: function (form) {
                var dados = $('#Publicacoes-form').serializeArray();

                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });

                $.ajax({
                    type: 'POST',
                    url: "../controller/ControllerPublicacoes.php",
                    data: dados,

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
                $('#verPublicacoes').modal('hide');
                $('#Publicacoes-form').trigger("reset");
                return false;
            }
        });
    });
});

  $(document).ready(function () {
    $('#btnExcluirPublicacao').click(function () {
      var dados = $('#excluirPublicacoes-form').serializeArray();
      $('#verPublicacoes').modal('hide');
      bootbox.confirm({
        message: "Você realmente deseja excluir essa publicação da lista ?",
        buttons: {
          cancel: {
            label: 'Não',
            className: 'btn-warning'
          },
          confirm: {
            label: 'Sim',
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
              url: "../controller/ControllerPublicacoes.php",
              data: dados,
  
              success: function (resultado) {
                //alert(resultado);
                if (resultado == 1) {
                  dialog.init(function () {
                    dialog.find('.bootbox-body').html('Excluída com sucesso!');
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
  
  


$(document).ready(function () {
  atualizar();
  $("#noticias").addClass('menuAtivo');
  $("#noticias").addClass('font-weight-bold');

  $(".nav-link").click(function () {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    $('body').css('overflowY', 'hidden');
    $('#loader').show();
  });

  $('#loader').slideUp(1000);
  $('body').css('overflowY', 'auto');

});

function atualizar() {
  var quantidadePg = 7; //quantidade de registro por página
  var pagina = 1; //página inicial

  listarNoticias(pagina, quantidadePg); //Chamar a função para listar os registros
}



function listarNoticias(pagina, quantidadePg) {
  if ($("li").hasClass('paginacao')) {
    classe = 1;
  }

  var dados = {
    paginaIn: pagina,
    quantidadePgIn: quantidadePg
  }

  $.post('noticias.php', dados, function (retorna) {
    //Subtitui o valor no seletor id="externas"
    $("#corpo").html(retorna);

    //alert(classe);
    if (classe == 1) {
      $.get("noticias.php", function () {
        var divEditar = $('.editar');

        divEditar.show();

        $('li').addClass('paginacao');
      });
    }
  });

}


function lerMais(id) {
  var botao = $('#rowLerMais_' + id);
  var newBotao = $('#rowLerMenos_' + id);
  var midia = $('#collapseMidia_' + id);
  var resumo = $('#collapseResumo_' + id);

  midia.removeClass('float-left');
  midia.addClass('mx-auto');
  midia.addClass('d-block');
  resumo.hide();
  botao.hide();
  newBotao.show();
}

function lerMenos(id) {
  var botao = $('#rowLerMais_' + id);
  var newBotao = $('#rowLerMenos_' + id);
  var midia = $('#collapseMidia_' + id);
  var resumo = $('#collapseResumo_' + id);

  midia.removeClass('mx-auto');
  midia.removeClass('d-block');
  midia.addClass('float-left');
  resumo.show();
  newBotao.hide();
  botao.show();
}


function editar_modal(id) {
  $.get("viewNoticiasAdm.php", function () {

    var cod = $('#rowEditarNoticia_' + id).attr("data-id");
    var titulo = $('#rowEditarNoticia_' + id).attr("data-titulo");
    var descricao = $('#rowEditarNoticia_' + id).attr("data-descricao");
    var resumo = $('#rowEditarNoticia_' + id).attr("data-resumo");
    var midia = $('#rowEditarNoticia_' + id).attr("data-midia");
    var data = $('#rowEditarNoticia_' + id).attr("data-data");
    //var acao = 'editarF';

    $('#editarNoticias-form').trigger("reset");
    $('#verEditarNoticias').modal('show');

    $('.modal .modal-dialog .modal-content #editarNoticias-form #id').val(cod);
    $('.modal .modal-dialog .modal-content #excluirNoticias-form #id').val(cod);
    $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
    $('.modal .modal-dialog .modal-content  #descricao').val(descricao);
    $('.modal .modal-dialog .modal-content  #resumo').val(resumo);
    $('.modal .modal-dialog .modal-content .custom-file #midia').html(midia);
    $('.modal .modal-dialog .modal-content  #data').val(data);

  });
}


function adicionar_modal() {
  $.get("viewNoticiasAdm.php", function () {

    $('#adicionarNoticias-form').trigger("reset");
    $('#adicionarNoticias-form .form-group .col-md-12 .form-material .custom-file #arquivo').html('');
    $('#editarNoticias-form .form-group .col-md-12 .form-material .custom-file #arquivo').html('');
    $('#verAdicionarNoticias').modal('show');


    $('.modal .modal-dialog .modal-content #adicionarNoticias-form #localNoticia').val(local);
  });
}

function nomeMidiaAdd() {
  if ($('#adicionarNoticias-form .form-group .col-md-12 .form-material .custom-file #arquivo').val()) {
    var foto = $('#adicionarNoticias-form .form-group .col-md-12 .form-material .custom-file #arquivo').val();
    var letra = '\\';

    posic = foto.indexOf(letra); //pega a posicao da letra
    while (foto.includes(letra)) {
      foto = foto.substring(posic); //exclui da string todas as letras ate a posicao desejada
    }
    $('#adicionarNoticias-form .form-group .col-md-12 .form-material .custom-file #midia').html(foto);
  }
}

function nomeMidiaEdit() {
  if ($('#editarNoticias-form .form-group .col-md-12 .form-material .custom-file #arquivo').val()) {
    var foto = $('#editarNoticias-form .form-group .col-md-12 .form-material .custom-file #arquivo').val();
    var letra = '\\';

    posic = foto.indexOf(letra); //pega a posicao da letra
    while (foto.includes(letra)) {
      foto = foto.substring(posic); //exclui da string todas as letras ate a posicao desejada
    }
    $('#editarNoticias-form .form-group .col-md-12 .form-material .custom-file #midia').html(foto);
  }
}


$(document).ready(function () {
  $('#btnAdicionarNoticia').click(function () {
    jQuery("#adicionarNoticias-form").validate({
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
        'titulo': {
          required: true
        },
        'descricao': {
          required: true
        },
        'resumo': {
          required: true
        },
        'arquivo': {
          required: false,
          extension: "jpg|JPG|png|PNG|jpeg|JPEG"
        },
        'data': {
          required: true,
          date: true
        }
      },
      messages: {
        'titulo': {
          required: 'Por favor, preeencha este campo'
        },
        'descricao': {
          required: 'Por favor, preeencha este campo',
        },
        'resumo': {
          required: 'Por favor, preeencha este campo'
        },
        'arquivo': {
          required: 'Por favor, preeencha este campo',
        },
        'data': {
          required: 'Por favor, preeencha este campo',
        }
      },
      submitHandler: function (form) {
        //alert("enta coletando dados do form");
        var formdata = new FormData($("form[name='adicionarNoticias-form']")[0]);


        dialog = bootbox.dialog({
          message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
          closeButton: false
        });

        $.ajax({
          type: 'POST',
          url: "../controller/ControllerNoticias.php",
          data: formdata,
          processData: false,
          contentType: false,

          success: function (result) {
            //alert(result);

            if (result == 1) {
              dialog.init(function () {
                dialog.find('.bootbox-body').html('Adicionado com sucesso!');
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
            atualizar();
          }
        });
        $('#verAdicionarNoticias').modal('hide');
        $('#adicionarNoticias-form').trigger("reset");
        return false;
      }

    });
    //alert("entrou");
  });
});


$(document).ready(function () {
  $('#btnEditarNoticia').click(function () {
    jQuery("#editarNoticias-form").validate({
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
        'titulo': {
          required: true
        },
        'descricao': {
          required: true
        },
        'resumo': {
          required: true
        },
        'arquivo': {
          required: false,
          extension: "jpg|JPG|png|PNG|jpeg|JPEG"
        },
        'data': {
          required: true,
          date: true
        },
        'local': {
          required: true,
        }
      },
      messages: {
        'titulo': {
          required: 'Por favor, preeencha este campo'
        },
        'descricao': {
          required: 'Por favor, preeencha este campo',
        },
        'resumo': {
          required: 'Por favor, preeencha este campo'
        },
        'arquivo': {
          required: 'Por favor, preeencha este campo',
        },
        'data': {
          required: 'Por favor, preeencha este campo',
        },
        'local': {
          required: 'Por favor, selecione a área que a notícia se aplica',
        }
      },
      submitHandler: function (form) {
        //alert("enta coletando dados do form");
        var formdata = new FormData($("form[name='editarNoticias-form']")[0]);


        dialog = bootbox.dialog({
          message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
          closeButton: false
        });

        $.ajax({
          type: 'POST',
          url: "../controller/ControllerNoticias.php",
          data: formdata,
          processData: false,
          contentType: false,

          success: function (result) {
            //alert(result);

            if ((result == 1) || (result == 3)) {
              dialog.init(function () {
                dialog.find('.bootbox-body').html('Editado com sucesso!');
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
        $('#verEditarNoticias').modal('hide');
        $('#editarNoticas-form').trigger("reset");
        return false;
      }

    });
    //alert("entrou");
  });
});



$(document).ready(function () {
  $('#btnExcluirNoticia').click(function () {
    var dados = $('#excluirNoticias-form').serializeArray();
    //alert(dados);
    $('#verEditarNoticias').modal('hide');
    bootbox.confirm({
      message: "Você realmente deseja excluir essa notícia ?",
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
            url: "../controller/ControllerNoticias.php",
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
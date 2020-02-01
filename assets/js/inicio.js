function atualizarInicio() {

  // carrega = #IdDeOndeVaiSerCarregadoOConteudo
  var carrega = $('#atualiza');

  //load(' ArquivoQueVaiSerCarregado.php #IdDaDivDoArquivoQueVAiSerCarregada')
  carrega.load('viewInicioAdm.php #atualiza'); // carrega todo o conteúdo da div# do arquivo


  /******  Extrasss - Apagar Furamente *****/
  //load( 'arquivo.php', { 'cidades[]': ['Curitiba', 'Manaus'] } ); // carrega o arquivo e passa dados para o servidor
  //load( 'meu-arquivo.json', minha_funcao ) // carrega o arquivo e executa minha_funcao
  /*****************/

}

$(document).ready(function () {
  $(".nav-link").click(function () {
    $('body').css('overflowY', 'hidden');
    $('#loader').show();
  });


  $('#loader').slideUp(1000);
  $('body').css('overflowY', 'auto');
});


function negrito() {
  var textarea = document.getElementById("extra");
  var text = '';
  var negrito = text.bold();
  textarea.value += negrito;
}

function italico() {
  var textarea = document.getElementById("extra");
  var text = '';
  var italico = text.italics();
  textarea.value += italico;
}

function sublinhado() {
  var textarea = document.getElementById("extra");
  var text = '<u> </u>';
  //var sublinhado = text.underline();
  textarea.value += text;
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

$(document).ready(function () {
  $('#btnAdicionarFoto').click(function () {
      jQuery("#adicionarFoto").validate({
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
              'arquivo': {
                  extension: "jpg|JPG|png|PNG|jpeg|JPEG"
              }
          },
          messages: {
              'titulo': {
                  required: 'Por favor, preeencha este campo'
              }
          },
          submitHandler: function (form) {
              alert("enta coletando dados do form");
              var formdata = new FormData($("form[name='adicionarFoto']")[0]);

              dialog = bootbox.dialog({
                  message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                  closeButton: false
              });

              $.ajax({
                  type: 'POST',
                  url: "../controller/ControllerInformacoes.php",
                  data: formdata,
                  processData: false,
                  contentType: false,

                  success: function (result) {
                      alert(result);

                      if (result == 1) {
                          dialog.init(function () {
                              dialog.find('.bootbox-body').html('Imagem enviada com sucesso!');
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
                  }
              });
              atualizarInicio();
              $('#verModalFoto').modal('hide');
              $('#adicionarFoto').trigger("reset");
              return false;
          }

      });
      alert("entrou");
  });
});


function loading() {

  var dialog = bootbox.dialog({
    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
    closeButton: false
  });

  dialog.init(function () {
    setTimeout(function () {
      dialog.find('.bootbox-body').html('Verifique na galeria se a imagem foi enviada com sucesso. Caso não apareça confira a extensão do arquivo, e, se persistir, tente novamente mais tarde.');
    }, 3000);
  });
  setTimeout(function () {
    dialog.modal('hide');
  }, 10000); //10 segundos depois executa

}

function enviarDadosInfo() {
  var dados = $('#editarInfo-form').serializeArray();
  $('#verEditarInfo').modal('hide');
  dialog = bootbox.dialog({
    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
    closeButton: false
  });
  $.ajax({
    type: "POST",
    url: "../controller/ControllerInformacoes.php",
    data: dados,
    success: function (result) {
      //alert(result);
      if (result == 1) {
        dialog.init(function () {
          dialog.find('.bootbox-body').html('Informações editadas com sucesso!');
        });
        setTimeout(function () {
          dialog.modal('hide');
        }, 3000); //3 segundos depois executa
        atualizarInicio();
      }
      else {
        dialog.init(function () {
          dialog.find('.bootbox-body').html('Não foi possivel editar as informações. Tente novamente mais tarde.');
        });
        setTimeout(function () {
          dialog.modal('hide');
        }, 3000); //3 segundos depois executa

      }
    }
  });
  return false;
}



function enviarFotoG() {

  var formdata = new FormData($("form[name='adicionarFoto']")[0]);
  var formulario = document.getElementById('adicionarFoto');

  if (window.FormData) {

    dialog = bootbox.dialog({
      message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
      closeButton: false
    });

    $.ajax({
      type: 'POST',
      url: "../controller/controllerGaleria.php",
      data: formdata,
      processData: false,
      contentType: false,

      success: function (result) {
        //alert(result);

        if (result == 1) {
          dialog.init(function () {
            dialog.find('.bootbox-body').html('Imagem enviada com sucesso!');
          });
          setTimeout(function () {
            dialog.modal('hide');
          }, 3000); //3 segundos depois executa
        }
        if (result == 3) {
          dialog.init(function () {
            dialog.find('.bootbox-body').html('Texto alterado com sucesso!');
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
  }
  else {
    formulario.submit();
    loading();
  }
  atualizarInicio();
  $('#verModalFoto').modal('hide');
  formulario.reset();
}


function excluirFoto(id) {

  var id = $('#rowExcluirFoto_' + id).attr("data-id");
  bootbox.confirm({
    message: "Você realmente deseja excluir essa foto da galeria ?",
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
          url: "../controller/controllerGaleria.php",
          data: {
            acao: "excluir",
            id: id
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
              atualizarInicio();
            }

            else {
              dialog.init(function () {
                dialog.find('.bootbox-body').html('Não foi possível excluir a foto. Tente novamente mais tarde.');
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
}

function editarInfo() {
  var id = $('#rowEditarInfo').attr("data-id");
  var tituloP = $('#rowEditarInfo').attr("data-tituloP");
  var infoP = $('#rowEditarInfo').attr("data-infoP");
  var tituloS = $('#rowEditarInfo').attr("data-tituloS");
  var infoS = $('#rowEditarInfo').attr("data-infoS");
  var extra = $('#rowEditarInfo').attr("data-extra");

  var texto = "<br />";
  var extraFinal = "";
  var inicio;
  var posic;
  while (extra.includes(texto)) {

    posic = extra.indexOf(texto);

    inicio = extra.substring(0, posic);
    extra = extra.substring(posic + texto.length);

    extraFinal += inicio;
  }

  extraFinal += extra;

  $('#verEditarInfo').modal('show');

  //$('.modal .modal-dialog .modal-content #nomeP').text("Detalhes do aluno(a) " + nomeAluno);
  $('.modal .modal-dialog .modal-content #editarInfo-form #id').val(id);
  $('.modal .modal-dialog .modal-content #tituloP').val(tituloP);
  $('.modal .modal-dialog .modal-content #infoP').val(infoP);
  $('.modal .modal-dialog .modal-content #tituloS').val(tituloS);
  $('.modal .modal-dialog .modal-content #infoS').val(infoS);
  $('.modal .modal-dialog .modal-content #extra').val(extraFinal);

}

function adicionarFoto_modal() {

  var acao = 'adicionar';

  $('#verModalFoto').modal('show');
  $('.modal .modal-dialog .modal-content #nomeP').text("Adicione uma imagem à galeria");
  $('.modal .modal-dialog .modal-content #acao').val(acao);

}

function editarFoto_modal(id) {
  var cod = $('#rowEditarFoto_' + id).attr("data-id");
  var titulo = $('#rowEditarFoto_' + id).attr("data-titulo");
  var foto = $('#rowEditarFoto_' + id).attr("data-foto");
  var acao = 'editarF';

  $('#verModalFoto').modal('show');
  
  $('.form-group .col-md-12 .form-material .custom-file #foto').html(foto);

  $('.modal .modal-dialog .modal-content #nomeP').text("Substitua a imagem ou altere seu título");
  $('.modal .modal-dialog .modal-content #adicionarFoto #id').val(cod);
  $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
  $('.modal .modal-dialog .modal-content  #acao').val(acao);


}
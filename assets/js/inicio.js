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

  $("#inicio").addClass('menuAtivo');
  $("#inicio").addClass('text-white');

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
  var letra = '\\';

  if ($('#foto').val()) {
    var midia = $('#foto').val();

    posic = midia.indexOf(letra); //pega a posicao da letra
    while (midia.includes(letra)) {
      midia = midia.substring(posic); //exclui da string todas as letras ate a posicao desejada
    }
    $('#divFoto .col-md-12 .form-material .custom-file #midia').html(midia);
  }
  if ($('#video').val()) {
    var midia = $('#video').val();
    alert(midia);
    posic = midia.indexOf(letra); //pega a posicao da letra
    while (midia.includes(letra)) {
      midia = midia.substring(posic); //exclui da string todas as letras ate a posicao desejada
    }
    $('#divVideo .col-md-12 .form-material .custom-file #midia').html('<div><i class="fa fa-times" aria-hidden="true" style="cursor: pointer;" onclick="delet()"></i> &nbsp' + midia + '</div>');
  }
}

function escolheGaleria(tipo) {
  if (tipo == 'f') {
    $('#caroselVideo').hide();
    $('#caroselFoto').show();
  }

  if (tipo == 'v') {
    $('#caroselFoto').hide();
    $('#caroselVideo').show();
    $("#caroselVideo").carousel('cycle');
  }
}

function controles(id, situacao) {
  var vid = $("#videoG_" + id);
  if (situacao.includes('play')) {
    $("#playV_" + id).hide();
    vid.trigger('play');
    $("#caroselVideo").carousel('pause');
  }
  else {
    vid.trigger('pause');
    $("#playV_" + id).show();
    $("#caroselVideo").carousel('cycle');
  }

}

function delet(){
    $('#divVideo .col-md-12 .form-material .custom-file #midia').html('<div><i class="fa fa-times" aria-hidden="true" style="cursor: pointer;" onclick="delet()"></i></div>');
    $('#video').val('');
}

$(document).ready(function () {
  $('#btnEditarInfo').click(function () {
    jQuery("#editarInfo-form").validate({
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
        'tituloP': {
          required: true
        },
        'infoP': {
          required: true
        }
      },
      messages: {
        'tituloP': {
          required: 'Por favor, preeencha este campo'
        },
        'infoP': {
          required: 'Por favor, preeencha este campo',
        }
      },
      submitHandler: function (form) {
        alert("enta coletando dados do form");
        var dados = $('#editarInfo-form').serializeArray();
        alert(dados);
        dialog = bootbox.dialog({
          message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
          closeButton: false
        });

        $.ajax({
          type: 'POST',
          url: "../controller/ControllerInicio.php",
          data: dados,

          success: function (result) {
            alert(result);

            if (result == 1) {
              dialog.init(function () {
                dialog.find('.bootbox-body').html('Informações atualizadas com sucesso!');
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
        $('#verEditarInfo').modal('hide');
        $('#editarInfo-form').trigger("reset");
        return false;
      }

    });
    alert("entrou");
  });
});


$.validator.addMethod("size", function (value, element) {
  if (value != '') {
    if (element.files[0].size <= 8388608) {
      return true
    } else {
      return false
    }
  }else{
    return true
  }
});
$.validator.addMethod("noLink", function (value, element) {
  if (value != '') {
    var link = $('#videoLink');
    if (link.val() == '') {
      return true
    } else {
      return false
    }
  }else{
    return true
  }
});
$.validator.addMethod("noVideo", function (value, element) {
  if (value != '') {
    var video = $('#video')
    if (video.val() == '') {
      return true
    } else {
      return false
    }
  }else{
    return true
  }
});

  $(document).ready(function () {
    $('#btnAdicionarMidia').click(function () {
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
          'foto': {
            extension: "jpg|JPG|png|PNG|jpeg|JPEG"
          },
          'video': {
            extension: "avi|mp4|flv|wmv|ogv|webm",
            size: true,
            noLink: true
          },
          'videoLink': {
            url: true,
            noVideo: true
          }
        },
        messages: {
          'titulo': {
            required: 'Por favor, preeencha este campo.'
          },
          'video': {
            size: 'O tamanho do arquivo selecionado exede o permitido (8,3MB)!',
            noLink: 'Por favor, escolha entre um vídeo externo ou um upload.'
          },
          'videoLink':{
            noVideo: 'Por favor, escolha entre um vídeo externo ou um upload.'
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
            url: "../controller/ControllerInicio.php",
            data: formdata,
            processData: false,
            contentType: false,

            success: function (result) {
              alert(result);

              if (result == 1) {
                dialog.init(function () {
                  dialog.find('.bootbox-body').html('Envio completado com sucesso!');
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



function excluirMidia(id) {

  var id = $('#rowExcluirMidia_' + id).attr("data-id");
  bootbox.confirm({
    message: "Você realmente deseja excluir essa midia da galeria ?",
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
          url: "../controller/ControllerInicio.php",
          data: {
            acao: "excluir",
            id: id
          },
          success: function (resultado) {
            //alert(resultado);
            if (resultado == 1) {
              dialog.init(function () {
                dialog.find('.bootbox-body').html('Excluída com sucesso!');
              });
              setTimeout(function () {
                dialog.modal('hide');
              }, 3000); //3 segundos depois executa
              atualizarInicio();
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

  var acao = 'adicionarF';

  $('#adicionarFoto').trigger("reset");
  $('#divFoto .col-md-12 .form-material .custom-file #midia').html("");
  $('#divFoto').show();
  $('#divVideo').hide();
  $('#divUrl').hide();
  $('#verModalFoto').modal('show');
  $('.modal .modal-dialog .modal-content #nomeP').text("Adicione uma imagem à galeria");
  $('.modal .modal-dialog .modal-content #acao').val(acao);

}

function adicionarVideo_modal() {

  var acao = 'adicionarV';

  $('#adicionarFoto').trigger('reset');
  $('#divVideo .col-md-12 .form-material .custom-file #midia').html('<div><i class="fa fa-times" aria-hidden="true" style="cursor: pointer;" onclick="delet()"></i></div>');
  $('#divFoto').hide();
  $('#divVideo').show();
  $('#divUrl').show();
  $('#verModalFoto').modal('show');
  $('.modal .modal-dialog .modal-content #nomeP').text("Adicione um vídeo à galeria");
  $('.modal .modal-dialog .modal-content #acao').val(acao);


}

function editarFoto_modal(id) {
  var cod = $('#rowEditarFoto_' + id).attr("data-id");
  var titulo = $('#rowEditarFoto_' + id).attr("data-titulo");
  var foto = $('#rowEditarFoto_' + id).attr("data-foto");
  var acao = 'editarF';

  $('#adicionarFoto').trigger("reset");
  $('#verModalFoto').modal('show');

  $('#divFoto').show();
  $('#divVideo').hide();
  $('#divUrl').hide();

  $('#divFoto .col-md-12 .form-material .custom-file #midia').html(foto);

  $('.modal .modal-dialog .modal-content #nomeP').text("Substitua a imagem ou altere seu título");
  $('.modal .modal-dialog .modal-content #adicionarFoto #id').val(cod);
  $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
  $('.modal .modal-dialog .modal-content  #acao').val(acao);

}


function editarVideo_modal(id) {
  var cod = $('#rowEditarVideo_' + id).attr("data-id");
  var titulo = $('#rowEditarVideo_' + id).attr("data-titulo");
  var video = $('#rowEditarVideo_' + id).attr("data-video");
  var link = $('#rowEditarVideo_' + id).attr("data-link");
  var acao = 'editarV';

  $('#adicionarFoto').trigger('reset');
  $('#verModalFoto').modal('show');
  $('#divFoto').hide();
  $('#divVideo').show();
  $('#divUrl').show();

  $('#divVideo .col-md-12 .form-material .custom-file #midia').html('<div><i class="fa fa-times" aria-hidden="true" style="cursor: pointer;" onclick="delet()"></i> &nbsp' + video + '</div>');

  $('.modal .modal-dialog .modal-content #nomeP').text("Substitua o vídeo ou altere seu título");
  $('.modal .modal-dialog .modal-content #adicionarFoto #id').val(cod);
  $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
  $('.modal .modal-dialog .modal-content  #videoLink').val(link);
  $('.modal .modal-dialog .modal-content  #acao').val(acao);

}

function openNewModal() {
  //fecha o elemento erro na validação
  var feedback = $(".invalid-feedback");
  feedback.hide();
}
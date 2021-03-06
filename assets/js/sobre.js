$(document).ready(function () {
  atualizar();
  $("#sobre").addClass('menuAtivo');
  $("#sobre").addClass('font-weight-bold');

  $(".nav-link").click(function () {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    $('body').css('overflowY', 'hidden');
    $('#loader').show();
  });

  $('#loader').slideUp(1000);
  $('body').css('overflowY', 'auto');

});


function atualizar() {  
  if ($("#adm").hasClass('paginacao')) {
    classe = 1;
  }
  $.post('postSobre.php', function (retorna) {
    $("#corpo").html(retorna);

    if (classe == 1) {
      $.get("postSobre.php", function () {
        $('.editar').show();
        $('.slidesVideos').hide();  
        $('#adm').addClass('paginacao');
      });
    }
  });
}

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
    $('#idImagem').val('');
  }

  if ($('#video').val()) {
    var midia = $('#video').val();
    posic = midia.indexOf(letra); //pega a posicao da letra
    while (midia.includes(letra)) {
      midia = midia.substring(posic); //exclui da string todas as letras ate a posicao desejada
    }
    $('#divVideo .col-md-12 .form-material .custom-file #midia').html(midia);
    $('#idVideo').val('');
    if($('#video').val() != ''){
      $('#videoLink').prop( "readonly", true );
    }
  }
}

function escolheGaleria(tipo) {
  if (tipo == 'f') {
    $('#caroselVideo').hide();
    $('.slidesVideos').hide();
    $('#caroselFoto').show();
    $('.slidesFotos').show();
  }

  if (tipo == 'v') {
    $('#caroselFoto').hide();
    $('.slidesFotos').hide();
    $('#caroselVideo').show();
    $('.slidesVideos').show();
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

function deletVideo() {
  $('#divVideo .col-md-12 .form-material .custom-file #midia').html('');
  $('#video').val('')
  $('#idVideo').val('vazio');
  $('#videoLink').prop( "readonly", false );
}

function changeLinkVideo(){
  if($('#videoLink').val() == ''){
    $('#video').prop( "disabled", false );
    $('#idVideo').val('vazio');
  }
  if($('#videoLink').val() != ''){
    $('#video').prop( "disabled", true );
  }
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
        var dados = $('#editarInfo-form').serializeArray();
        dialog = bootbox.dialog({
          message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
          closeButton: false
        });

        $.ajax({
          type: 'POST',
          url: "../controller/ControllerSobre.php",
          data: dados,

          success: function (result) {
            //alert(result);

            if (result == 1) {
              dialog.init(function () {
                dialog.find('.bootbox-body').html('Informações atualizadas com sucesso!');
              });
              setTimeout(function () {
                dialog.modal('hide');
              }, 3000); //3 segundos depois executa
            atualizar();
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
        $('#verEditarInfo').modal('hide');
        $('#editarInfo-form').trigger("reset");
        return false;
      }

    });
  });
});


$.validator.addMethod("size", function (value, element) {
  if (value != '') {
    if (element.files[0].size <= 8388608) {
      return true
    } else {
      return false
    }
  } else {
    return true
  }
});
$.validator.addMethod("noLinkORnoVideo", function () {
    if (($('#videoLink').val() == '') && (($('#video').val() == '') && ($('#idVideo').val() != 'ante'))) {
      return false
    } else{
      return true
    }
});

$.validator.addMethod("noImage", function () {
  if (($('#foto').val() == '') && ($('#idImagem').val() != 'ante')) {
    return false
  } else{
    return true
  }
});

$.validator.addMethod("validUrl", function (value, element) {
  
  if (value.includes('watch?')) {
        return false;

  } else {
      return true;
  }
}, "Link inválido. Por favor, siga estes passos: <br /> vá até o vídeo > clique em 'compartilhar' > copie o link disponível.");

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
          extension: "jpg|JPG|png|PNG|jpeg|JPEG",
          noImage: true
        },
        'video': {
          extension: "avi|mp4|flv|wmv|ogv|webm",
          size: true,
          noLinkORnoVideo: true
        },
        'videoLink': {
          url: true,
          validUrl: true,
          noLinkORnoVideo: true
        }
      },
      messages: {
        'titulo': {
          required: 'Por favor, preeencha este campo.'
        },
        'foto': {
          noImage: 'Por favor, adicione imagem.'
        },
        'video': {
          size: 'O tamanho do arquivo selecionado exede o permitido (8,3MB)!',
          noLinkORnoVideo: 'Por favor, adicione um upload ou um link para um video externo.'
        },
        'videoLink': {
          noLinkORnoVideo: 'Por favor, adicione um link para um video externo ou um upload.'
        }
      },
      submitHandler: function (form) {
        var formdata = new FormData($("form[name='adicionarFoto']")[0]);

        dialog = bootbox.dialog({
          message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
          closeButton: false
        });

        $.ajax({
          type: 'POST',
          url: "../controller/ControllerSobre.php",
          data: formdata,
          processData: false,
          contentType: false,

          success: function (result) {
            //alert(result);

            if (result == 1) {
              dialog.init(function () {
                dialog.find('.bootbox-body').html('Operação ralizada com sucesso!');
              });
              setTimeout(function () {
                dialog.modal('hide');
              }, 3000); //3 segundos depois executa
              atualizar();
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
        $('#verModalFoto').modal('hide');
        $('#adicionarFoto').trigger("reset");
        return false;
      }

    });
  });
});



function excluirMidia(id) {

  var id = $('#rowExcluirMidia_' + id).attr("data-id");
  bootbox.confirm({
    message: "Você realmente deseja excluir essa midia da galeria ?",
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
          url: "../controller/ControllerSobre.php",
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
  $( "#ajuda" ).attr( 'data-content','É permitido apenas o envio de imagens contendo as seguintes extensões: .jpg, .png e .jpeg');

}

function adicionarVideo_modal() {

  var acao = 'adicionarV';

  $('#video').prop( "disabled", false );
  $('#videoLink').prop( "readonly", false );

  $('#adicionarFoto').trigger('reset');
  $('#divVideo .col-md-12 .form-material .custom-file #midia').html('');
  $('#divFoto').hide();
  $('#divVideo').show();
  $('#divUrl').show();
  $('#verModalFoto').modal('show');

  $('.modal .modal-dialog .modal-content #nomeP').text("Adicione um vídeo à galeria");
  $('.modal .modal-dialog .modal-content #acao').val(acao);
  $( "#ajuda" ).attr( 'data-content','É permitido apenas o envio de vídeos com qualidade igual ou inferior a 360p contendo as seguintes extensões: .avi, .mp4, .flv, .wmv, .ogv, .webm');

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
  $('#idImagem').val('ante');

  $('.modal .modal-dialog .modal-content #nomeP').text("Substitua a imagem ou altere seu título");
  $('.modal .modal-dialog .modal-content #adicionarFoto #id').val(cod);
  $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
  $('.modal .modal-dialog .modal-content  #acao').val(acao);
  $( "#ajuda" ).attr( 'data-content','É permitido apenas o envio de imagens contendo as seguintes extensões: .jpg, .png e .jpeg');

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

  if(video != ''){
    $('#video').prop( "disabled", false );
    $('#videoLink').prop( "readonly", true );
  }else{
    $('#video').prop( "disabled", true );
    $('#videoLink').prop( "readonly", false );
  }

  $('.modal .modal-dialog .modal-content #nomeP').text("Substitua o vídeo ou altere seu título");
  $('#divVideo .col-md-12 .form-material .custom-file #midia').html(video);
  $('#idVideo').val('ante');
  $('.modal .modal-dialog .modal-content #adicionarFoto #id').val(cod);
  $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
  $('.modal .modal-dialog .modal-content  #videoLink').val(link);
  $('.modal .modal-dialog .modal-content  #acao').val(acao);
  $( "#ajuda" ).attr( 'data-content','É permitido apenas o envio de vídeos com qualidade igual ou inferior a 360p contendo as seguintes extensões: .avi, .mp4, .flv, .wmv, .ogv, .webm');

}

function openNewModal() {
  //fecha o elemento erro na validação
  var feedback = $(".invalid-feedback");
  feedback.hide();
}
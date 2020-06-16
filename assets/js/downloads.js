$(document).ready(function () {

  atualizar();
  $("#downloads").addClass('menuAtivo');
  $("#downloads").addClass('font-weight-bold');

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

  listarDownloads(pagina, quantidadePg); //Chamar a função para listar os registros

}

function up() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
}

function listarDownloads(pagina, quantidadePg) {
  if ($("li").hasClass('paginacao')) {
    classe = 1;
  }

  var dados = {
    pagina: pagina,
    quantidadePg: quantidadePg
  }

  $.post('downloads.php', dados, function (retorna) {
    //Subtitui o valor no seletor id="externas"
    $("#corpo").html(retorna);

    // alert(classe);
    if (classe == 1) {
      $.get("downloads.php", function () {
        var divEditar = $('.editar');

        divEditar.show();

        $('li').addClass('paginacao');
      });
    }
  });
}


function adicionar_modal() {
  var acao = 'adicionar';
  var excluir = $('#excluir');

  $('#Downloads-form').trigger("reset");

  $('#verDownloads').modal('show');
  excluir.hide();

  $('.modal .modal-dialog .modal-content #tituloP').text("Adicione novos arquivos para download");
  $('.modal .modal-dialog .modal-content #acao').val(acao);
}

function editar_modal(id) {

  var cod = $('#rowEditarDownloads_' + id).attr("data-id");
  var titulo = $('#rowEditarDownloads_' + id).attr("data-titulo");
  var referencia = $('#rowEditarDownloads_' + id).attr("data-referencia");
  var slides = $('#rowEditarDownloads_' + id).attr("data-slides");
  var algoritmo = $('#rowEditarDownloads_' + id).attr("data-algoritmo");
  var link = $('#rowEditarDownloads_' + id).attr("data-link");
  var acao = 'editar';
  var excluir = $('#excluir');

  $('#Downloads-form').trigger("reset");
  $('#verDownloads').modal('show');
  excluir.show();

  $('.modal .modal-dialog .modal-content #tituloP').text("Altere os arquivos para download");
  $('.modal .modal-dialog .modal-content #Downloads-form #acao').val(acao);
  $('.modal .modal-dialog .modal-content #Downloads-form #id').val(cod);
  $('.modal .modal-dialog .modal-content #excluirDownloads-form #id').val(cod);
  $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
  $('.modal .modal-dialog .modal-content  #referencia').val(referencia);
  $('.modal .modal-dialog .modal-content  #link').val(link);
  $('.modal .modal-dialog .modal-content .custom-file #midiaS').html(slides);
  $('#idSlides').val('ante');
  $('.modal .modal-dialog .modal-content .custom-file #midiaA').html(algoritmo);
  $('#idAlgoritmo').val('ante');
  
}


function nomeAquivoSlide() {
  if ($('.modal .modal-dialog .modal-content .custom-file #slides').val()) {
    var slide = $('.modal .modal-dialog .modal-content .custom-file #slides').val();
    var letra = '\\';

    posic = slide.indexOf(letra); //pega a posicao da letra
    while (slide.includes(letra)) {
      slide = slide.substring(posic); //exclui da string todas as letras ate a posicao desejada
    }
    $('.modal .modal-dialog .modal-content .custom-file #midiaS').html(slide);
    $('#idSlides').val('');
  }
}

function nomeAquivoAlgoritmo() {
  if ($('.modal .modal-dialog .modal-content .custom-file #algoritmo').val()) {
    var algoritmo = $('.modal .modal-dialog .modal-content .custom-file #algoritmo').val();
    var letra = '\\';

    posic = algoritmo.indexOf(letra); //pega a posicao da letra
    while (algoritmo.includes(letra)) {
      algoritmo = algoritmo.substring(posic); //exclui da string todas as letras ate a posicao desejada
    }
    $('.modal .modal-dialog .modal-content .custom-file #midiaA').html(algoritmo);
    $('#idAlgoritmo').val('');
  }
}

function deletSlides() {
  $('.modal .modal-dialog .modal-content .custom-file #midiaS').html('');
  $('#idSlides').val('vazio');
}

function deletAlgoritmo() {
  $('.modal .modal-dialog .modal-content .custom-file #midiaA').html('');
  $('#idAlgoritmo').val('vazio');
}


$(document).ready(function () {
  $('#btnDownload').click(function () {
    jQuery("#Downloads-form").validate({
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
        'referencia': {
          required: true
        },
        'slides': {
          extension: "pptx|zip|pdf"
        },
        'algoritmo': {
          extension: "zip|pdf"
        },
        'link': {
            url: true
        }
      },
      messages: {
        'titulo': {
          required: 'Por favor, preeencha este campo'
        },
        'referencia': {
          required: 'Por favor, preeencha este campo'
        },
        'link': {
            url: 'Digite um link válido',
        }
      },
      submitHandler: function (form) {
        alert("enta coletando dados do form");
        var formdata = new FormData($("form[name='Downloads-form']")[0]);

        dialog = bootbox.dialog({
          message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
          closeButton: false
        });

        $.ajax({
          type: 'POST',
          url: "../controller/ControllerDownloads.php",
          data: formdata,
          processData: false,
          contentType: false,

          success: function (result) {
            alert(result);

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
            atualizar();
          }
        });
        $('#verDownloads').modal('hide');
        $('#Downloads-form').trigger("reset");
        return false;
      }

    });
    //alert("entrou");
  });
});

$(document).ready(function () {
  $('#btnExcluirDownload').click(function () {
    var dados = $('#excluirDownloads-form').serializeArray();
    $('#verDownloads').modal('hide');
    bootbox.confirm({
      message: "Você realmente deseja excluir esse download da lista ?",
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
        alert('btn excluir');
        if (result) {
          dialog = bootbox.dialog({
            message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
            closeButton: false
          });


          $.ajax({
            type: "POST",
            url: "../controller/ControllerDownloads.php",
            data: dados,

            success: function (resultado) {
              alert(resultado);
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
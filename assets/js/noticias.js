$(document).ready(function () {
  atualizar();
  $("#noticias").addClass('menuAtivo');
  $("#noticias").addClass('text-white');

  $(".nav-link").click(function () {
    $('body').css('overflowY', 'hidden');
    $('#loader').show();
  });

  $('#loader').slideUp(1000);
  $('body').css('overflowY', 'auto');

});

function atualizar() {
  var quantidadePg = 3; //quantidade de registro por página
  var pagina = 1; //página inicial

  listarNoticiasIn(pagina, quantidadePg); //Chamar a função para listar os registros
  listarNoticiasEx(pagina, quantidadePg);
}



function listarNoticiasIn(pagina, quantidadePg) {
  if ($("li").hasClass('paginacao')) {
    classe = 1;
  }

  var dados = {
    paginaIn: pagina,
    quantidadePgIn: quantidadePg
  }

  $.post('noticiasInternas.php', dados, function (retorna) {
    //Subtitui o valor no seletor id="externas"
    $("#internas").html(retorna);

    alert(classe);
    if (classe == 1) {
      $.get("noticiasInternas.php", function () {
        var divEditar = $('.editar');

        divEditar.show();

        $('li').addClass('paginacao');
      });
    }
  });

}

function listarNoticiasEx(pagina, quantidadePg) {
  if ($("li").hasClass('paginacao')) {
    classe = 1;
  }

  var dados = {
    pagina: pagina,
    quantidadePg: quantidadePg
  }

  $.post('noticiasExternas.php', dados, function (retorna) {
    //Subtitui o valor no seletor id="externas"
    $("#externas").html(retorna);

    alert(classe);
    if (classe == 1) {
      $.get("noticiasExternas.php", function () {
        var divEditar = $('.editar');

        divEditar.show();

        $('li').addClass('paginacao');
      });
    }
  });

}



function lerMaisEx(id) {
  var div = $('#descricaoCurtaEx_' + id);
  var newDiv = $('#descricaoGrandeEx_' + id);
  var botao = $('#rowLerMaisEx_' + id);
  var newBotao = $('#rowLerMenosEx_' + id);
  var imagem = $('#midiaEx_' + id);

  div.hide();
  newDiv.show();
  botao.hide();
  newBotao.show();
  imagem.show();
}

function lerMenosEx(id) {
  var div = $('#descricaoCurtaEx_' + id);
  var newDiv = $('#descricaoGrandeEx_' + id);
  var botao = $('#rowLerMaisEx_' + id);
  var newBotao = $('#rowLerMenosEx_' + id);
  var imagem = $('#midiaEx_' + id);

  newDiv.hide();
  div.show();
  newBotao.hide();
  botao.show();
  imagem.hide();
}


function lerMaisIn(id) {
  var div = $('#descricaoCurtaIn_' + id);
  var newDiv = $('#descricaoGrandeIn_' + id);
  var botao = $('#rowLerMaisIn_' + id);
  var newBotao = $('#rowLerMenosIn_' + id);
  var imagem = $('#midiaIn_' + id);

  div.hide();
  newDiv.show();
  botao.hide();
  newBotao.show();
  imagem.show();
}

function lerMenosIn(id) {
  var div = $('#descricaoCurtaIn_' + id);
  var newDiv = $('#descricaoGrandeIn_' + id);
  var botao = $('#rowLerMaisIn_' + id);
  var newBotao = $('#rowLerMenosIn_' + id);
  var imagem = $('#midiaIn_' + id);

  newDiv.hide();
  div.show();
  newBotao.hide();
  botao.show();
  imagem.hide();
}


function editar_modal_ex(id) {
  $.get("viewNoticiasAdm.php", function () {

    var cod = $('#rowEditarNoticiaEx_' + id).attr("data-id");
    var titulo = $('#rowEditarNoticiaEx_' + id).attr("data-titulo");
    var descricao = $('#rowEditarNoticiaEx_' + id).attr("data-descricao");
    var midia = $('#rowEditarNoticiaEx_' + id).attr("data-midia");
    var data = $('#rowEditarNoticiaEx_' + id).attr("data-data");
    //var acao = 'editarF';


    $('#editarNoticias-form').trigger("reset");
    $('#verEditarNoticias').modal('show');

    //alert(data);
    $("input[name='local'][value='Interna']").prop('checked', false);
    $("input[name='local'][value='Externa']").prop('checked', true);

    $('.modal .modal-dialog .modal-content #editarNoticias-form #id').val(cod);
    $('.modal .modal-dialog .modal-content #excluirNoticias-form #id').val(cod);
    $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
    $('.modal .modal-dialog .modal-content  #descricao').val(descricao);
    $('.modal .modal-dialog .modal-content .custom-file #midia').html(midia);
    $('.modal .modal-dialog .modal-content  #data').val(data);

  });
}


function editar_modal_in(id) {
  $.get("viewNoticiasAdm.php", function () {

    var cod = $('#rowEditarNoticiaIn_' + id).attr("data-id");
    var titulo = $('#rowEditarNoticiaIn_' + id).attr("data-titulo");
    var descricao = $('#rowEditarNoticiaIn_' + id).attr("data-descricao");
    var midia = $('#rowEditarNoticiaIn_' + id).attr("data-midia");
    var data = $('#rowEditarNoticiaIn_' + id).attr("data-data");
    //var acao = 'editarF';

    $('#editarNoticias-form').trigger("reset");
    $('#verEditarNoticias').modal('show');

    //alert(data);

    $("input[name='local'][value='Interna']").prop('checked', true);
    $("input[name='local'][value='Externa']").prop('checked', false);

    $('.modal .modal-dialog .modal-content #editarNoticias-form #id').val(cod);
    $('.modal .modal-dialog .modal-content #excluirNoticias-form #id').val(cod);
    $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
    $('.modal .modal-dialog .modal-content  #descricao').val(descricao);
    $('.modal .modal-dialog .modal-content .custom-file #midia').html(midia);
    $('.modal .modal-dialog .modal-content  #data').val(data);

  });
}


function adicionar_modal_ex() {
  $.get("viewNoticiasAdm.php", function () {

    var local = 'Externa';

    $('#adicionarNoticias-form').trigger("reset");
    $('.modal .modal-dialog .modal-content .custom-file #arquivo').html('');
    $('#verAdicionarNoticias').modal('show');


    $('.modal .modal-dialog .modal-content #adicionarNoticias-form #localNoticia').val(local);
  });
}

function adicionar_modal_in() {
  $.get("viewNoticiasAdm.php", function () {

    var local = 'Interna';

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
        'descricao': {
          required: true
        },
        'titulo': {
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
        'descricao': {
          required: 'Por favor, preeencha este campo',
        },
        'titulo': {
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
        alert("enta coletando dados do form");
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
            alert(result);

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
    alert("entrou");
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
        alert("enta coletando dados do form");
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
            alert(result);

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
    alert("entrou");
  });
});



$(document).ready(function () {
  $('#btnExcluirNoticia').click(function () {
    var dados = $('#excluirNoticias-form').serializeArray();
    alert(dados);
    $('#verEditarNoticias').modal('hide');
    bootbox.confirm({
      message: "Você realmente deseja excluir essa notícia ?",
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
            url: "../controller/ControllerNoticias.php",
            data: dados,

            success: function (resultado) {
              alert(resultado);
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
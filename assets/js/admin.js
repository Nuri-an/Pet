function atualizarInicio(){

  // carrega = #IdDeOndeVaiSerCarregadoOConteudo
  var carrega = $('#atualiza');

  //load(' ArquivoQueVaiSerCarregado.php #IdDaDivDoArquivoQueVAiSerCarregada')
  carrega.load('viewInicioAdm.php #atualiza'); // carrega todo o conteúdo da div# do arquivo
            
   
  /******  Extrasss - Apagar Furamente *****/
  //load( 'arquivo.php', { 'cidades[]': ['Curitiba', 'Manaus'] } ); // carrega o arquivo e passa dados para o servidor
  //load( 'meu-arquivo.json', minha_funcao ) // carrega o arquivo e executa minha_funcao
  /*****************/
         
}


function loading(){

  var dialog = bootbox.dialog({
      message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
      closeButton: false
    });
  
    dialog.init(function(){
      setTimeout(function(){
          dialog.find('.bootbox-body').html('Imagem cadastrada com sucesso!');
      }, 3000);
  });
  
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
          alert(result);
          if (result == 1) {
            dialog.init(function(){
                dialog.find('.bootbox-body').html('Informações editadas com sucesso!');
            });
              setTimeout(function(){
                dialog.modal('hide'); 
              }, 3000); //3 segundos depois executa
            atualizarInicio();
          } 
          else{
            dialog.init(function(){
              dialog.find('.bootbox-body').html('Não foi possivel editar as informações. Tente novamente mais tarde.');
          });
            setTimeout(function(){
              dialog.modal('hide'); 
            }, 3000); //3 segundos depois executa
     
          }
        }
      });
    return false;
}


function alerta(type, title, button, footer, link){
    Swal.fire({
      type: type,
      showConfirmButton: false,
      html:
      '<button id="ok" type="submit" class="btn btn-primary"><i class="fa fa-eye"></i>'+ button +'</button>',
      title: title,
      footer: '<a href="'+link+'">'+footer+'</a>'
    });
    $("#ok").click(function () {
      Swal.close();
    });
  }

  function Foto(){
    //var acao = $('#adicionarFoto input[name="acao"]').val();
    var formulario = document.getElementById('adicionarFoto');
    formulario.submit();
    
    atualizarInicio();
    
    $('#verModalFoto').modal('hide');

    formulario.reset();  
    
    return false;
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
        if (result){ 
          dialog = bootbox.dialog({
            message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
            closeButton: false
          });
          $.ajax({
            type: "POST",
            url: "../controller/controllerGaleria.php",
            data: { acao: "excluir",
                    id: id
                  },
            success: function (resultado) {
              //alert(resultado);
              if (resultado == 1) {
                dialog.init(function(){
                  dialog.find('.bootbox-body').html('A foto foi excluída com sucesso!');
                });
                setTimeout(function(){
                  dialog.modal('hide'); 
                }, 3000); //3 segundos depois executa
              atualizarInicio();
              }

              else{
                dialog.init(function(){
                dialog.find('.bootbox-body').html('Não foi possível excluir a foto. Tente novamente mais tarde.');
            });
              setTimeout(function(){
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

    
    $('#verEditarInfo').modal('show');

    //$('.modal .modal-dialog .modal-content #nomeP').text("Detalhes do aluno(a) " + nomeAluno);
    $('.modal .modal-dialog .modal-content #editarInfo-form #id').val(id);
    $('.modal .modal-dialog .modal-content #tituloP').val(tituloP);
    $('.modal .modal-dialog .modal-content #infoP').val(infoP);
    $('.modal .modal-dialog .modal-content #tituloS').val(tituloS);
    $('.modal .modal-dialog .modal-content #infoS').val(infoS);
  
}

function adicionarFoto_modal(){

  var acao = 'adicionar';

  $('#verModalFoto').modal('show');
  $('.modal .modal-dialog .modal-content #nomeP').text("Adicione uma imagem à galeria");
  $('.modal .modal-dialog .modal-content #acao').val(acao);

}

function editarFoto_modal(id) {
  var cod = $('#rowEditarFoto_' + id).attr("data-id");
  var titulo = $('#rowEditarFoto_' + id).attr("data-titulo");
  var acao = 'editar';
  
  $('#verModalFoto').modal('show');
  $('.modal .modal-dialog .modal-content #nomeP').text("Substitua a imagem ou altere seu título");
  $('.modal .modal-dialog .modal-content #adicionarFoto #id').val(cod);
  $('.modal .modal-dialog .modal-content  #titulo').val(titulo);
  $('.modal .modal-dialog .modal-content  #acao').val(acao);


}
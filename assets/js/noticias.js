$(document).ready(function () {
  
    $("#noticias").addClass('menuAtivo');
    $("#noticias").addClass('text-white');
  
    $(".nav-link").click(function () {
      $('body').css('overflowY', 'hidden');
      $('#loader').show();
    });
  
    $('#loader').slideUp(1000);
    $('body').css('overflowY', 'auto');
  });

  function lerMais(id){
    var titulo = $('#rowLerMais_' + id).attr("data-titulo");
    var descricao = $('#rowLerMais_' + id).attr("data-descricao");
    var midia = $('#rowLerMais_' + id).attr("data-midia");

    $('#lerMais').modal('show');

    $('.modal .modal-dialog .modal-content .modal-body .row #midia').attr('src', midia);
    $('.modal .modal-dialog .modal-content .modal-header #titulo').text(titulo);
    $('.modal .modal-dialog .modal-content .modal-body .row #descricao').text(descricao);

}

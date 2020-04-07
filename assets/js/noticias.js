$(document).ready(function () {
  var quantidadePg = 3; //quantidade de registro por página
  var pagina = 1; //página inicial

  listarNoticiasIn(pagina, quantidadePg); //Chamar a função para listar os registros
  listarNoticiasEx(pagina, quantidadePg); //Chamar a função para listar os registros

  $("#noticias").addClass('menuAtivo');
  $("#noticias").addClass('text-white');

  $(".nav-link").click(function () {
    $('body').css('overflowY', 'hidden');
    $('#loader').show();
  });

  $('#loader').slideUp(1000);
  $('body').css('overflowY', 'auto');
});


function listarNoticiasIn(pagina, quantidadePg) {
  var dados = {
    paginaIn: pagina,
    quantidadePgIn: quantidadePg
  }
  $.post('noticiasInternas.php', dados , function(retorna){
    //Subtitui o valor no seletor id="externas"
    $("#internas").html(retorna);
  });
}

function listarNoticiasEx(pagina, quantidadePg) {
  var dados = {
    pagina: pagina,
    quantidadePg: quantidadePg
  }
  $.post('noticiasExternas.php', dados , function(retorna){
    //Subtitui o valor no seletor id="externas"
    $("#externas").html(retorna);
  });
}

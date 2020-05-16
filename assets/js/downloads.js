$(document).ready(function () {

    atualizar();
    $("#downloads").addClass('menuAtivo');
    $("#downloads").addClass('text-white');
  
    $(".nav-link").click(function () {
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

  function up(){
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
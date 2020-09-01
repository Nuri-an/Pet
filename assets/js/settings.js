function editar_configs() {

    $('#Settings-form').trigger("reset");
    $('#verSettings').modal('show');
}


function nomeMidia() {
    var foto = $('#capa-settings').val();
    var letra = '\\';

    posic = foto.indexOf(letra); //pega a posicao da letra
    while (foto.includes(letra)) {
        foto = foto.substring(posic); //exclui da string todas as letras ate a posicao desejada

        $('#midia-settings').html(foto);
    }
}

$(document).ready(function () {
    $('#btnSettings').click(function () {
        jQuery("#Settings-form").validate({
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
                'capa-settings': {
                    required: false,
                    extension: "jpg|JPG|png|PNG|jpeg|JPEG"
                },
                'facebook-settings': {
                    url: false
                },
                'instagram-settings': {
                    url: false
                },
                'rodape-settings': {
                    required: true,
                }
            },
            messages: {
                'capa-settings': {
                    required: 'Por favor, preeencha este campo',
                    extension: 'Por favor, forneça uma imagem válida - .jpg, .png ou .jpeg'
                },
                'facebook-settings': {
                    url: 'Por favor, forneça uma URL válida',
                },
                'instagram-settings': {
                    url: 'Por favor, forneça uma URL válida'
                },
                'rodape-settings': {
                    required: 'Por favor, preeencha este campo',
                }
            },
            submitHandler: function (form) {
                
                var formdata = new FormData($("form[name='Settings-form']")[0]);

                dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-spinner"></i> Carregando...</p>',
                    closeButton: false
                });

                $.ajax({
                    type: 'POST',
                    url: "../controller/ControllerSettings.php",
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function (result) {
                        //alert(result);
                        if (result == 1) {
                            dialog.init(function () {
                                dialog.find('.bootbox-body').html('Operação realizada com sucesso!');
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
                $('#verSettings').modal('hide');
                $('#Settings-form').trigger("reset");
                return false;
            }

        });
    });
});


function openNewModal() {

    var feedback = $(".invalid-feedback");
    feedback.hide();
}
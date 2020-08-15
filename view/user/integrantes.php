<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/integrantes.css">

<script type="text/javascript" src="../assets/js/integrantes.js"></script>


<div id="corpo" class="container"> </div>

</div>

<script>
    $(document).ready(function() {
        $.get("postIntegrantes.php", function() {
            var divEditar = $('.editar');

            divEditar.hide();
            $('#adm').removeClass('paginacao');
        });
    });

</script>

<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
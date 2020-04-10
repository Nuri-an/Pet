<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/noticias.css">

<script type="text/javascript" src="../assets/js/noticias.js"></script>

<div class=" text-center" style="margin-bottom:30px;" role="group" aria-label="Exemplo básico">
    <a class="btn btn-outline-info h5" href="#internas">Notícias internas</a>
    <a class="btn btn-outline-info h5" href="#externas">Notícias externas</a>
</div>

<br>

<div id="internas"></div>

<div id="externas"></div>

</div>

<script>
    $(document).ready(function() {
        $.get("noticiasInternas.php", function() {
            $('li').removeClass('paginacao');
        });

        $.get("noticiasExternas.php", function() {
            $('li').removeClass('paginacao');
        });
    });

</script>

<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
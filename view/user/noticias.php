<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/noticias.css">

<script type="text/javascript" src="../assets/js/noticias.js"></script>

<div id="corpo"></div>


</div>

<script>
    $(document).ready(function() {
        $.get("postNoticias.php", function() {
            $('li').removeClass('paginacao');
        });
    });

</script>

<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
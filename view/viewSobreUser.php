<?php
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/inicio.css">

<script type="text/javascript" src="../assets/js/inicio.js"></script>

<div style="margin-top: 20px; margin-bottom: 20px;" id="corpo"> </div>

</div>

<script>
    $(document).ready(function() {
        $.get("sobre.php", function() {
            $('#adm').removeClass('paginacao');
        });
    });

</script>

<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
<?php
session_start();
if (!isset($_SESSION['adm_session'])){ header("Location: viewInicioUser.php"); }
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/administradores.css">

<script type="text/javascript" src="../assets/js/administradores.js"></script>

<div id="corpo"> </div>

</div>

<script>
    $(document).ready(function() {
        $.get("administradores.php", function() {
            $('li').removeClass('paginacao');
        });
    });

</script>

<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
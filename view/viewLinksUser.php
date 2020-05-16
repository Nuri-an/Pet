<?php 
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';

require_once("../dao/daoInicio.php");

$inicioDao = new DaoInicio(); ?>

<link rel="stylesheet" href="../assets/css/downloads.css">

<script type="text/javascript" src="../assets/js/downloads.js"></script>


<h6 class="lead container" style="text-align: left;">  Clique e escolha o arquivo para baixar </h6>

<hr> </hr>

<div class="container" style="overflow:hidden; border-bottom:30px;">

<ul class="list-group list-group-flush">
  <li class="list-group-item" onclick="">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
</ul>

</div>
</div>
<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>
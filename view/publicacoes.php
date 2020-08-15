<?php
session_start();

(isset($_SESSION['adm_session'])) ? require 'adm/publicacoes.php' : require 'user/publicacoes.php';


?>
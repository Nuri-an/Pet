<?php
session_start();

(isset($_SESSION['adm_session'])) ? require 'adm/noticias.php' : require 'user/noticias.php';


?>
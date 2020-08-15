<?php
session_start();

(isset($_SESSION['adm_session'])) ? require 'adm/integrantes.php' : require 'user/integrantes.php';


?>
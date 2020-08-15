<?php
session_start();

(isset($_SESSION['adm_session'])) ? require 'adm/projetos.php' : require 'user/projetos.php';


?>
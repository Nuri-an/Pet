<?php
session_start();

(isset($_SESSION['adm_session'])) ? require 'adm/administradores.php' : header('Location: index.php');


?>
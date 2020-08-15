<?php
session_start();

(isset($_SESSION['adm_session'])) ? require 'adm/sobre.php' : require 'user/sobre.php';


?>
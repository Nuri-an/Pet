<?php
session_start();

(isset($_SESSION['adm_session'])) ? require 'adm/downloads.php' : require 'user/downloads.php';


?>
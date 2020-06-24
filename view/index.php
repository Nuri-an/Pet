<?php
session_start();

(isset($_SESSION['adm_session'])) ? require 'viewNoticiasAdm.php' : require 'viewNoticiasUser.php';


?>
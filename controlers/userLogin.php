<?php
/**
 *  Controlador Login para el acceso a usuarios en Gestion Academica /* * *
 */
require_once('../models/User.php');
$user = new User();
$nameuser = $_POST['username'];
$passuser = $user->setPword($_POST['userpass']);
$loginChk = $user->checkLogin($nameuser, $passuser);
  if ($loginChk == -1) {
    header('Location: ../views/main.php');
  } else if ($loginChk == 1) {
    header('Location: ../views/login.php?login=1');
  } else {
    header('Location: ../views/login.php?login=0');
  }
?>
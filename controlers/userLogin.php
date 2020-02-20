<?php
/**
 *  Controlador Login para el acceso a usuarios en Gestion Academica /* * *
 */
require_once('../models/User.php');

$nameuser = $_POST['username'];
$passuser = $_POST['userpass'];
$user = new User();
$loginChk = $user->checkLogin($nameuser, $passuser);
  if ($loginChk == -1) {
    header('Location: ../views/main.php');
  } else if ($loginChk == 1) {
    //echo '<script>window.location: "../views/login.php?login=1"; $("#message-error").show().fadeOut(2500);</script>';
    header('Location: ../views/login.php?login=1');
  } else {
    //echo '<script>window.location: "../views/login.php?login=0"; $("#message-error").show().fadeOut(2500);</script>';
    header('Location: ../views/login.php?login=0');
  }
?>
<?php
/**
 *  Controlador Login para el acceso a usuarios en Gestion Academica /* * *
 */
require_once('../models/User.php');

$nameuser = $_POST['username'];
$passuser = $_POST['userpass'];

$user = new User();
echo $user->checkLogin($nameuser, $passuser);
  if ($user->checkLogin($nameuser, $passuser)) {
    header('Location: ../views/main.php');
  } else {
    echo "Error en las credenciales de Usuario..!!<br>";
  }
?>
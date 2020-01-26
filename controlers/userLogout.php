<?php
/**
 *  Controlador Logout para el acceso a usuarios en Gestion Academica /* * *
 */
session_start();
if ($_SESSION['USERNAME'] != null && $_SESSION['ID'] != null && $_SESSION['PROFILE'] != null) {
  echo "La sesion del Usuario esta activa..!!<br>";
  session_destroy();
  setcookie("PHPSESSID", "", time()-3600, "/");
  header('Location: ../views/login.php');
}
?>
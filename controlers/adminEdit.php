<?php
/**
 *  Controlador de Administrador para el Sitio de gestion Academica /* * *
 */
require_once('../models/Admin.php');
session_start();
if (isset($_POST) && isset($_SESSION) && $_SESSION['PROFILE'] == "Administrador") {
  $newAdmin = new Admin();
  $newAdmin->setData($_POST['nameAdm'], $_POST['lastnameAdm'], $_POST['usernameAdm'], $_POST['userpassAdm'], 'Administrador', 'Activo');
  $newAdmin->updateData($_POST['idadmin']);
  $today = date('Y-m-d', time('now'));
  $newAdmin->setAdminData($_POST['idadmin'], $_POST['numdocAdm'], $_POST['usermailAdm'], $today);
  $newAdmin->updateDataAdmin();
  header('Location: ../views/main.php');
} else {
  echo '<script>alert("Hubo un error y no se puede actualizar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";';
  echo '</script>';
}
?>
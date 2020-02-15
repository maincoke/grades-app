<?php
/**
 *  Controlador de Administrador para el Sitio de gestion Academica /* * *
 */
require_once('../models/Admin.php');
session_start();
if (isset($_POST) && isset($_SESSION) && $_SESSION['PROFILE'] = "Administrador") {
  $newAdmin = new Admin();
  if (!$newAdmin->emailAdminValidation($_POST['usermail'])) {
    $newAdmin->setData($_POST['name'], $_POST['lastname'], $_POST['username'], $_POST['userpass'], 'Administrador', 'Activo');
    $idUser = $newAdmin->saveData();
    $today = date('Y-m-d', time('now'));
    $newAdmin->setAdminData($idUser, $_POST['numdocadm'], $_POST['usermail'], $today);
    $newAdmin->saveAdminData();
    header('Location: ../views/main.php');
  } else {
    echo '<script>alert("Cuenta de correo: '.$_POST['usermail'].' ya se encuentra registrada..!! \n Intente con otra cuenta.");';
    echo 'window.location = "../views/main.php";';
    echo '</script>';
  }
}
?>
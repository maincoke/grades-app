<?php
/**
 *  Controlador de Administrador para el Sitio de gestion Academica /* * *
 */
require_once('../models/Admin.php');
session_start();
if (isset($_POST) && isset($_SESSION) && $_SESSION['PROFILE'] == "Administrador") {
  $newAdmin = new Admin();
  if (!$newAdmin->emailAdminValidation($_POST['usermailAdm'])) {
    $newAdmin->setData($_POST['nameAdm'], $_POST['lastnameAdm'], $_POST['usernameAdm'], $_POST['userpassAdm'], 'Administrador', 'Activo');
    $idUser = $newAdmin->saveData();
    $today = date('Y-m-d', time('now'));
    $newAdmin->setAdminData($idUser, $_POST['numdocAdm'], $_POST['usermailAdm'], $today);
    $newAdmin->saveAdminData();
    header('Location: ../views/main.php');
  } else {
    echo '<script>alert("Cuenta de correo: '.$_POST['usermailAdm'].' ya se encuentra registrada..!! \n Intente con otra cuenta.");';
    echo 'window.location = "../views/main.php";';
    echo '</script>';
  }
} else {
  echo '<script>alert("Hubo un error y no se puede agregar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";';
  echo '</script>';
}
?>
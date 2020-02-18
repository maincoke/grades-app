<?php
/**
 *  Controlador de Administrador para el Sitio de gestion Academica /* * *
 */
require_once('../models/Admin.php');
session_start();
if (isset($_POST) && isset($_SESSION) && $_SESSION['PROFILE'] == "Administrador") {
  $adminId = json_decode($_POST['id_admin']);
  $newAdmin = new Admin();
  $newAdmin->switchStateUser($adminId);
  $res = array('id_admin' => $adminId);
  echo json_encode($res);
} else {
  echo '<script>alert("Hubo un error y no se puede activar/desactivar el usuario!! Intente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";</script>';
}
?>
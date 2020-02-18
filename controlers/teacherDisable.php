<?php
/**
 *  Controlador de Docente para el Sitio de gestion Academica /* * *
 */
require_once('../models/Teacher.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $teacherId = json_decode($_POST['id_teacher']);
  $newteacher = new Teacher();
  $newteacher->switchStateUser($teacherId);
  $res = array('id_teacher' => $teacherId);
  echo json_encode($res);
} else {
  echo '<script>alert("Hubo un error y no se puede activar/desactivar el usuario!! Intente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";</script>';
}
?>
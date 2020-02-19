<?php
/**
 *  Controlador de Estudiante para el Sitio de gestion Academica /* * *
 */
require_once('../models/Student.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $studentId = json_decode($_POST['id_student']);
  $newStudent = new Student();
  $newStudent->switchStateUser($studentId);
  $res = array('id_student' => $studentId);
  echo json_encode($res);
} else {
  echo '<script>alert("Hubo un error y no se puede activar/desactivar el usuario!! Intente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";</script>';
}
?>
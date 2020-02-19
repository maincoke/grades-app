<?php
/**
 *  Controlador de Estudiante para el Sitio de gestion Academica /* * *
 */
require_once('../models/Student.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $newStudent = new Student();
  $newStudent->setData($_POST['nameStd'], $_POST['lastnameStd'], $_POST['usernameStd'], $_POST['userpassStd'], 'Estudiante', 'Activo');
  $newStudent->updateData($_POST['idstudent']);
  $today = date('Y-m-d', time('now'));
  $newStudent->setStudentData($_POST['idstudent'], $_POST['numdocStd'], $_POST['usermailStd'], $today);
  $newStudent->updateDataStudent();
  header('Location: ../views/main.php');
} else {
  echo '<script>alert("Hubo un error y no se puede actualizar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";';
  echo '</script>';
}
?>
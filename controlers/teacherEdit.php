<?php
/**
 *  Controlador de Docente para el Sitio de gestion Academica /* * *
 */
require_once('../models/Teacher.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $newTeach = new Teacher();
  $newTeach->setData($_POST['nameTch'], $_POST['lastnameTch'], $_POST['usernameTch'], $_POST['userpassTch'], 'Docente', 'Activo');
  $newTeach->updateData($_POST['idteacher']);
  $today = date('Y-m-d', time('now'));
  $newTeach->setTeacherData($_POST['idteacher'], $_POST['numdocTch'], $_POST['usermailTch'], $today);
  $newTeach->updateDataTeacher();
  header('Location: ../views/main.php');
} else {
  echo '<script>alert("Hubo un error y no se puede actualizar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";';
  echo '</script>';
}
?>
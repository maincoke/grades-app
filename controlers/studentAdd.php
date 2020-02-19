<?php
/**
 *  Controlador de Estudiante para el Sitio de gestion Academica /* * *
 */
require_once('../models/Student.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $newStudent = new Student();
  if (!$newStudent->emailStudentValidation($_POST['usermailStd'])) {
    $newStudent->setData($_POST['nameStd'], $_POST['lastnameStd'], $_POST['usernameStd'], $_POST['userpassStd'], 'Estudiante', 'Activo');
    $idUser = $newStudent->saveData();
    $today = date('Y-m-d', time('now'));
    $newStudent->setStudentData($idUser, $_POST['numdocStd'], $_POST['usermailStd'], $today);
    $newStudent->saveStudentData();
    header('Location: ../views/main.php');
  } else {
    echo '<script>alert("Cuenta de correo: '.$_POST['usermailStd'].' ya se encuentra registrada..!! \n Intente con otra cuenta.");';
    echo 'window.location = "../views/main.php";';
    echo '</script>';
  }
} else {
  echo '<script>alert("Hubo un error y no se puede agregar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";';
  echo '</script>';
}
?>
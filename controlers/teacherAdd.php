<?php
/**
 *  Controlador de Docente para el Sitio de gestion Academica /* * *
 */
require_once('../models/Teacher.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $newTeach = new Teacher();
  if (!$newTeach->emailTeacherValidation($_POST['usermailTch'])) {
    $newTeach->setData($_POST['nameTch'], $_POST['lastnameTch'], $_POST['usernameTch'], $_POST['userpassTch'], 'Docente', 'Activo');
    $idUser = $newTeach->saveData();
    $today = date('Y-m-d', time('now'));
    $newTeach->setTeacherData($idUser, $_POST['numdocTch'], $_POST['usermailTch'], $today);
    $newTeach->saveTeacherData();
    header('Location: ../views/main.php');
  } else {
    echo '<script>alert("Cuenta de correo: '.$_POST['usermailTch'].' ya se encuentra registrada..!! \n Intente con otra cuenta.");';
    echo 'window.location = "../views/main.php";';
    echo '</script>';
  }
} else {
  echo '<script>alert("Hubo un error y no se puede agregar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";';
  echo '</script>';
}
?>
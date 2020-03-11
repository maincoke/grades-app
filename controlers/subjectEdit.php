<?php
/**
 *  Controlador de Materias para el Sitio de gestion Academica /* * *
 */
require_once('../models/Subject.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $updSubject = new Subject();
  if ($updSubject->fetchDataSubjectMatter($_POST['subjectMatter'])) {
    echo '<script>alert("El nombre de materia especificado ya existe o el nombre es el mismo!! \nIntente con un nuevo nombre.");';
    echo 'window.location = "../views/main.php";';
    echo '</script>';
  } else {
    $updSubject->setDataSubject($_POST['subjectMatter']);
    $updSubject->updateDataSubject($_POST['idsubject']);
    echo '<script>alert("Registro de materia actualizado!!");';
    echo 'window.location = "../views/main.php";';
    echo '</script>';
  }
} else {
  echo '<script>alert("Hubo un error y no se puede actualizar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";';
  echo '</script>';
}
?>
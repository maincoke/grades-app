<?php
/**
 *  Controlador de Materias para el Sitio de gestion Academica /* * *
 */
require_once('../models/Subject.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $newSubject = new Subject();
  if ($newSubject->fetchDataSubjectMatter($_POST['subjectMatter'])) {
    echo '<script>alert("El nombre de materia especificado ya existe!! \nIntente de nuevo con otro nombre.");';
    echo 'window.location = "../views/main.php";';
    echo '</script>';
  } else {
    $newSubject->setDataSubject($_POST['subjectMatter']);
    $newSubject->saveDataSubject();
    echo '<script>alert("Materia registrada con éxito!!");';
    echo 'window.location = "../views/main.php";';
    echo '</script>';
  }
} else {
  echo '<script>alert("Hubo un error y no se puede actualizar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";';
  echo '</script>';
}
?>
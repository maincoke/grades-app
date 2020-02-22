<?php
/**
 *  Controlador de Estudiante para el Sitio de gestion Academica /* * *
 */
require_once('../models/Student.php');
session_start();
if (isset($_POST) && isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $newStudent = new Student();
  $idStudent = intval($_POST['idStudent']);
  $subject = intval($_POST['subject']);
  $teacher = intval($_POST['teacher']);
  $grade = intval($_POST['grade']);
  $gradeChk = $newStudent->fetchOneGradeStd($idStudent, $subject, $teacher);
  $idGrade = $_POST['stdUsername'].$_POST['idStudent'].$_POST['subject'].$_POST['teacher'].$_POST['grade'];
  if (!$gradeChk) {
    $newStudent->addStudentGrade($idGrade, $_POST['idStudent'], $_POST['subject'], $_POST['teacher'], $_POST['grade']);
    echo '<script>alert("La materia y la nota fueron agregadas con éxito..!!");</script>';
  } else {
    $newStudent->updateSubjectStd($gradeChk['id_grade'], $idGrade, $grade);
    echo '<script>alert("La nota de la materia fue actualizada con éxito..!!");</script>';
  }
  echo '<script>window.location = "../views/main.php";</script>';
} else {
  echo '<script>alert("Hubo un error y no se puede actualizar el registro!! \nIntente de nuevo más tarde.");';
  echo 'window.location = "../views/main.php";</script>';
}
?>
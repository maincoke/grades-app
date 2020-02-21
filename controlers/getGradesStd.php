<?php 
/**
 *  Controlador para orden AJAX de datos de Estudiantes //--**
 */
require_once('../models/Student.php');
$studentid = json_decode($_POST['id_student']);
$std = new Student();
$stdData = $std->fetchGradesStudent(intval($studentid));
$data_Student = json_encode($stdData);
echo $data_Student;
?>
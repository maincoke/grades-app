<?php 
/**
 *  Controlador para orden AJAX de datos de Docentes //--**
 */
require_once('../models/Teacher.php');
$teacherid = json_decode($_POST['id_teacher']);
$tch = new Teacher();
$tchData = $tch->fetchTeacherData(intval($teacherid));
$data_Teacher = json_encode($tchData);
echo $data_Teacher;
?>
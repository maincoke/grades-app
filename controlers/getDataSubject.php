<?php 
/**
 *  Controlador para orden AJAX de datos de Materias //--**
 */
require_once('../models/Subject.php');
$subjectid = json_decode($_POST['id_subject']);
$sbj = new Subject();
$sbjData = $sbj->fetchDataSubject(intval($subjectid));
$data_Subject = json_encode($sbjData);
echo $data_Subject;
?>
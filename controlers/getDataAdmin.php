<?php 
/**
 *  Controlador para orden AJAX de datos de Administradores //--**
 */
require_once('../models/Admin.php');
$adminid = json_decode($_POST['id_admin']);
$adm = new Admin();
$admData = $adm->fetchAdminData(intval($adminid));
$data_Admin = json_encode($admData);
echo $data_Admin;
?>
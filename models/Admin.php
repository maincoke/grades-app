<?php
/**
 *  Clase Administrador para el Sitio de Gestión Academica /* * *
 */
require_once('../models/User.php');

class Admin extends User {

  protected $connect;
  private $idAdmin;
  private $admIdent;
  private $email;
  private $dateSignup;

  public function __construct() {
    parent::__construct();
    $this->connect = parent::getConnection();
  }

  public function setAdminData(int $idAdmin, string $admIdent, string $email, $dateSignup) {
    $this->idAdmin = $idAdmin;
    $this->admIdent = $admIdent;
    $this->email = $email;
    $this->dateSignup = $dateSignup;
  }

  public function getAdminData(string $property) {
    return $this->$property;
  }

  public function saveAdminData() {
    $query = $this->connect->prepare('INSERT INTO admins (id_admin, document, email, date_signup) '.
                                     'VALUES (:idAdmin, :admIdent, :email, :dateSignup)');
    $query->execute(array(':idAdmin' => $this->idAdmin, ':admIdent' => $this->admIdent, ':email' => $this->email, ':dateSignup' => $this->dateSignup));
  }

  public function fetchAdminData(int $idAdmin) {
    $query = $this->connect->prepare('SELECT * FROM users AS u INNER JOIN admins AS a ON u.id_user = a.id_admin WHERE u.id_user = :idAdmin');
    $query->execute(array('idAdmin' => $idAdmin));
    if ($query->rowCount() != 0) {
      return $query->fetchAll();
    }
    return false;
  }

  public function fetchAllAdmins() {
    $query = $this->connect->prepare('SELECT * FROM users AS u INNER JOIN admins AS a ON u.id_user = a.id_admin'.
                                     ' WHERE u.profile = "Administrador"');
    $query->execute();
    if ($query->rowCount() != 0) {
      return $query->fetchAll();
    }
    return false;
  }

  public function emailAdminValidation(string $emailAdmin) {
    $query = $this->connect->prepare('SELECT email FROM admins WHERE email = :emailAdmin');
    $query->execute(array(':emailAdmin' => $emailAdmin));
    if ($query->rowCount() != 0) {
      return true;
    }
    return false;
  }

  public function updateDataAdmin() {
    $query = $this->connect->prepare('UPDATE admins SET email=:email WHERE id_admin = :idAdmin');
    $query->execute(array('idAdmin'=> $this->idAdmin, ':email'=> $this->email));
  }
}
?>
<?php
/**
 *  Clase Administrador para el Sitio de Gestión Academica /* * *
 */
require_once('../models/User.php');

class Admin extends User {

  private $idAdmin;
  private $email;
  private $dateSignup;

  public function __construct(int $idAdmin, string $email, DateTime $dateSignup) {
    $this->setAdminData($idAdmin, $email, $dateSignup);
    $this->connect = parent::getConnection();
  }

  public function setAdminData(int $idAdmin, string $email, DateTime $dateSignup) {
    $this->idAdmin = $idAdmin;
    $this->email = $email;
    $this->dateSignup = $dateSignup;
  }

  public function getAdminData(string $property) {
    return $this->$property;
  }

  public function saveAdminData() {
    $query = $this->connect->prepare('INSERT INTO admins VALUES (:idAdmin, :email, :dateSignup)');
    return $query->execute(array(':idAdmin' => $this->idAdmin, ':email' => $this->email,
                          ':dateSignup' => $this->dateSignup));
  }

  public function fetchAdminData(int $idAdmin) {
    $query = $this->connect->prepare('SELECT * FROM admins WHERE id_admin = :idAdmin');
    $query->execute(array('idAdmin' => $idAdmin));
    if ($query->rowCount() != 0) {
      return $query->fetch();
    }
    return false;
  }
}
?>
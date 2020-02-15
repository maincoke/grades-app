<?php
/**
 *  Clase Estudiante para el Sitio de Gestión Academica /* * *
 */
require_once('../models/User.php');

class Student extends User {

  protected $connect;
  private $idStudent;
  private $stdIdent;
  private $email;
  private $dateSignup;

  public function __construct() {
    parent::__construct();
    $this->connect = parent::getConnection();
  }

  public function setStudentData(int $idStudent, string $stdIdent, string $email, $dateSignup) {
    $this->idStudent = $idStudent;
    $this->stdIdent = $stdIdent;
    $this->email = $email;
    $this->dateSignup = $dateSignup;
  }

  public function getStudentData(string $property) {
    return $this->$property;
  }

  public function saveStudentData() {
    $query = $this->connect->prepare('INSERT INTO students (id_student, document, email, date_signup) '.
                                     'VALUES (:idStudent, :stdIdent, :email, :dateSignup)');
    $query->execute(array(':idStudent' => $this->idStudent, ':stdIdent' => $this->stdIdent, ':email' => $this->email, ':dateSignup' => $this->dateSignup));
  }

  public function fetchStudentData(int $idStudent) {
    $query = $this->connect->prepare('SELECT * FROM users AS u INNER JOIN students AS a ON u.id_user = a.id_student WHERE u.id_user = :idStudent');
    $query->execute(array('idStudent' => $idStudent));
    if ($query->rowCount() != 0) {
      return $query->fetchAll();
    }
    return false;
  }

  public function fetchAllStudents() {
    $query = $this->connect->prepare('SELECT * FROM users AS u INNER JOIN students AS a ON u.id_user = a.id_student'.
                                     ' WHERE u.profile = "Estudiante" AND u.state = "Activo"');
    $query->execute();
    if ($query->rowCount() != 0) {
      return $query->fetchAll();
    }
    return false;
  }
}
?>
<?php
/**
 *  Clase Docente para el Sitio de Gestión Academica /* * *
 */
require_once('../models/User.php');

class Teacher extends User {

  protected $connect;
  private $idTeacher;
  private $tchIdent;
  private $email;
  private $dateSignup;

  public function __construct() {
    parent::__construct();
    $this->connect = parent::getConnection();
  }

  public function setTeacherData(int $idTeacher, string $tchIdent, string $email, $dateSignup) {
    $this->idTeacher = $idTeacher;
    $this->tchIdent = $tchIdent;
    $this->email = $email;
    $this->dateSignup = $dateSignup;
  }

  public function getTeacherData(string $property) {
    return $this->$property;
  }

  public function saveTeacherData() {
    $query = $this->connect->prepare('INSERT INTO teachers (id_teacher, document, email, date_signup) '.
                                     'VALUES (:idTeacher, :tchIdent, :email, :dateSignup)');
    $query->execute(array(':idTeacher' => $this->idTeacher, ':tchIdent' => $this->tchIdent, ':email' => $this->email, ':dateSignup' => $this->dateSignup));
  }

  public function fetchTeacherData(int $idTeacher) {
    $query = $this->connect->prepare('SELECT * FROM users AS u INNER JOIN teachers AS a ON u.id_user = a.id_teacher WHERE u.id_user = :idTeacher');
    $query->execute(array('idTeacher' => $idTeacher));
    if ($query->rowCount() != 0) {
      return $query->fetch(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function fetchAllTeachers() {
    $query = $this->connect->prepare('SELECT * FROM users AS u INNER JOIN teachers AS a ON u.id_user = a.id_teacher '.
                                     'WHERE u.profile = "Docente"');
    $query->execute();
    if ($query->rowCount() != 0) {
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function emailTeacherValidation(string $emailTeacher) {
    $query = $this->connect->prepare('SELECT email FROM teachers WHERE email = :emailTeacher');
    $query->execute(array(':emailTeacher' => $emailTeacher));
    if ($query->rowCount() != 0) {
      return true;
    }
    return false;
  }

  public function updateDataTeacher() {
    $query = $this->connect->prepare('UPDATE teachers SET email=:email WHERE id_teacher = :idTeacher');
    $query->execute(array('idTeacher' => $this->idTeacher));
  }
}
?>
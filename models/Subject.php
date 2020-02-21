<?php
/**
 *  Clase Subject para el Sitio de Gestión Academica /* * *
 */
require_once('../models/Connection.php');

class Subject extends Connection {

  protected $connect;
  private $subjectmatter;

  public function __construct() {
    $this->connect = parent::__construct();
  }

  public function setDataSubject(string $subjectmatter) {
    $this->subjectmatter = $subjectmatter;
  }

  public function saveDataSubject() {
    $query = $this->connect->prepare('INSERT INTO subjects (subjectmatter) VALUES (:subjectMatter)');
    $query->execute(array(':subjectMatter' => $this->subjectmatter));
    return $this->connect->lastInsertId();
  }

  public function getDataSubject(string $property) {
    return $this->$property;
  }

  public function fetchDataSubject(int $subjectId) {
    $query = $this->connect->prepare('SELECT * FROM subjects WHERE id_subject = :subjectId');
    $query->execute(array('SubjectId'=> $subjectId));
    if ($query->rowCount() != 0) {
      return $query->fetch();
    }
    return false;
  }

  public function fetchAllSubjects() {
    $query = $this->connect->prepare('SELECT * FROM subjects');
    $query->execute();
    return $query->fetchAll();
  }

  public function updateData(int $subjectId) {
    $query = $this->connect->prepare('UPDATE subjects SET subjectmatter = :subjectMatter WHERE id_subject = :subjectId');
    $query->execute(array(':subjectId'=> $subjectId));
  }

  public function getConnection() {
    return $this->connect;
  }
}
?>
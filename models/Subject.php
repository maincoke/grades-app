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
    $query->execute(array('subjectId'=> $subjectId));
    if ($query->rowCount() != 0) {
      return $query->fetch(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function fetchDataSubjectMatter(String $subjectMatter) {
    $query = $this->connect->prepare('SELECT * FROM subjects WHERE subjectmatter = :subjectMatter');
    $query->execute(array('subjectMatter'=> $subjectMatter));
    if ($query->rowCount() != 0) {
      return true;
    }
    return false;
  }

  public function fetchAllSubjects() {
    $query = $this->connect->prepare('SELECT * FROM subjects');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function updateDataSubject(int $subjectId) {
    $query = $this->connect->prepare('UPDATE subjects SET subjectmatter = :subjectMatter WHERE id_subject = :subjectId');
    $query->execute(array(':subjectId'=> $subjectId, ':subjectMatter'=> $this->subjectmatter));
  }

  public function getConnection() {
    return $this->connect;
  }
}
?>
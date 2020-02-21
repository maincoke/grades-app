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
                                     ' WHERE u.profile = "Estudiante"');
    $query->execute();
    if ($query->rowCount() != 0) {
      return $query->fetchAll();
    }
    return false;
  }

  public function emailStudentValidation(string $emailStudent) {
    $query = $this->connect->prepare('SELECT email FROM students WHERE email = :emailStudent');
    $query->execute(array(':emailStudent' => $emailStudent));
    if ($query->rowCount() != 0) {
      return true;
    }
    return false;
  }

  public function updateDataStudent() {
    $query = $this->connect->prepare('UPDATE students SET email=:email WHERE id_student = :idStudent');
    $query->execute(array('idStudent' => $this->idStudent));
  }

  public function fetchGradesStudent(int $studentId) {
    $query = $this->connect->prepare('SELECT st.name AS namestd , st.lastname AS lnamestd, sb.subjectmatter AS sbjname, gr.average AS grade, '.
                                     'th.name AS nametch, th.lastname AS lnametch FROM grades AS gr '.
                                     'INNER JOIN users AS st ON gr.fk_student = st.id_user '.
                                     'INNER JOIN subjects AS sb ON sb.id_subject = gr.fk_subject '.
                                     'INNER JOIN users AS th ON gr.fk_teacher = th.id_user WHERE st.id_user = :studentId');
    $query->execute(array(':studentId' => $studentId));
    if ($query->rowCount() != 0) {
      return $query->fetchAll();
    }
    return false;
  }

  public function fetchOneGradeStd(int $studentId, int $subjectId, int $teacherId) {
    $query = $this->connect->prepare('SELECT id_grade, average FROM grades WHERE fk_student = :studentId AND fk_subject = :subjectId AND fk_teacher = :teacherId');
    $query->execute(array(':studentId'=> $studentId, ':subjectId'=> $subjectId, ':teacherId'=> $teacherId));
    if ($query->rowCount() != 0) {
      return $query->fetch();
    }
    return false;
  }

  public function addStudentGrade(String $gradeId, int $studentId, int $subjectId, int $teacherId, int $grade) {
    $query = $this->connect->prepare('INSERT INTO grades (id_grade, fk_student, fk_subject, fk_teacher, average) '.
                                     'VALUES (:gradeId, :studentId, :subjectId, :teacherId, :grade)');
    $query->execute(array(':gradeId'=> $gradeId, ':studentId'=> $studentId, ':subjectId'=> $subjectId, ':teacherId'=> $teacherId, ':grade'=> $grade));
  }

  public function updateSubjectStd(String $gradeId, String $gradeIdNew, int $grade) {
    $query = $this->connect->prepare('UPDATE grades SET id_grade = :gradeIdNew, average = :grade WHERE id_grade = :gradeId');
    $query->execute(array(':gradeId'=> $gradeId, ':gradeIdNew'=> $gradeIdNew, ':grade'=> $grade));
  }
}
?>
<?php
/**
 *  Clase USer para el Sitio de Gestión Academica /* * *
 */
require_once('../models/Connection.php');

class User extends Connection {

  protected $connect;
  private $name;
  private $lastname;
  private $username;
  private $password;
  private $profile;
  private $state;

  public function __construct() {
    $this->connect = parent::__construct();
  }

  public function setData(string $name, string $lastname, string $username, string $pword, string $profile, string $state) {
    $this->name = $name;
    $this->lastname = $lastname;
    $this->username = $username;
    $this->password = $pword;
    $this->profile = $profile;
    $this->state = $state;
  }

  public function saveData() {
    $query = $this->connect->prepare('INSERT INTO users (name, lastname, username, password, profile, state) '.
                                    'VALUES (:name, :lastname, :username, :pword, :profile, :state)');
    $query->execute(array(':name' => $this->name, ':lastname' => $this->lastname, ':username' => $this->username, ':pword' => $this->password,
                          ':profile' => $this->profile, ':state' => $this->state));
    return $this->connect->lastInsertId();
  }

  public function getData(string $property) {
    return $this->$property;
  }

  public function fetchData(int $idUser) {
    $query = $this->connect->prepare('SELECT * FROM users WHERE id_user = :idUser');
    $query->execute(array('idUser' => $idUser));
    if ($query->rowCount() != 0) {
      return $query->fetch();
    }
    return false;
  }

  public function validateUser(string $username) {
    $query = $this->connect->prepare('SELECT * FROM users WHERE username = :username');
    $query->execute(array(':username' => $username));
    if ($query->rowCount() != 0) {
      return true;
    }
    return false;
  }

  public function checkLogin(string $username, string $userpass) {
    $query = $this->connect->prepare('SELECT * FROM users WHERE username = :username AND password = :userpass');
    $query->execute(array(':username' => $username, ':userpass' => $userpass));
    if ($query->rowCount() != 0) {
      $result = $query->fetch();
      session_start();
      $_SESSION['USERNAME'] = $result['username'];
      $_SESSION['ID'] = $result['id_user'];
      $_SESSION['PROFILE'] = $result['profile'];
      return true;
    }
    return false;
  }

  public function getConnection() {
    return $this->connect;
  }
}
?>
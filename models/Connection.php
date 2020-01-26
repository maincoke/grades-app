<?php
/**
 *  Clase Connection para la conexion a la BD del Sitio de Gestión Academica /* * *
 */
class Connection {
  protected $connect;
  private $driver;
  private $db;
  private $dsn;
  private $host;
  private $dbuser;
  private $dbpass;

  public function __construct() {
    $this->driver = 'mysql';
    $this->db = 'grades_app';
    $this->host = 'localhost';
    $this->dbuser = 'generalusr';
    $this->dbpass = 'users12345';
    $this->dsn = $this->driver.':host='.$this->host;
    return $this->connectDB();
  }
  
  private function connectDB() {
    try {
      $this->connect = new PDO($this->dsn.';dbname='.$this->db, $this->dbuser, $this->dbpass);
      $this->connect->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
      return $this->connect;
    } catch (PDOException $err) {
      echo 'Hubo un error en la conexión:<br>'.$err->getMessage();
    }
  }
  
}
?>
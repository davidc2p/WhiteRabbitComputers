<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
  public  $environment; //1 is dev
	private $con;
	
  // constructor
  function __construct($environment) {
    // connecting to database
    $this->environment = $environment;
    $this->con = $this->connect();
  }

  // destructor
  function __destruct() {
    // closing db connection
    $this->close();
  }

  /**
   * Function to connect with database
   */
  function connect() {
    // import database connection variables
    require_once 'db_config.php';
    try {        
      // Connecting to mysql database
      //$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
      $con = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
    catch(PDOException $ex) {
      print "An Error occurred: ".$ex->getMessage(); //user friendly message
    }

    // Selecting database
    //$db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());

    // returning connection cursor
    return $con;
  }
  /**
   * Function to get db connection
   */
  public function getDb() {
    if ($this->con instanceof PDO) {
      return $this->con;
    }
  }

  /**
   * Function to close db connection
   */
  function close() {
    // closing db connection
    //mysql_close();
    $this->con = null;
  }
}
 
?>
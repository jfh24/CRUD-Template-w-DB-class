<?php
  class Database{
    private $host = 'localhost';
    private $dbName = 'tester1000';
    private $username = 'root';
    private $password = '';
    private $conn = NULL;

    //DB Connect
    public function con(){

        try{

            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch (\Exception $e){

          echo "Connection Error: " . $e->getMessage();

        }

        return $this->conn;
    }
  }
?>

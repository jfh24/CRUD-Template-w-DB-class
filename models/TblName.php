<?php

  /**
   *  @author Joshua F. Helt
   *  @copyright April 2020
   *
   * CRUD Template capible of managing one database column.
   *
   */

  class TblName
  {
          private $conn;
          private $table = 'info';
          public $id;
          public $body;

      /*
      * [FUNCTION] Constructor w/ DB
      */

          public function __construct($db){

            $this->conn = $db;

          }

      /*
      * [FUNCTION] Read All
      */

          public function read(){

             // Setup Query
            $q = 'SELECT
                x.id,
                x.body
              FROM
                ' . $this->table . ' x
              ORDER BY
                x.id DESC';

             // Prepare and execute statement
            $stmt = $this->conn->prepare($q);
            $stmt->execute();

             // Return query results
            return $stmt;}

      /*
      * [FUNCTION] Read single by Id
      */

          public function readSingleById(){

             // Setup Query
             $q = 'SELECT
                 x.id,
                 x.body
               FROM
                 ' . $this->table . ' x
              WHERE
                x.id = ?
              LIMIT 0,1';

               // Prepare, bind, and execute statement
              $stmt = $this->conn->prepare($q);
              $stmt->bindParam(1, $this->id);
              $stmt->execute();

               // Assign result to local properties
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              $this->id = $row['id'];
              $this->body = $row['body'];}

      /*
      * [FUNCTION] Create
      */

          public function create(){

              $q = 'INSERT INTO ' . $this->table . ' SET body = :body ';

               // Prepare statement and clean inset data
              $stmt = $this->conn->prepare($q);
              $this->body = htmlspecialchars(strip_tags($this->body));

               // Bind cleaned data to prepared statement
              $stmt->bindParam(':body', $this->body);

              if ($stmt->execute()) {
                return true;
              }
                printf("Error: %s.\n", $stmt->error);}

      /*
      * [FUNCTION] Update by Id
      */

          public function updateById(){

              // Setup query
              $query = 'UPDATE ' . $this->table . '
                                    SET
                                      body = :body
                                    WHERE
                                      id = :id';

              // Prepare statement
              $stmt = $this->conn->prepare($query);

              // Clean data
              $this->id = htmlspecialchars(strip_tags($this->id));
              $this->body = htmlspecialchars(strip_tags($this->body));


              // Bind local attributes to statement parameters
              $stmt->bindParam(':id', $this->id);
              $stmt->bindParam(':body', $this->body);


              // Execute query
              if($stmt->execute()) {
                return true;
              }

              // Print error if something goes wrong
              printf("Error: %s.\n", $stmt->error);

              return false;}

      /*
      * [FUNCTION] Delete by Id
      */

          public function deleteById(){

              // Create query
              $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

              // Prepare statement and clean data
              $stmt = $this->conn->prepare($query);
              $this->id = htmlspecialchars(strip_tags($this->id));

              // Bind local attribute "id" to statement prameter
              $stmt->bindParam(':id', $this->id);

              // Execute query
              if($stmt->execute()) {
                return true;}

              }
}

?>

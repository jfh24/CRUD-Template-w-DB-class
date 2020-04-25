<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/TblName.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->con();

  // Instantiate TblName object
  $tblName = new TblName($db);

  // Set ID to Delete
  $tblName->id = $_GET['id'];

  // Delete post
  if($tblName->deleteById()) {
    echo json_encode(
      array('message' => 'Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Not Deleted')
    );
  }

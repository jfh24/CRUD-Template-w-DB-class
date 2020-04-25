<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: Get');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/TblName.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->con();

  // Instantiate blog post object
  $tblName = new TblName($db);

  $tblName->body = $_GET['body'];

  // Create post
  if($tblName->create()) {
    echo json_encode(
      array('message' => 'Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Not Created')
    );
  }

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

  // Set local attributes from data input
  $tblName->id = $_GET['id'];
  $tblName->body = $_GET['body'];

  // Update
  if($tblName->updateById()) {
    echo json_encode(
      array('message' => 'Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Not Updated')
    );
  }

<?php
//Headers
header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/tblName.php';

//instantiate DB & Connect
$database = new Database();
$db = $database->con();

//Instantiate blog post object
$tblName = new TblName($db);

//Get ID
$tblName->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get Post
$tblName->readSingleById();

//Create array
$tblArr = array(
      'id' => $tblName->id,
      'body' => $tblName->body
    );

//Export to JSON
print_r(json_encode($tblArr));
?>

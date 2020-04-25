<?php
//Headers
header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/TblName.php';

//instantiate DB & Connect
$database = new Database();
$db = $database->con();

//Instantiate tblName object and call read function from model
$tblName = new TblName($db);
$result = $tblName->read();

//Get row count
$num = $result->rowCount();

//Check if content exists
if ($num > 0 )
{
  //Post Array
  $postsArr = array();
  $postsArr['data']  = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC))
  {
    extract($row);

    $postItem = array(
      'id' => $id,
      'body' => html_entity_decode($body)
    );

    //Push array items to "Data"
    array_push($postsArr, $postItem);
}
    //Export to JSON
    echo json_encode($postsArr);
}else
{
  echo json_encode(array('Message' => 'Array returned empty!'));
}

?>

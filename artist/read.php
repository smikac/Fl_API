<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/artist.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$artist = new Artist($db);
 
// set ID property of record to read
$artist->id = isset($_GET['id']) ? $_GET['id'] : die();

// query products
$stmt = $artist->readOne();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $artist_arr=array();
    $artist_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $artist_item=array(
            "Id" => $Id,
            "Stage" => $Stage,
            "Artist" => $Artist,
            "Day" => $Day,
            "SetStartTime" => $SetStartTime,
            "SetEndTime" => $SetEndTime
        );

        array_push($artist_arr["records"], $artist_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($artist_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
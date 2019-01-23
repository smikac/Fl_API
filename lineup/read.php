<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/lineup.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$lineUp = new LineUp($db);
 
// set ID property of record to read
$lineUp->year = isset($_GET['year']) ? $_GET['year'] : die();

// query products
$stmt = $lineUp->getLineUp();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $lineUp_arr=array();
    $lineUp_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $lineUp_item=array(
             "Year" => $Year,
            "Stage" => $Stage,
            "Day" => $Day,
            "Artist" => $Artist,
            "SetStartTime" => $SetStartTime,
            "SetEndTime" => $SetEndTime
        );

        array_push($lineUp_arr["records"], $lineUp_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($lineUp_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
<?php
class LineUp{
 
    // database connection and table name
    private $conn;
    private $table_name = "lineup";
 
    // object properties
    public $id;
    public $year;
    public $stage;
    public $day;
    public $artist;
    public $setStartTime;
    public $setEndTime;
     
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function getLineUp(){
    
        // select all query
        $query = "call getLineUp(".$this->year.")";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }          
}
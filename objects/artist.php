<?php
class Artist{
 
    // database connection and table name
    private $conn;
    private $table_name = "artist";
 
    // object properties
    public $id;
    public $name;
    public $country;
    public $description;
     
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
        // select all query
        $query = "call getArtist()";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }    

    // read products
    function readOne(){
        // select all query
        $query = "call getArtist(".$id.")";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }       
}
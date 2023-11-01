<?php
include ('Event.php');
class Events_DAO {
    private $conn;

    public function __construct(){
        $this->connectToDatabase();
    }

    public function connectToDatabase(){
        $dbHost='newsroom-server.mysql.database.azure.com';
        $dbName='Events';
        $dbUser='db_admin';
        $dbPass='newsr00m!';
        try{
            $this->conn=new mysqli($dbHost, $dbUser, $dbPass, $dbName);
           if($this->conn->connect_error){
            throw new Exception('Blad polaczenia z baza danych'. $this->conn->connect_error);
           }
            
        }catch (Exception $e){
            echo("DB connection error: ".$e->getMessage());
        }

    }
    public function fetchEvents(){
        $query="select * from events";
        $stmt=$this->conn->query($query);
        $events=[];
        while ($row=$stmt->fetch_assoc()){
            
           $event=new Event(
            $row['id'],
            $row['name'],
            $row['start_date'],
            $row['end_date'],
            $row['description'],
            'images/'.$row['category_id'],
            $row['category_id']
           );
           $events[]=$event;
        
           
            }
            $this->conn->close();
            return $events;
            
        }
}
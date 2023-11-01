<?php
include ('Event.php');
class Events_DAO {
    private $pdo;

    public function __construct(){
        $this->connectToDatabase();
    }

    public function connectToDatabase(){
        $dbHost='newsroom-server.mysql.database.azure.com';
        $dbName='Events';
        $dbUser='db_admin';
        $dbPass='newsr00m!';
        try{
            $this->pdo=new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4;sslmode=require",$dbUser, $dbPass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        }catch (PDOException $e){
            die("DB connection error: ".$e->getMessage());
        }

    }
    public function fetchEvents(){
        $query="select * from events";
        $stmt=$this->pdo->query($query);
        $events=[];
        while ($row=$stmt->fetch()){
            
           $event=new Event(
            $row['is'],
            $row['name'],
            $row['start-date'],
            $row['end_date'],
            $row['description'],
            'images/'.$row['category_id'],
            $row['category_id']
           );
           $events[]=$event;
        
           
            }
            return $events;
        }
}
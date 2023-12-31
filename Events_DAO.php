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
        $query="select * from events order by start_date desc";
        $stmt=$this->conn->query($query);
        $events=[];
        while ($row=$stmt->fetch_assoc()){
            
           $event=new Event(
            $row['id'],
            $row['name'],
            $row['start_date'],
            $row['end_date'],
            $row['description'],
            'images/'.$row['category_id'].'.svg',
            $row['category_id']
           );
           $events[]=$event;
        
           
            }
            $this->conn->close();
            return $events;
            
        }
        public function fetchEventById($id){
            $query= "select e.name, e.description, e.start_date, e.end_date, e.category_id, c.name as category_name
            from events as e
            join categories as c
            on c.id=e.category_id
            where e.id=".$id.";";
            $stmt=$this->conn->query($query);
            $row=$stmt->fetch_assoc();
            $event=new Event($id, $row['name'], $row['start_date'], $row['end_date'], $row['description'], 'images/'.$row['category_id'].'.svg', $row['category_id'] );
            return $event;
        }
        public function fetchCategoryName($id){
            $query="select c.name as category_name
            from events as e
            join categories as c
            on c.id=e.category_id
            where e.id=".$id.";";
            $stmt=$this->conn->query($query);
            $row=$stmt->fetch_assoc();
            return $row['category_name'];
        }
        public function fetchAllCategories() {
            $query = "SELECT id, name FROM categories";
            $categories = array();
    
            if ($result = $this->conn->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $categories[] = $row;
                }
                $result->free();
            }
    
            return $categories;
        }
        public function deleteEvent($eventId){
            $query = "DELETE FROM events WHERE id = ?";
            if($stmt = $this->conn->prepare($query)){
                $stmt->bind_param("i", $eventId);
                if($stmt->execute()){
                    $stmt->close();
                    return true;
                }
                $stmt->close();
            }
            return false;
        }
        public function updateEvent($eventId, $eventData){
            $query = "UPDATE events SET name = ?, start_date = ?, end_date = ?, description = ?, category_id = ? WHERE id = ?";
            if($stmt = $this->conn->prepare($query)){
                $stmt->bind_param("ssssii", $eventData['name'], $eventData['start_date'], $eventData['end_date'],$eventData['description'], $eventData['category_id'], $eventId);
                if($stmt->execute()){
                    $stmt->close();
                    return true;
                }
                $stmt->close();
            }
            return false;
        }
        public function addEvent($eventData){
            $query = "INSERT INTO events (name, description, start_date, end_date, category_id)
            VALUES (?, ?, ?, ?, ?)";
            if($stmt = $this->conn->prepare($query)){
                $stmt->bind_param("ssssi", $eventData['name'], $eventData['description'], $eventData['start_date'], $eventData['end_date'], $eventData['category_id']);
                if($stmt->execute()){
                    $stmt->close();
                    return true;
                }
                $stmt->close();

            }
            return false;
        }
        
        
}
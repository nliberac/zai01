<?php
class Users_DAO {
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
    public function login($username, $password){
        $query= "select id, username, password from users where username = ?";
        if($stmt=$this->conn->prepare($query)){
            $stmt->bind_param("s", $username);
            if( $stmt->execute() ){
                $stmt->store_result();
                if($stmt->num_rows==1){
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;
                            return true;
                        } else{
                            return false;
                        }
                    }
                } else{
                    return false;
                }
            }else{
            echo "Blad wykonywania zapytania";
            return false;
        }
        $stmt->close();
} else{
    echo "Blad podczas przygotowywania zapytania";
    return false;
}
    }

    public function closeConnection(){
        $this->conn->close();
    }
    public function createTestUser(){
        $username='test';
        $password= 'test';
        $hashed_password=password_hash($password, PASSWORD_DEFAULT);
        $query="insert into users (username, password) values (?,?)";
        $stmt=$this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();
        $stmt->close();
       
    }    
}
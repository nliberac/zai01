<?php
require_once "Users_DAO.php";



$username = isset($_POST['username'])? trim($_POST['username']) :'';
$password = isset($_POST['password'])? trim($_POST['password']) :'';


$dao=new Users_DAO();

if ($dao->login($username, $password)) {
    header('Location: index.php');
}else{
    echo 'Logowanie nie powiodlo sie ';
}
$dao->closeConnection();
   ?>
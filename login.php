<?php
require_once "Users_DAO.php";

session_start();


$username = isset($_POST['username'])? trim($_POST['username']) :'';
$password = isset($_POST['password'])? trim($_POST['password']) :'';

$dao=new Users_DAO();

if ($dao->login($username, $password)) {
    header('Location: index.php');
}else{
    header('Location: index.php');
}
$dao->closeConnection();
   ?>
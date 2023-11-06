<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location: login.html');
    exit;
}


if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $eventId = $_GET['id'];


    include('Events_DAO.php');
    $dao = new Events_DAO();

    if($dao->deleteEvent($eventId)){

        $_SESSION['message'] = 'Wydarzenie zostało usunięte.';
        header('Location: index.php');
    } else {

        $_SESSION['message'] = 'Nie udało się usunąć wydarzenia.';
        header('Location: index.php');
    }
} else {

    header('Location: error.php');
}
$dao->closeConnection();
exit;
?>

<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kalendarium</title>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">

    </head>
    <body>
        <div class="main">
        <div class="header">
        <h1>Kalendarium</h1>

        <?php 
        
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
        echo '<a href="login.html" class="login-button">Logowanie</a>';
        }else{
            echo '<a href="new.php" class="login-button">Nowe wydarzenie</a>
            <a href="logout.php" class="login-button">Wyloguj</a>';
        }; 
        ?>
        </div>
        <div class="container1">
       <div class="timeline">
        <div class="timeline-line"></div>

        <?php
        include('Events_DAO.php');
       
        $dao=new Events_DAO();
        $events=$dao->fetchEvents();
        foreach($events as $event) {
       echo '<div class="event">
            <div class="event-point"></div>
            <div class="event-details">
                <h2><a href="event_details.php?id='.$event->getId().'">'.$event->getName().'</a></h2>
                <p>Data: '.$event->getStart_date().'</p>
            </div><div><img src="'.$event->getVisualization().'"></div>';
            if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
                echo ' </div>';
                }else{
                    echo '<a href="edit.php?id='.$event->getId().'" class="edit-button">Edytuj</a>
                    <a href="delete.php?id='.$event->getId().'" class="edit-button">Usun</a></div>';
                }; 
           
        }
        ?>

       </div>

    
       
        </div>
        
    </body>
</html>
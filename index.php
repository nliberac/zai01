<!DOCTYPE html>
<html>
    <head>
        <title>Kalendarium</title>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">

    </head>
    <body>
        <div class="main">
        <div class="header">
        <h1>Kalendarium</h1>
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
            </div><div><img src="'.$event->getVisualization().'"></div>
            </div>';
        }
        ?>

       </div>

    
       
        </div>
        
    </body>
</html>
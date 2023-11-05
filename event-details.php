<!DOCTYPE html>
<html>
<head>
    <title>Szczególy wydarzenia</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
    <?php
    include('Events_DAO.php');
    $dao = new Events_DAO();
    $eventId = isset($_GET['id']) ? $_GET['id']: die('Nie podano Id wydarzenia.');
    $event = $dao->fetchEventById($eventId);
    if($event){
        echo '<div class="event-details">
        <h1>'.$event->getName().'</h1>
        <p>Data: '.$event->getStart_date().'</p>
        <p>'.$event->getDescription().'</p> // Zakładając, że istnieje taka metoda
        <img src="'.$event->getVisualization().'">
        </div>';
    }else{
        echo 'Nie zanleziono wydarzenia';
    }
    ?>
    <a href="index.php">Powrót do Kalendarium</a>
</body>
</html>
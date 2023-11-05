<!DOCTYPE html>
<html>
<head>
    <title>Szczególy wydarzenia</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
</head>
<body>
    <div class="main">
    <div class="header">
    <h1>Szczegoly</h1>
    </div>
    <div class="container1">
        <div class="timeline">
    <?php
    include('Events_DAO.php');
    $dao = new Events_DAO();
    $eventId = isset($_GET['id']) ? $_GET['id']: die('Nie podano Id wydarzenia.');
    $event = $dao->fetchEventById($eventId);
    if($event){
        echo '<div class="event">
        <div class="event-details">
        <h2>'.$event->getName().'</h2>
        <p>Kategoria: '.$dao->fetchCategoryName($eventId).'
        <p>Data rozpoczecia: '.$event->getStart_date().'</p>
        <p>Data zakonczenia: '.$event->getEnd_date().'
        <p>'.$event->getDescription().'</p>
        <img src="'.$event->getVisualization().'">
        </div></div>';
    }else{
        echo 'Nie zanleziono wydarzenia';
    }
    ?>
    </div></div>
    <a href="index.php">Powrót do Kalendarium</a>
    </div>
</body>
</html>
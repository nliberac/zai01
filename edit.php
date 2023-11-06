<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
    header('Location: login.html');
    exit;
}

require_once('Events_DAO.php');
$dao = new Events_DAO();
$eventId = $_GET['id'] ?? null;
if(!$eventId || !is_numeric($eventId)){
    header('Location: error.php');
    exit;
}

$event = $dao->fetchEventById($eventId);
$categories = $dao->fetchAllCategories();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $updatedEvent = [
        'name' => $_POST['name'],
        'start_date'=> $_POST['start_date'],
        'end_date'=> $_POST['end_date'],
        'description'=> $_POST['description'],
        'category_id'=> $_POST['category_id']
    ];
    if($dao->updateEvent($event, $updatedEvent)){
        $_SESSION['message'] = 'Wydarzenie zostalo zaktualizowane';
        header('Location: index.php');
        
    }else{
        $_SESSION['message'] = 'Nie udalo sie zaktualizowac wydarzenia';
    }
 
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Edycja</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
    </head>
    <body>
    <div class="main">
    <form action="edit.php?id=<?php echo $eventId; ?>" method="post">
    <label for="name">Nazwa wydarzenia:</label>
    <input type="text" id="name" name="name" value="<?php echo $event->getName(); ?>" required>

    <p><label for="start_date">Data rozpoczęcia:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $event->getStart_date(); ?>" required>
    </p>
    <p><label for="end_date">Data zakonczenia:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo $event->getEnd_date(); ?>" required>
    </p>
    <p><label for="description">Opis:</label>
    <textarea id="description" name="description" rows="4" cols="50"><?php echo $event->getDescription(); ?></textarea>
    </p>
    <p><label for="category">Kategoria:</label>
    <select id="category" name="category_id">
        <?php foreach($categories as $category): ?>
            <option value="<?php echo htmlspecialchars($category['id']); ?>"
                <?php if($event->getCategory_id() == $category['id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($category['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Zapisz zmiany">
</form>
<a href="index.php">Powrót do Kalendarium</a></div>
    </body>
</html>
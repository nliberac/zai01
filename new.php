<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header('Location: login.html');
    exit;
}

require_once('Events_DAO.php');
$dao = new Events_DAO();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newEvent = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'category_id' => $_POST['category_id']
    ];

    if ($dao->addEvent($newEvent)) {
        $_SESSION['message'] = 'Wydarzenie zostało dodane.';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['message'] = 'Nie udało się dodać wydarzenia.';
    }
}


$categories = $dao->fetchAllCategories();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Nowe Wydarzenie</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
</head>
<body>
    <form action="new.php" method="post">
        <label for="name">Nazwa wydarzenia:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Opis:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea>

        <label for="start_date">Data rozpoczęcia:</label>
        <input type="date" id="start_date" name="start_date" required>
        
        <label for="end_date">Data zakończenia:</label>
        <input type="date" id="end_date" name="end_date" required>

        <label for="category">Kategoria:</label>
        <select id="category" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category['id']); ?>">
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Dodaj Wydarzenie">
    </form>
    <a href="index.php">Powrót do Kalendarium</a></div>
</body>
</html>

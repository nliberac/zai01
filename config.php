<?php
// Parametry do połączenia z bazą danych
define('DB_SERVER', 'newsroom-server.mysql.database.azure.com'); // Adres serwera bazy danych
define('DB_USERNAME', 'db_admin'); // Nazwa użytkownika bazy danych
define('DB_PASSWORD', 'newsr00m!'); // Hasło użytkownika bazy danych
define('DB_NAME', 'Events'); // Nazwa bazy danych

// Próba połączenia z bazą danych MySQL
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Sprawdzenie połączenia
if($link === false){
    die("ERROR: Nie można się połączyć. " . mysqli_connect_error());
}
?>

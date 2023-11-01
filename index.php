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
        <div class="container">
        
        <?php
        include('Events_DAO.php');
       
        $dao=new Events_DAO();
        
        ?>
        </div>
        </div>
    </body>
</html>
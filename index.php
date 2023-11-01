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
        <canvas id="timelineCanvas" width="200" height="400"></canvas>
        <script>
            const canvas =document.getElementById('timelineCanvas');
            const ctx=canvas.getContext('2d');

            const lineWidth=4;
            const lineColor='#333';

            const startX=canvas.width/2;
            const startY=50;
            const endY=350;

            ctx.beginPath();
            ctx.moveTo(startX,startY);
            ctx.lineTo(startX, endY);
            ctx.lineWidth=lineWidth;
            ctx.strokeStyle=lineColor;
            ctx.stroke();
            ctx.closePath();

        <?php
        include('Events_DAO.php');
       
        $dao=new Events_DAO();
        $events=$dao->fetchEvents();
        foreach($events as $event) {
           $startDate=new DateTime($event->getStart_date());
           $endDate=new DateTime($event->getEnd_date());
           $endYTimestamp = $endDate->getTimestamp();
           $startYTimestamp = $startDate->getTimestamp();
           $currentTimestamp = (new DateTime('now'))->getTimestamp();
   
           echo "const scaleFactor = (endY - startY) / ($endYTimestamp - $startYTimestamp);";
           echo "const startYDate = startY + ($startYTimestamp - $currentTimestamp) * scaleFactor;";
           echo "const endYDate = startY + ($endYTimestamp - $currentTimestamp) * scaleFactor;";
            
           echo "ctx.beginPath();
                    ctx.moveTo(startX - 10, startYDate);
                    ctx.lineTo(startX + 10, startYDate);
                    ctx.lineWidth = 2;
                    ctx.strokeStyle = 'red'; // Możesz dostosować kolor
                    ctx.stroke();
                    ctx.closePath();";
        }
        ?>
        </script>
        </div>
        </div>
    </body>
</html>
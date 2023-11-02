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
        // Przekształć obiekty Event na tablice asocjacyjne
        $eventArray = array();
        foreach ($events as $event) {
        $eventArray[] = array(
        'id' => $event->getId(),
        'name' => $event->getName(),
        'start_date' => $event->getStart_date(),
        'end_date' => $event->getEnd_date(),
        'description' => $event->getDescription(),
        'visualization' => $event->getVisualization(),
        'category_id' => $event->getCategory_id()
    );
    };

    // Teraz możesz użyć json_encode na tablicy asocjacyjnej
    echo "const eventsData = " . json_encode($eventArray) . ";";
        ?>

            eventsData.forEach(event => {
            const startDate = new Date(event["start_date"]);
            const endDate = new Date(event["end_date"]);
            const endYTimestamp = endDate.getTime() / 1000;
            const startYTimestamp = startDate.getTime() / 1000;
            const currentTimestamp = Date.now() / 1000;
            if (endYTimestamp === startYTimestamp) {
            const scaleFactor = (endY - startY) / 86400;
            const startYDate = startY + (startYTimestamp - currentTimestamp) * scaleFactor;
            const endYDate = startY + (endYTimestamp - currentTimestamp) * scaleFactor;

            ctx.beginPath();
            ctx.moveTo(startX - 10, startYDate);
            ctx.lineTo(startX + 10, startYDate);
            ctx.lineWidth = 2;
            ctx.strokeStyle = 'red'; // Możesz dostosować kolor
            ctx.stroke();
            ctx.closePath();
            } else {
            const scaleFactor = (endY - startY) / (endYTimestamp - startYTimestamp);
            const startYDate = startY + (startYTimestamp - currentTimestamp) * scaleFactor;
            const endYDate = startY + (endYTimestamp - currentTimestamp) * scaleFactor;
    
            ctx.beginPath();
            ctx.moveTo(startX - 10, startYDate);
            ctx.lineTo(startX + 10, startYDate);
            ctx.lineTo(startX + 10, endYDate); // Rysowanie linii do końca zdarzenia
            ctx.lineTo(startX - 10, endYDate); // Zamknięcie odcinka
            ctx.lineWidth = 2;
            ctx.strokeStyle = 'red'; // Możesz dostosować kolor
            ctx.stroke();
            ctx.closePath();

            }
        });
        </script>
        </div>
        </div>
    </body>
</html>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $date1=date_create('2015-06-29');
            $date2=date_create('2015-07-03');
            

            echo $date1->format('m-d-Y');
            echo '<br /><br />';
            $time= date("g:i A", strtotime("22:10:47"));
            echo $time;
            echo '<br /><br />';
            $diffx=date_diff($date1,$date2);
            $diff=$diffx->days;
            $newDate=$date1->format('Y-m-d');
            echo 'This is First Date'.$newDate. "<br />";
            //
            for ($x = 1; $x <= $diff; $x++) {
                $y='+1day';
                $date1->modify($y);
                $newDate=$date1->format('Y-m-d');
                echo 'This is newDate'.$newDate. "<br />";
            }
            echo "<br /><br />Done<br /><br />";
            
            
        ?>
    </body>
</html>

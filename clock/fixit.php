<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        
        <link rel="stylesheet" type="text/css" href="css/formx.css" media="screen" />
        <link rel="stylesheet" href="../pikaday/css/pikaday.css">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>
        <script src="js/clock.js" type="text/javascript"></script>
        <script src="js/time.js" type="text/javascript"></script>
        <script language="JavaScript">
            function selectit(x){
                x=x.trim();
                $("#pType").find("option:contains('"+x+"')").each(function(){
                    if( $(this).text() == x ) {
                        $(this).attr("selected","selected");
                    }
                 });
            }
        </script>
        <title>Fix Punch</title>
    </head>
    <body ondragstart="return false">
        <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
        <?php
            require_once 'clk_functions.php';
            $db_conn=  getDB();
            $record=get_post_var('recnumb');
            $pType=editpunch($db_conn, $record);
        ?>
          <script src="../pikaday/pikaday.js"></script>
        <script>

        var picker = new Pikaday(
        {
            field: document.getElementById('pDayDate'),
            firstDay: 1,
            minDate: new Date(2000, 0, 1),
            maxDate: new Date(2020, 12, 31),
            yearRange: [2000,2020]
        });

        </script>
        <?php
        echo "<script type=\"text/javascript\">selectit('$pType')</script>";
        ?>
    </body>
</html>

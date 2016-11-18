

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/newtable.css" media="screen" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <!-- The Javascript for the time function only works with this version of JQuery 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>
        -->
        <script src="../jquery/jquery.js" type="text/javascript"></script>
        <script src="js/clock.js" type="text/javascript"></script>
        <script src="js/time.js" type="text/javascript"></script>
        <title>Time Card</title>
        <script language="JavaScript">
            function updateFieldDate(x,y, z){
                var i='#colDate'+y+z;
                $(i).html(x);
                var i='#colfOut'+y+z;
                //$(i).html('12:00 PM');
            }
            function updateFieldFIn(x,y, z){
                var i='#colfIn'+y+z;
                $(i).html(x);
            }
            function updateFieldLIn(x,y, z){
                var i='#collIn'+y+z;
                $(i).html(x);
            }
            function updateFieldFOut(x,y, z){
                var i='#colfOut'+y+z;
                $(i).html(x);
            }
            function updateFieldLOut(x,y, z){
                var i='#collOut'+y+z;
                $(i).html(x);
            }
        
            
        </script>
    </head>
    <body>
     <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
    
     <div class="tdGang">    
        <form method="post" id="punchform" name="punchform">
                    <?php
            require_once 'clk_functions.php';
            $db_conn=  getDB();
            showpunch($db_conn, 123);
            
        ?>
        
        </form>
    </div>
        
    </body>
</html>

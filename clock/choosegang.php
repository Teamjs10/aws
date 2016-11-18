

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
        <link rel="stylesheet" href="../pikaday/css/pikaday.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script src="../jquery/jquery.js" type="text/javascript"></script>
        <!-- The Javascript for the time function only works with this version of JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>
        <script src="js/clock.js" type="text/javascript"></script>
        <script src="js/time.js" type="text/javascript"></script>
        <title>Team Punch</title>
        <script language="JavaScript">
            function chooseGang(x){
                switch(x){
                    case 1:
                        $("#gangform").attr('action', 'gangpunch.php');
                        $("#gangform").submit();
                        break;
                    case 2:
                        $("#gangform").attr('action', 'gangpunch.php');
                        $("#gangform").submit();
                        break;
                    case 3:
                        $("#gangform").attr('action', 'gangpunch.php');
                        $("#gangform").submit();
                        break;
                }
                    
            }
        </script>
    </head>
    <body>
         <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
    <div class="tdGang"> 
        <form method="post" id="gangform" name="gangform">
            <table id="box-table-a">
            <thead>
            <tr>
                <th scope="col" colspan="3"><b>Choose</b></th>
            </tr>
            <tbody>
            <tr>
                <td><img id="apply" src="img/manager.png" onclick="chooseGang(1)"></td>
                <td><img id="apply" src="img/employee.png" onclick="chooseGang(2)"></td>
                <td><img id="apply" src="img/department.png" onclick="chooseGang(3)"></td>
            </tr>
            </tbody>
            </table>
        </form>
    </div>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>
        <!-- <script src="../jquery/jquery.js" type="text/javascript"></script>  -->
        <script src="js/clock.js" type="text/javascript"></script>
        <script src="js/time.js" type="text/javascript"></script>
        <title>Team Punch</title>
        <script language="JavaScript">
            function addRow(){
                var rowdata='<tr><td scope="col">&nbsp</td><td scope="col"><input type="text" id="empID"></td><td scope="col"><input type="text" id="fName"></td><td scope="col"><input type="text" id="lName"></td><td scope="col"><input type="text" id="pInx" onchange="timeform(this.id)"></td><td scope="col"><input type="text" id="pOutx" onchange="timeform(this.id)"></td></tr>';
                $(rowdata).appendTo('table');
                
            }
            
        </script>
    </head>
    <body>
        <form>
            <table id="box-table-a">
            <thead>
            <tr>
            <th scope="col">&nbsp;</th>
            <th scope="col">Emp ID</th>
            <th scope="col">FName</th>
            <th scope="col">LName</th>
            <th scope="col">In</th>
            <th scope="col">Out</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="col"><img id="plus" onclick="addRow()" src="img/plus.png"></th>
            <th scope="col"><input type="text" id="empID"></th>
            <th scope="col"><input type="text" id="fName"></th>
            <th scope="col"><input type="text" id="lName"></th>
            <th scope="col"><input type="text" id="pInx" onchange="timeform(this.id)"></th>
            <th scope="col"><input type="text" id="pOutx" onchange="timeform(this.id)"></th>
            </tr>
            
            
        <?php
        // put your code here
        ?>
            </tbody>
            </table>
        </form>
    </body>
</html>

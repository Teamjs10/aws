<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/form.css" media="screen">
        <script src="../jquery/jquery.js" type="text/javascript"></script>
        <title>Clock Record</title>
        <style>
            div.verify {
            background-color: lightgrey;
            width: 500px;
            padding: 25px;
            border: 25px solid navy;
            margin-left: auto;
            margin-right: auto;
            }
        </style>
        <script type="text/javascript">
            function goodClock() {
                //setInterval(function () {toClock()}, 1500);
            }
            function toClock() {   
                location.href = 'index.php';
            }
            
            function myReDirect(){
              //location.href = 'index.php';
           }
           
           </script>
    </head>
    <body onLoad="setTimeout('myReDirect()', 3000)">
         <div class="phead"><div class="inner"><img src="img/sham30.png" ></div></div>
        <?php
           echo "<br /><br /><br /><br />";
            require_once 'clk_functions.php';
            //$pUTime = $_POST['pUTime'];
            //$pTimeActual=$_POST['pTimeActual'];
            $pTime=$_POST['pTime'];
            $txtpunchtype = $_POST['pType'];
            $badge = $_POST['badge'];
            $out_reason='';
            
            if(isset($_POST['reason_id'])){
                $out_reason=$_POST['reason_id'];
            }
            else {
                $out_reason='';

            }
            echo '<br /><br /><br />';
            print_r($_POST);
            echo '<br /><br /><br />This is Out Reason '.$out_reason.'<br /><br />';
                
            echo "Punch Info: ".$pTime." - " .$txtpunchtype."<br />";
            echo "Employee #" .$badge. "<br> Processing Punch......<br />";
            
            //Insert punches into db
            $sql="SELECT empintid, empid FROM employee WHERE badge=".$badge;
            $db_conn=  getDB();
            $stmt = $db_conn->query($sql);
            if ($stmt->rowCount()){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $empintid=$row['empintid'];
                $empid= $row['empid'];
                $query = "INSERT INTO punch(punch_id, badge, empintid, empid, punch_time, punch_type, lastupdate,reason_id) values
                (NULL,?,?,?,UNIX_TIMESTAMP(),?,UNIX_TIMESTAMP(), ?);";
               
                $stmt= $db_conn->prepare($query);
                
                $stmt->execute(array($badge,$empintid,$empid, $txtpunchtype, $out_reason));
                if ($stmt->rowCount()==1){
                        echo '<div class="verify">
                                    <table>
                                    <tr>
                                        <td>Punch Accepted</td>
                                    </tr>
                                    <tr>
                                        <td>Thank you!</td>
                                    </tr>
                                    </table>

                                </div>';
                    echo "<script type=\"text/javascript\">goodClock()</script>";
                }
            }
            else{
                    echo '<div class="verify">
                            <table>
                            <tr>
                                <td>Punch Not Accepted</td>
                            </tr>
                            <tr>
                                <td>Please Verify</td>
                            </tr>
                            <tr>
                                <td>&nbsp</td>
                            </tr>
                            <tr>
                                <td><img id="cancel" src="img/cancel.png" alt="Cancel" onclick="toClock()" /></td>
                            </tr>
                            
                            </table>
                        </div>';
                    
                }
                
            
        ?>
    </body>
</html>

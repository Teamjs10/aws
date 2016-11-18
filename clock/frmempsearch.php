<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
<link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="../jquery/jquery.js" type="text/javascript"></script>
<script src="js/jtrscript.js" type="text/javascript"></script>
<script language="JavaScript">
$(document).ready(function(){
    $("#shamrock").click(function(){
            window.location = "index.php";
        });
});
function whereFrom(x){
        $(document).ready(function(){
    		$("#addup").attr("value",x)
        });

    }

function updateform(x){
        
        $(document).ready(function(){
    		$("#hempid").attr("value",x)
                var y;
                y=$("#fromStartInc").val();
                if (y=="SI"){
                    $("#myHiddenForm").attr('action', 'startinc.php');
                    $("#myHiddenForm").submit();
                }
                else{
                    $("#myHiddenForm").attr('action', 'employee.php');
                    $("#myHiddenForm").submit();
                }
        });

    }   
 </script>
<title>Employee Master Search</title>
    </head>
    <body><br />
    <img align="left" id="shamrock" src="img/home.png" alt="Home" />
    <div align="center"><img src="img/logo.jpg" alt="logo"></div>
    <br />
        <?php
        session_start();
        require_once 'functions.php';
        require_once 'dbset.php';
        $asites=array('employee.php', 'startinc.php');
        refer($_SERVER, $asites);
        if(isset($_POST['locationID'])){
            $_SESSION["locationID"]= vNumeric($_POST['locationID'], 'Location ID');
        } 
        $empintid=""; //not know when search is loaded
        $employeeid="";
        $txtfname="";
        $txtlname="";
        $addup="";
        $sql_start = "SELECT * FROM employee WHERE ";
        
        if (trim($_POST['addup'])<>""){
            switch ($_POST['addup']) {
                case "A":
                case "B":
                    echo "<script type=\"text/javascript\">whereFrom('".$addup."')</script>";
                    break;
                default:
                    exit('<p class="sInstructions">Invalid Add Update Code - Call Support</p>');
                    break;
            }    
        };
        if (trim($_POST['employeeid'])<>""){
            $employeeid= checkOthers($_POST['employeeid'], 'Employee ID');
            $sql_start .= "empid LIKE '".$employeeid."%' OR ";
        }    
        if (trim($_POST['txtfname'])<>""){
            $txtfname=  checkNames($_POST['txtfname'],'First Name');
            $sql_start .= "empfname LIKE '".$txtfname."%' OR ";
        };
        if (trim($_POST['txtlname'])<>""){
            $txtlname=  checkNames($_POST['txtlname'],'Last Name');
            $sql_start .= "emplname LIKE '".$txtlname."%' OR ";
        };
        $sql = rtrim($sql_start," OR ");
        $db_conn=  getDB();
            $stmt = $db_conn->query($sql);
            if ($stmt->rowCount()){
                echo "<p class='sInstructions'>Searching...<br /><br />";
                echo $stmt->rowCount() . " items found</p>";
                echo '<form action="" method="post" id="empsearch" name="empsearch">';
                //Start Building Results Table
                echo '<table id="box-table-a">';
                echo '<thead>
                <tr>
                <th scope="col">Select</th>
                <th hidden="true" scope="col">Emp Int ID</th>
                <th scope="col">Emp ID</th>
                <th scope="col">Fname</th>
                <th scope="col">Lname</th>
                </tr>
                </thead>
                <tbody>';
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo '<td><input type="radio" id="radiox" name="select" onClick= "updateform('.$row["empintid"].')" value="'.$row['empintid'].'" />'.
                    "<td hidden='true'>".$row['empintid']."</td><td>" . $row['empid']. "</td><td>". $row['empfname']. "</td><td> ". $row['emplname']."</td></tr>";
                }
                echo "</tbody></table>";
                echo '</form>';
            }

            else {
                echo "No Matches Found - Try Again";
            }
            
        ?>
            <form action="" method="post" name="myHiddenForm" id="myHiddenForm">
                <input type="hidden" id="addup" name="addup" />
                <input type="hidden" id ="hempid" name="hempid" />
                <input style="visibility: hidden"   name="fromStartInc" id="fromStartInc" size="5" maxlength="5" tabindex="1" type="text" />
            </form>
    <?php
      fromStartInc();
    ?>
    </body>
</html>


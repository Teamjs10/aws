<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Employee Update</title>
    </head>
    <body>
        <?php
            require_once 'functions.php';
            $intempclkid = $_POST['intempclkid'];
            $txtempfname = $_POST['txtempfname'];
            $txtemplname = $_POST['txtemplname'];
            $intsupvid = $_POST['intsupvid'];
            $bolactive = $_POST['bolactive'];
            $dateempdeactive=$_POST['dateempdeactive'];
            $intemptimezone = $_POST['intemptimezone'];
            echo "Employee Clock ID: " .$intempclkid."<br />";
            echo "Employee Name: " .$txtempfname." ".$txtemplname . " <br />Processing Update......<br />";

            //Insert punches into db
            $db = new mysqli('localhost', 'root', '','clock');
            $bolok = validEmployee($db,$intempclkid);
            if ($bolok){
              $update="INSERT INTO tblemployee (intempid, intempclkid, txtempfname, txtemplname, intsupvid,
                  bolempactive, dateempdeactive, intemptimezone)
                  VALUES (NULL, '".$intempclkid."','".$txtempfname."','".$txtemplname.
                "','".$intsupvid."','".$bolactive."','".$dateempdeactive."','".$intemptimezone."');";
             $updatedb = $db->query($update);
             $db->close();
             echo "Update Successful";
            }
            else
            {
                echo "Update Failed";
            }
        ?>
    </body>
</html>

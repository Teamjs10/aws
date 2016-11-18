<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
<link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="../jquery/jquery.js" type="text/javascript"></script>
<script src="js/clock.js" type="text/javascript"></script>
<script language="JavaScript">
    function editpunch(x){
        $("#recnumb").attr("value", x);
        $("#fixpunch").attr('action', 'fixit.php');
        $("#fixpunch").submit();
    }
 </script>
<title>View Punches</title>
    </head>
    <body ondragstart="return false">
       
        
        <?php
        require_once 'clk_functions.php';
        
        //$asites=array('employee.php', 'startinc.php');
        //refer($_SERVER, $asites); 
        if (isset($_POST['intempclkid'])){
            $badge=$_POST['intempclkid'];
        }           
        $db_conn=  getDB();
        fixpunch($db_conn, $badge);
        ?>
        </tbody></table>
<input style="display:none" id="recnumb" name="recnumb" />
</form>';        

    </body>
</html>


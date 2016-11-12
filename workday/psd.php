<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
<link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="../jquery/jquery.js" type="text/javascript"></script>
<script language="JavaScript">

 </script>
<title>View Punches</title>
    </head>
    <body><br />
    
    <br />
        <?php
        require_once 'clk_functions.php';
            
        $db_conn=  getDB();
        $sql="SELECT emp_id, hours_date, hours, hour_type, company, time_position 
        from time_blocks";        
        $results = $db_conn->query($sql);
        $tothours=0;
        $OT=0;
        $GMS=0;
        $GPS=0;
        while($row = $results->fetch(PDO::FETCH_ASSOC)) {
            
            if($row['company']=='GMS'){
                    $GMS=$GMS+ $row['hours'];
                
            }
            else{
                
                    $GPS=$GPS+ $row['hours'];
            }
               
            $emp_id=$row['emp_id'];
            $tothours=$tothours + $row['hours'];
            if($row['hour_type']=='Overtime'){
                $OT=$OT+ $row['hours'];
            }
        }
        $allocation=$OT/$tothours;
        $allocation=  round($allocation, 3);
        $GMS_OT=$GMS * $allocation;
        $GPS_OT=$GPS * $allocation;
        echo 'This is total hours- '.$tothours.'<br />';
        echo 'This is OT hours- '.$OT.'<br />';
        echo 'alloocation is - '.$allocation.'<br />';
        echo 'This is GMS - '.$GMS.'<br />';
        echo 'This is GPS - '.$GPS.'<br />';
        echo 'This is GMS allocated OT - '.$GMS_OT.'<br />';
        echo 'This is GPS allocated OT - '.$GPS_OT.'<br />';
        echo 'This is all OT - '.round(($GMS_OT + $GPS_OT), 2);
        echo '<br />This is all Time - '.(0.184*60);
         echo '<br />This is all Time - '.(0.82*60);
        ?>
                

    </body>
</html>
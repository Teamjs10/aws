<?php
function lastpunch2($db_conn, $lbadge){
    $sql=" SELECT UNIX_TIMESTAMP( ) AS nowTime, e.empintid,e.empid, e.badge, FROM_UNIXTIME( punch_time,  '%Y-%m-%d' ) AS pdate, FROM_UNIXTIME( punch_time,  '%H:%i:%s' ) AS pTime,
    punch_type, punch_time
    FROM employee e
    left join punch  p
    on e.empintid = p.empintid
    WHERE e.badge='".$lbadge."'
    ORDER BY  p.punch_time DESC 
    LIMIT 1 ";
    $results = $db_conn->query($sql);
    //If there is a valid badge # this will be true, if not else will be called
    //is_null checks if no records exist but badge/id is valid
    if ($results->rowCount()){
         $row = $results->fetch(PDO::FETCH_ASSOC);
         
         if(is_null($row['pdate'])){
             //no previous punch
         	echo '<br /><br /><br />Got Here';
                return "No";
		 }
        else{
               return "Yes";
       }
	}//end Rowcount If
    //else is called because rowcount = 0, thus an invalid badge#
    else{
            echo '<div class="verify">
           <table>
               <tr>
               <td colspan="2" align="center">Not a valid Badge #'.$lbadge.'</td> 
               </tr>
               <tr>
               <td colspan="2" align="center">&nbsp;</td> 
               </tr>
               <tr>
               <td colspan="2" align="center">Please verify</td> 
               </tr>
               </table>
               </div>';
            echo "<script type=\"text/javascript\">goodClock()</script>";
           return "Invalid";
}
}
function repunch2($nowtime, $punch_time, $pDate, $time, $punch_type){
        $repunch_diff=($nowtime - $punch_time)/60;
        if($repunch_diff<3){
		echo '<div class="verify">
		<table>
			<tr>
			<td colspan="2" align="center">Repunch Restriction</td> 
			</tr>
			<tr>
			<td colspan="2" align="center">&nbsp;</td> 
			</tr>
			<tr>
			<td colspan="2" align="center">Last Punch was less than 3 minutes ago</td> 
			</tr>
			</table>
			</div>';
                echo "<script type=\"text/javascript\">goodClock()</script>";
		return "Yes";
	}
	else{
		return "No";
	}
}
<?php
            function getDB() {
            try{
                    $db_conn= new PDO('mysql:host=localhost;dbname=clock','root', 'Eyerish1!');
                    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $db_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    }
            catch(PDOException $ex) {
            echo "An Error occured!<br />"; //user friendly message
            echo $ex->getMessage();
            exit();
         }
         return $db_conn;
}

             function xferlist($db_conn, $transfer, $level) {
		$sql = "SELECT locID, locName, loclevel FROM location where loclevel=".$level." AND locName LIKE '".$transfer."%'";
		$stmt = $db_conn->query($sql);
               if ($stmt->rowCount()){
                $l=$level-1;
                $x=0;
                //Start Building Results Table
                echo '<form>';
                echo '<table id="box-table-a">';
                echo '<thead><tr><th>&nbsp</th><th scope="col">Select</th><th hidden="true" scope="col">Loc Int ID</th><th scope="col">Location</th>
                </tr><tr><th scope="col">&nbsp</th>
                <th><img class="Clear" src="img/clear_1.png" onclick="Clear('.$l.')"/></th>
                <th hidden="true" scope="col">Loc Int ID</th>
                <th scope="col"><input class="selID" style="display:none" type="text"><input class="selValue" type="text"></th>
                </tr></thead><tbody>';
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    $details = $row['loclevel']."|".$row['locID']."|".$row['locName'];
                    echo "<td><input hidden='true' class='itemSearch' id='radiox' name='select' value='".$details."' /></td><td><img class='Selected' /><img class='itemImg' id='Select' alt='Search' onclick='itemSelect(".$x.",".$l.")' />".
                            "<td>". $row['locName']. "</td></tr>";
                    $x++;
                }
                echo "</tbody></table></form>";
            }
            
}
             function vpunch($db_conn, $transfer, $level) {
		$sql = "SELECT locID, locName, loclevel FROM location where loclevel=".$level." AND locName LIKE '".$transfer."%'";
		$stmt = $db_conn->query($sql);
               if ($stmt->rowCount()){
                $l=$level-1;
                $x=0;
                //echo $stmt->rowCount() . " items found</p>";
                
                //Start Building Results Table
                echo '<form>';
                echo '<table id="box-table-a">';
                echo '<thead>
                <tr>
                <th>&nbsp</th>
                <th scope="col">Select</th>
                <th hidden="true" scope="col">Loc Int ID</th>
                <th scope="col">Location</th>
                </tr>
                <tr>
                <th scope="col">&nbsp</th>
                <th><img class="Clear" src="img/clear_1.png" onclick="Clear('.$l.')"/></th>
                <th hidden="true" scope="col">Loc Int ID</th>
                <th scope="col"><input class="selID" style="display:none" type="text"><input class="selValue" type="text"></th>
                </tr>
                </thead>
                <tbody>';
                
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    $details = $row['loclevel']."|".$row['locID']."|".$row['locName'];
                    echo "<td><input hidden='true' class='itemSearch' id='radiox' name='select' value='".$details."' /></td><td><img class='Selected' /><img class='itemImg' id='Select' alt='Search' onclick='itemSelect(".$x.",".$l.")' />".
                            "<td>". $row['locName']. "</td></tr>";
                    $x++;
                }
                echo "</tbody></table>";
                echo '</form>';
            }
            
}
//********************* pHistory is updated
function pHistory($db_conn, $badge){
    $week_now = date('m/d/Y', time());
    $startweek='';
    $d=  strtotime($week_now);
    $day = date('w', $d);

    if ($day<>0){
            $startweek=$d-($day*86400);
    }
    else{
            $startweek=$d;
    }
    //if you need last week - use (-604800)
    $sql="SELECT punch_time, punch_type, dept_trans, punch_source, 
    FROM_UNIXTIME(lastupdate,'%Y-%m-%d') as pdate, 
    FROM_UNIXTIME(lastupdate,'%H:%i:%s') as pTime 
    from punch 
    WHERE badge='".$badge."' AND punch_time >".$startweek ." ORDER BY lastupdate DESC LIMIT 10";        
    $results = $db_conn->query($sql);
    echo '<form>';
    echo '<table id="box-table-a">';
    echo '<thead>
    <tr>
    <th scope="col">Date</th>
    <th scope="col">Time</th>
    <th scope="col">Type</th>
    </tr>
    </thead>
    <tbody>';                 
    while($row = $results->fetch(PDO::FETCH_ASSOC)) {
        //$details = $row['punch_type']."|".$row['pdate']."|".$row['pTime'];
        $date1=date_create($row['pdate']);
        $pDate=$date1->format('m-d-Y');
        $time= date("h:i:s A", strtotime($row['pTime']));
        echo "<tr>";
        echo "<td>".$pDate."</td><td>".$time."</td><td>". $row['punch_type']. "</td></tr>";
        }
        echo '<tr><td><img src="img/clear_1.png" alt="Clear" onclick="goHome()" /></td><td>'
                . '&nbsp</td><td>&nbsp</td></tr>';        
        echo '</tbody></table></form>';
}
function empNamePunch($db_conn, $lbadge){
    $sql='SELECT  empintid ,  empid ,  badge ,  empFirst ,  empLast ,  empDept ,  empManager 
    FROM  employee 
    WHERE badge =' .$lbadge; 
    $results = $db_conn->query($sql);
    $row = $results->fetch(PDO::FETCH_ASSOC);
    $name=$row['empFirst']. ' '. $row['empLast'];
    echo "<script type=\"text/javascript\">loadName('".$name."')</script>";
}
function test_return($z){
    $x=array("this", "that");
    $vari=array(1,2,$x );
    return $vari;    
}
function lastpunch($db_conn, $lbadge, $t){
    //$t represets - True, it did come from the Verify Out page
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
             if($t=='t'){
                 punchverify_out();
             }
             else{
                 punchverify();
             }
             
             lastpunch_table("N/A", "N/A","N/A");
         }
         else{
                //repunch function will call punch verify info
                $date1=date_create($row['pdate']);
                $pDate=$date1->format('m-d-Y');
                $time= date("h:i:s A", strtotime($row['pTime']));
                repunch($row['nowTime'], $row['punch_time'], $pDate, $time, $row['punch_type'], $t);
            }
    }  //end Rowcount If
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
    }
}
function lastpunch_table($pdate, $punchtime,$punchtype){
    echo '<div class="verify" id="last_punch_table_div">
        <table id="last_punch_table" name="last_punch_table">
            <tr>
            <td colspan="2" align="center">Last Punch Info:</td> 
            </tr>
            <tr><td colspan="2"></td></tr>
            <tr><td colspan="2">
            <label for="lDayDate">Date:</label>
                        <input type="text" name="lDayDate" id="lDayDate" size="20" maxlength="11" tabindex="1" value="'.$pdate.'" readonly/>
                </td>
            </tr>
        <tr>
            <td colspan="2"><label for="lTime">Punch Time:</label><input name="lTime" id="lTime" value="'.$punchtime.'" readonly></td>
        </tr>
        <tr>
            <td colspan="2"><label for="lType">Punch Type:</label><input name="lType" id="lastpType" value="'.$punchtype.'" readonly></td>
        </tr>
        
        </table>
       
    </div>';
}
function repunch($nowtime, $punch_time, $pDate, $time, $punch_type, $t){
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
	}
        else{
            if($t=='t'){
                 punchverify_out();
             }
             else{
                 punchverify();
             }
         }
        lastpunch_table($pDate, $time,$punch_type);
}
function punchverify(){
    echo'
    <form id="frmVerify" name="frmVerify" action="" method="post">
        <div class="verify">
        <table id="verify_punch_table" name="verify_punch_table">
            <tr><td>
            <label for="pDayDate">Date:</label>
                <input type="text" name="pDayDate" id="pDayDate" size="20" maxlength="11" tabindex="1" />
                </td>       </tr>
        <tr>
            <td colspan="2"><label for="badge">Badge #:</label><input name="badge" id="badge" readonly></td>
        </tr>
        <tr>
            <td colspan="2"><label for="pName">Name:</label><input name="pName" id="pName" readonly></td>
        </tr>
        <tr>
            <td colspan="2"><label for="pTime">Punch Time:</label><input name="pTime" id="pTime" readonly></td>
        </tr>
        <tr>
            <td colspan="2"><label for="pType">Punch Type:</label><input name="pType" id="pType" readonly></td>
        </tr>
        <tr class="hTransfer" style="display: none">
            <td colspan="2"><label for="pTransfer1">Transfer 1:</label><input name="pTransfer1" id="pTransfer1" readonly></td>
        </tr>
        <tr class="hTransfer" style="display: none">
            <td colspan="2"><label for="pTransfer2">Transfer 2:</label><input name="pTransfer2" id="pTransfer2" readonly></td>
        </tr>
        <tr>
            <td style="display: none"><input name="pUTime" id="pUTime" readonly></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><img src="img/submit.png" alt="Submit" onclick="submitPunch()" />
            <img id="cancel" src="img/cancel.png" alt="Cancel" onclick="goHome()" /></td>
            <td>&nbsp;</td>
        </tr>
        
        </table>
    <input style="display: none" name="xferid1" id="xferid1">
    <input style="display: none" name="xferid2" id="xferid2">
    </div>
</form>';
}
function punchverify_out(){
        echo'
    <form id="frmVerify" name="frmVerify" action="" method="post">
        <div class="verify">
        <table id="verify_punch_table" name="verify_punch_table">
            <tr><td>
            <label for="pDayDate">Date:</label>
                <input type="text" name="pDayDate" id="pDayDate" size="20" maxlength="11" tabindex="1" />
                </td>       </tr>
        <tr>
            <td colspan="2"><label for="badge">Badge #:</label><input name="badge" id="badge" readonly></td>
        </tr>
        <tr>
            <td colspan="2"><label for="pName">Name:</label><input name="pName" id="pName" readonly></td>
        </tr>
        <tr>
            <td colspan="2"><label for="pTime">Punch Time:</label><input name="pTime" id="pTime" readonly></td>
        </tr>
        <tr>
            <td colspan="2"><label for="pType">Punch Type:</label><input name="pType" id="pType" readonly></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp</td>
        </tr>
        <tr class="final_punch">
            <td colspan="2">Is this your <b><i>Final Punch</i></b> of your day/work shift?</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp</td>
        </tr>
        <tr class="final_punch">
            <td><img src="img/yes_red_1.png" alt="Yes" onclick="submitPunch(1)" />
            <img id="cancel" src="img/no_red_1.png" alt="Cancel" onclick="submitPunch(2)" /></td>
        </tr>
        <tr class="submit_punch" style="display:none">
            <td><img src="img/submit.png" alt="Submit" onclick="submitPunch(2)" />
            </td>
    
        </tr>
        </table>
        	</div>
		</form>';
}
function fixpunch($db_conn, $badge){
    $sql="SELECT punch_id, punch_time, punch_type, dept_trans, punch_source, 
    FROM_UNIXTIME(punch_time,'%Y-%m-%d') as pdate, 
    FROM_UNIXTIME(punch_time,'%H:%i:%s') as pTime 
    from punch 
    WHERE badge='".$badge."'
    ORDER BY lastupdate DESC";        
    //Need something in here that limits to today and last week
    $results = $db_conn->query($sql);
    echo '<form action="" method="post" id="fixpunch" name="fixpunch">';
    echo '<div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>';
    echo '<table id="box-table-a">';
    echo '<thead>
    <tr>
    <th scope="col">&nbsp</th>
    <th scope="col">Date</th>
    <th scope="col">Time</th>
    <th scope="col">Type</th>
    </tr>
    </thead>
    <tbody>';
    $x=0;
    while($row = $results->fetch(PDO::FETCH_ASSOC)) {
        //$details = $row['punch_type']."|".$row['pdate']."|".$row['pTime'];
        $date1=date_create($row['pdate']);
        $pDate=$date1->format('m-d-Y');
        $time= date("h:i:s A", strtotime($row['pTime']));
        echo "<tr>";
        echo "<td><img class='itemImg' src='img/select.png' id='Select".$x."' alt='Select' onclick='editpunch(".$row['punch_id'].")' />";
	echo "<td>".$pDate."</td><td>".$time."</td><td>". $row['punch_type']. "</td></tr>";
        }        
        
}
function showpunch($db_conn, $badge){
    //From here to the next note is OK - Just sets up items
    $sql="SELECT badge_id, punch_id, punch_time, punch_type, dept_trans, punch_source, 
    FROM_UNIXTIME(punch_time,'%Y-%m-%d') as pdate, 
    FROM_UNIXTIME(punch_time,'%H:%i:%s') as pTime,
    punch_time
    from punch_test
    WHERE badge_id='".$badge."'
    ORDER BY punch_time";        
    //
    $results = $db_conn->query($sql);
    echo '<div class="table-title">
    <h3>Time Card</h3>
    </div>
    <table class="table-fill">
    <thead>
    <tr>
    <th class="text-left">Date</th>
    <th class="text-left">In</th>
    <th class="text-left">Out</th>
    <th class="text-left">In</th>
    <th class="text-left">Out</th>
    </tr>
    </thead>
    <tbody class="table-hover">';
    $row_no=1; //Count number of distinct employee data rows before a change if more than 4 punches
    $x=1;
    $badge_no='';
    $current_date='';
    $previous_badge='';
    $badge=array();
    $columns=0;
    //End verified section
    while($row = $results->fetch(PDO::FETCH_ASSOC)) {
        //Format Date related items
        $badge_no=$row['badge_id'];
        $date1=date_create($row['pdate']);
        $pDate=$date1->format('m-d-Y');
        $time= date("h:i:s A", strtotime($row['pTime']));
        //end format - we now have the variables $pDate = M/D/Y and $time = Hours / Minutes / Seconds
        //
        //Set Up current date - this should only be run once
        if($current_date==''){
            $current_date=$pDate;
        }
        //Set Up current badge - this should only be run once
        if($previous_badge==''){
            $previous_badge=$badge_no;
        }
        //
        //**** MAIN LOGIC ****
        //
        if($previous_badge<>$badge_no){
            $previous_badge=$badge_no;
            writeTableRow($badge_no, $row_no);
            writeTableData($badge, $row_no);
            $badge=resetArray($badge);
            $row_no=0;
            $columns=0;
            //array_push($badge, array($badge_no, $row['punch_id'], $pDate, $time, $row['punch_type']));
            //$columns=$columns+1;
        }
        
        if($current_date<>$pDate){
            //NEED TO TAKE THIS OUT - For Testing
            $current_date=$pDate;
            $date = DateTime::createFromFormat('m-d-Y', $current_date);
            $nextdate=$date->modify('+1 day')->format('m-d-Y');
            writeTableRow($badge_no, $row_no);
            writeTableData($badge, $row_no);
            $badge=resetArray($badge);
            $row_no=$row_no+1;
            $columns=0;
            //array_push($badge, array($badge_no, $row['punch_id'], $pDate, $time, $row['punch_type']));
            //$columns=$columns+1;
            /*
            if($nextdate==$pDate){
            
                echo 'Need Day divide logic here<br />';
                writeTableRow($badge_no, $row_no);
                writeTableData($badge, $row_no);
                $badge=resetArray($badge);
                $current_date=$pDate;
                $row_no=$row_no+1;
        
            }
            else{
                echo '<br /><br />Current Date Else Called<br /><br />';
                //Write a row of the table with ID of Row= Badge#
                writeTableRow($badge_no, $row_no);
                writeTableData($badge, $row_no);
                $badge=resetArray($badge);
                echo '<br />resetArray results<br />';
                //print_r($badge);
                $current_date=$pDate;
                $row_no=$row_no+1;
            }
             */ 
             
        } // End Date Function
         
        if($columns<=3){
          array_push($badge, array($badge_no, $row['punch_id'], $pDate, $time, $row['punch_type']));
          $columns=$columns+1;  
        }
        elseif($columns==4){
        
            echo '<br /><br />columns 4 called<br /><br />';
            print_r($badge);
            writeTableRow($badge_no, $row_no);
            writeTableData($badge, $row_no);
            $badge=resetArray($badge);
            $row_no=$row_no+1;
            $columns=0;
            array_push($badge, array($badge_no, $row['punch_id'], $pDate, $time, $row['punch_type']));
            $columns=$columns+1;
        
        }       
        }  // End While loop
        if(!empty($badge)){
            writeTableRow($badge_no, $row_no);
            writeTableData($badge, $row_no);
            $badge=resetArray($badge);
        }
        
}
function writeTableRow($B, $row_no){

    echo '<tr>
    <td id="colDate'.$B.$row_no.'" class="text-left"></td>
    <td id="colfIn'.$B.$row_no.'" class="text-left"></td>
    <td id="colfOut'.$B.$row_no.'" class="text-left"></td>
    <td id="collIn'.$B.$row_no.'" class="text-left"></td>
    <td id="collOut'.$B.$row_no.'" class="text-left"></td>
    </tr>';
}
function writeTableData($badge, $row_no){
    
    $size=  count($badge)-1;
    $c=1;
    $c_out=1;
    echo "<script type=\"text/javascript\">updateFieldDate('". $badge[0][2] ."','".$badge[0][0]."','".$row_no." ')</script>";
    for ($x = 0; $x <= $size; $x++){
        //array_push($badge, array($B, $row['punch_id'], $pDate, $time, $row['punch_type']));
        switch ($badge[$x][4]) {
            
            case 'In':
                
                if($c==1){
                    echo "<script type=\"text/javascript\">updateFieldFIn('".$badge[$x][3]."','".$badge[$x][0]."','".$row_no." ')</script>";
                    $c=3;
                }
                
                else{
                        echo "<script type=\"text/javascript\">updateFieldLIn('".$badge[$x][3]."','".$badge[$x][0]."','".$row_no." ')</script>";
                    $c=1;
                }
                
                break;
            case 'Out':
                
                if($c_out==1){
                    echo "<script type=\"text/javascript\">updateFieldFOut('".$badge[$x][3]."','".$badge[$x][0]."','".$row_no." ')</script>";
                    $c_out=3;
                }    
                else{
                    echo "<script type=\"text/javascript\">updateFieldLOut('".$badge[$x][3]."','".$badge[$x][0]."','".$row_no." ')</script>";
                    $c_out=1;
                }
                break;    

            default:
                echo 'Default';
                break;
        }
    }
}
function resetArray($badge){
    unset($badge);
    $badge = array(); 
    return $badge;
}
function editpunch($db, $x){
    $sql='SELECT p.punch_id, p.badge_id, p.emp_id, p.punch_time, p.punch_type, p.dept_trans, p.punch_source, p.lastupdate, 
    FROM_UNIXTIME(p.lastupdate,"%m-%d-%Y") as pDate, 
    FROM_UNIXTIME(p.lastupdate,"%H:%i") as pTime,
    e.empFirst, e.empLast
    FROM punch as p 
    INNER JOIN employee as e
    on p.emp_id=e.empid
    WHERE punch_id='.$x;
    $results = $db->query($sql);
    if ($results->rowCount()){
        $row=$results->fetch(PDO::FETCH_ASSOC);
    }
    echo '<form class="styleform" action="" method="post" id="fixit" name="fixit">
    <h1>Fix Punch</h1>
    <table>
    <tbody>
    <tr>

        <td><div><label for="empid">Emp id:</label>
    <input class="field required" name="empid" id="empid" size="25" maxlength="25" tabindex="2" type="text" value="'.$row['emp_id'].'" readonly>
            </div></td>
        <td><div><label for="empid">Emp Name:</label>
    <input class="field required" name="empName" id="empName" size="25" maxlength="50" tabindex="2" type="text" value="'.$row['empLast'].', '.$row['empFirst'].'" readonly>
            </div></td>
    </tr>
    <tr>
    <td><div><label for="pDayDate">Punch Date:</label>
    <input class="field required" name="pDayDate" id="pDayDate" size="25" maxlength="25" tabindex="2" type="text" value="'.$row['pDate'].'" >
            </div></td>
    <td><div><label for="badgeid">Badge #:</label>
    <input class="field required" name="badgeid" id="badgeid" size="25" maxlength="25" tabindex="2" type="text" value="'.$row['badge_id'].'" readonly>
    </div>
    </td>
    <td>&nbsp</td>
    </tr>
    <tr>

        <td><div><label for="pTime">Punch Time:</label>
    <input class="field required" name="pTime" id="pTime" size="25" maxlength="25" tabindex="2" type="text" onchange="timeform(this.id)" value="'.$row['pTime'].'">
            </div></td>
            <td>&nbsp</td>
    </tr>
    <tr>

        <td><div><label for="pType">Punch Type:</label>
        <select name="pType" id="pType">
            <option value="In">In</option>
            <option value="Out">Out</option>
            <option value="Meal">Meal</option>
            <option value="Break">Break</option>
            <option value="Transfer">Transfer</option>
        </select>
            </div></td>
            <td>&nbsp</td>
    </tr>
    <tr>
        <td ><div><label for="pComment">Comment:</label>
        <textarea rows="4" cols="50" name="pComment" id="pComment"></textarea> 
            </div><td>&nbsp</td></td>
    </tr>
    </tbody>
    </table>
    </form>';
    return $row['punch_type'];
    
    
}
function empGang($db_conn, $empManager) {
    $sql = "SELECT empintid, badge, empFirst, empLast, empDept FROM employee WHERE empManager='".$empManager."'";
    $stmt = $db_conn->query($sql);
    if ($stmt->rowCount()){
    //Start Building Results Table
    $x=0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr class='pRow'><td>&nbsp</td><td><img class='Selected' id='imgSelected".$x."' onclick='deselect(".$x.")' /><img class='itemImg' src='img/select.png' id='Select' alt='Select' onclick='itemSelect(".$x.")' />"
            . "</td><td><input type='text' style='display: none' id='badge".$x."' value='".$row['badge']."'>". $row['badge']. "</td><td>". $row['empFirst']. "</td><td>". $row['empLast']. "</td><td>". $row['empDept']. "</td>"
            . "<td><input type='text' data-hash='".$x."' class='hIn' id='hIn".$x."'></td>"
            . "<td><input type='text' class='hOut' id='hOut".$x."'></td></tr>";
            $x++;
    } 
    }
}
function get_post_var($var)
{
	$val = $_POST[$var];
	if (get_magic_quotes_gpc())
		$val = stripslashes($val);
	return $val;
}
function checksession(){
            if(isset($_SESSION['favcolor'])){
                if($_SESSION['favcolor']=='green'){
		
                }
                else{
                    header('Location: http://UbX200/clock/login.html');
                }
            }
            else{
                header('Location: http://UbX200/clock/login.html');
            }
}

function getClientIP() {

            if (isset($_SERVER)) {

                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                    return $_SERVER["HTTP_X_FORWARDED_FOR"];

                if (isset($_SERVER["HTTP_CLIENT_IP"]))
                    return $_SERVER["HTTP_CLIENT_IP"];

                return $_SERVER["REMOTE_ADDR"];
            }

            if (getenv('HTTP_X_FORWARDED_FOR'))
                return getenv('HTTP_X_FORWARDED_FOR');

            if (getenv('HTTP_CLIENT_IP'))
                return getenv('HTTP_CLIENT_IP');

            return getenv('REMOTE_ADDR');
        }

?>

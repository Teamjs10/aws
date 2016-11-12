<?php
            function getDB() {
            try{
                    $db_conn= new PDO('mysql:host=localhost;dbname=psd','root', 'Eyerish1!');
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
    
    $sql="SELECT punch_time, punch_type, dept_trans, punch_source, 
    FROM_UNIXTIME(lastupdate,'%Y-%m-%d') as pdate, 
    FROM_UNIXTIME(lastupdate,'%H:%i:%s') as pTime 
    from punch 
    WHERE badge_id='".$badge."'
    ORDER BY lastupdate DESC";        
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
function lastpunch($db_conn, $lbadge){
    $sql="SELECT  badge_id,  FROM_UNIXTIME(punch_time,'%Y-%m-%d') as pdate, 
    FROM_UNIXTIME(punch_time,'%H:%i:%s') as pTime ,  punch_type FROM  punch 
    WHERE badge_id='".$lbadge."'
    ORDER BY punch_time DESC LIMIT 1";
    $results = $db_conn->query($sql);
    $row = $results->fetch(PDO::FETCH_ASSOC);
    $date1=date_create($row['pdate']);
    $pDate=$date1->format('m-d-Y');
    $time= date("h:i:s A", strtotime($row['pTime']));
     echo '<div class="verify">
        <table>
            <tr>
            <td colspan="2" align="center">Last Punch Info:</td> 
            </tr>
            <tr><td colspan="2"></td></tr>
            <tr><td colspan="2">
            <label for="lDayDate">Date:</label>
                <input type="text" name="lDayDate" id="lDayDate" size="20" maxlength="11" tabindex="1" value="'.$pDate.'" readonly/>
                </td>
            </tr>
        <tr>
            <td colspan="2"><label for="lTime">Punch Time:</label><input name="lTime" id="lTime" value="'.$time.'" readonly></td>
        </tr>
        <tr>
            <td colspan="2"><label for="lType">Punch Type:</label><input name="lType" id="pType" value="'.$row['punch_type'].'" readonly></td>
        </tr>
        
        </table>
    </div>';
}
function fixpunch($db_conn, $badge){
    $sql="SELECT punch_id, punch_time, punch_type, dept_trans, punch_source, 
    FROM_UNIXTIME(punch_time,'%Y-%m-%d') as pdate, 
    FROM_UNIXTIME(punch_time,'%H:%i:%s') as pTime 
    from punch 
    WHERE badge_id='".$badge."'
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
                    header('Location: http://192.168.1.241/clock/login.html');
                }
            }
            else{
                header('Location: http://192.168.1.241/clock/login.html');
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

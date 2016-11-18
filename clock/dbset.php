
<?php
            
            //echo 'Start<br /><br />';
            $sql="SELECT punch_time, punch_type, dept_trans, punch_source, 
                FROM_UNIXTIME(lastupdate,'%Y-%m-%d') as pdate, 
                FROM_UNIXTIME(lastupdate,'%H:%i:%s') as pTime 
                from punch 
                WHERE emp_id='123'
                ORDER BY lastupdate";
            
                    $db_conn= new PDO('mysql:host=localhost;dbname=clock','root', '');
                    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $db_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $results = $db_conn->query($sql);
                     
            while($row = $results->fetch(PDO::FETCH_ASSOC)) {
                    
                    $details = $row['punch_type']."|".$row['pdate']."|".$row['pTime'];
                    echo $details . "<br />";
                }
?>
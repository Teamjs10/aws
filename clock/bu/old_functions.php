<?php

            function validID($db,$intempclkid, $txtpunchtype ) {
            //The following validates that this is a real employee
            $valid = "SELECT empid FROM employee where badge ='". $intempclkid."'";
            $results = $db->query($valid);
            $numrows= $results->num_rows;
             if ($numrows<1){
                echo "Error - Invalid Badge ID<br />";
                echo "<b>Please contact supv!<br />";
                //Insert Bad Ounch Now
                //How do I check if there are errors here?
                $query = "INSERT into punch(badgeid, txtclktype) values
                ('".$intempclkid."','".$txtpunchtype."')";
                 $results = $db->query($query);
                //Need to figure out how this works when it is an insert statment
                //$numrows= $results->num_rows;
                //if ($numrows<1){
                //     echo " - Audit Error";
                exit;
                 }
            $row=$results->fetch_assoc();
            $intempid=$row['intempid'];

            return $intempid;
             }
             //This function is used to make sure EmpID has not been used
             function validEmployee($db, $employeeid) {
                $used = "SELECT employeeid FROM employee where employeeid ='". $employeeid."'";
                $result = mysql_query($used);
                $numrows= mysql_num_rows($result);
                if ($numrows>0){
                    echo "Error - Invalid Employee ID<br />";
                    echo "<b>Already in use!<br />";
                    return $bolok = "0";
                    }
                else
                {
                    return $bolok = "1";
                }
             }
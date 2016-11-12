<?php
$fPunch=$_POST['fPunch'];
$lPunch=$_POST['lPunch'];
$DST=0;
if(isset($_POST['DST'])){
    $DST=1;
}

$date1=date_create($fPunch);
$date2=date_create($lPunch);
$diffx=date_diff($date1,$date2);
$diff=$diffx->days;
$employees = array
(
array("21309", "15:00", "19:00", "20:00", "24:00", "6"),
array("21114", "08:00", "12:00", "13:00", "17:00", "6"),
array("21118", "15:00", "19:00", "20:00", "24:00", "8"),
array("21191", "24:00", "04:00", "05:00", "09:00", "8"),
array("21243", "08:00", "12:00", "13:00", "17:00", "8"),
array("21292", "24:00", "04:00", "05:00", "09:00", "5"),
array("21293", "15:00", "19:00", "20:00", "24:00", "5"),
array("21311", "08:00", "12:00", "13:00", "17:00", "7"),
array("21291", "08:00", "12:00", "13:00", "17:00", "5")
);
$empty="";
$posID='';
$rowid="1";
$lineid="";
$t="T";
$sep="-";
$sepx=",";
$punch="";
$r=0;
$punchType="";
    for ($a = 0; $a <= $diff; $a++) {
        if($a===0){
            $newDate=$date1->format('Y-m-d');
            }    
        else{
            $y='+1day';
            $date1->modify($y);
            $newDate=$date1->format('Y-m-d');
        }
                
                
    for ($x = 0; $x <= 8; $x++) {
        //Loop through each punch (In, Out, In, Out)
        for ($z = 1; $z <= 4; $z++) {
            $posID='';
            if($punchType=='In'){
               $punchType="Out";
            }
            else{
               $punchType="In";
               if($employees[$x][0]==='21114'){
                   $posID='P-00137';
               }
            }        
            $r = $r + 1;
            $empDST=$employees[$x][5]-$DST;
            $punch=$newDate . $t . $employees[$x][$z].":00" . $sep . "0" . $empDST . ":00";
            $jtr= $sepx .$rowid . $sepx . $r . $sepx .$r. $sepx . $sepx . $employees[$x][0] . ",".$posID . "," . $punch . "," . ",". "," ."," . $punchType;
            echo $jtr . "<br />";

        } 
    }
}
?>
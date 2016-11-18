<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
<script src="js/clock.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>Verify Punch</title>
<script src="../jquery/jquery.js" type="text/javascript"></script>
<script language="JavaScript">
function goodClock() {
    setInterval(function () {toClock()}, 2000);
}
function toClock() {   
    location.href = 'index.php';
}

function loadBadge(x, y){
        $("#badge").attr("value",x);
        $("#pType").attr("value",y);
}
function itemSelect(x,y){
        //s=Selected
        //ns=Select - i.e. Not selected
        var s='img.Selected:eq('+x+')';
        var ns='img.Select:eq('+x+')';
        var id='input.itemSearch:eq('+x+')';
        id=$(id).val();
        if(y===1){
            $('img.Selected').hide();
            $('img.Select').show();
            $(ns).hide();
            $(s).show();
            $("#reason_id").attr("value", id);
    }
    else{
        $('img.Selected').hide();
        $(s).hide();
        $(ns).show();
    }
        
        
}j
function submitPunch(x){
    //x=1 Yes, last punch of shift
    
    if(x===1){
        $(".verify").attr('style', 'display: none');
        $("#frmOut").removeAttr('style');
    }
    else{
        $("#frmVerify").attr('action', 'frmclocked.php');
        $("#frmVerify").submit();
    }
 /*       
    if(x===1){
        //$('#last_punch_table').hide();
        $("#frmVerify").attr('action', 'frmOutReason.php');
        $("#frmVerify").submit();
    }
    else{
        $("#frmVerify").attr('action', 'frmclocked.php');
        $("#frmVerify").submit();
    }
 */
}
function submit_out(){
    $("#frmOut").attr('style', 'display: none');
    $(".verify").removeAttr('style');
    $("#last_punch_table").attr('style', 'display: none');
    $("#last_punch_table_div").attr('style', 'display: none');
    $("#out_reason_div").removeAttr('style');    
    //Show Reason - Make sure that the $out variable has been fed
    $(".final_punch").attr('style', 'display: none');
    $(".submit_punch").removeAttr('style');
    
                
}
function loadTrx(a,b,c,d,e){
    $(".hTransfer").removeAttr('style');
    $("#pType").attr("value", "Transfer");
    $("#badge").attr("value",a);
    $("#pTransfer1").attr("value",b);
    $("#pTransfer2").attr("value",c);
    $("#xferid1").attr("value",d);
    $("#xferid2").attr("value",e);
}
function loadName(a){
    $("#pName").attr("value",a);
}

</script>
<style>
     #rcorners1 {
                border-radius: 25px;
                background: #73AD21;
                padding: 20px; 
                width: 175px;
                height: 100px;
                color: white;
     }
</style>
</head>
<body onload="startTime()" ondragstart="return false">
    <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
            
</body>
</html>

<?php
    require_once 'clk_functions.php';
    $out="Was allowed to take all breaks / meals";
    if (isset($_POST['intempclkid'])){
        $badge=$_POST['intempclkid'];
        $pType=$_POST['pType'];
        $dbconn=getDB();
        lastpunch($dbconn, $badge, 't');
        /*
        if (isset($_POST['hFrom'])){
            if($_POST['hFrom']=='xs'){
                echo '<br /><br /> - xs Called';
                $xferid1=$_POST['hxferid1'];
                $xferlocname1=$_POST['hxferlocname1'];
                $xferid2=$_POST['hxferid2'];
                $xferlocname2=$_POST['hxferlocname2'];
                $badge=$_POST['hBadge'];
                //need js function to be called here
                echo "<script type=\"text/javascript\">loadTrx('".$badge."','".$xferlocname1."','". $xferlocname2 .
                        "','".$xferid1."','".$xferid2." ')</script>";
            }
        }
        */

            echo "<script type=\"text/javascript\">loadBadge('".$badge."','".$pType." ')</script>";
            echo '<br />';
        }

    echo '<br /><br />';
    //used to load name of employee
    empNamePunch($dbconn, $badge);
    //*************************************
    //
    $level=0;
        $db_conn=  getDB();
        $sql = "SELECT reason_id, reason_desc, reason_category FROM out_reason where reason_active='T'";
		$stmt = $db_conn->query($sql);
               if ($stmt->rowCount()){
                $x=0;
                //Start Building Results Table
                echo '<form style="display:none" id="frmOut" name="frmOut" action="" method="post">';
                echo '<table id="box-table-a">';
                echo '<thead><tr><th>&nbsp</th><th scope="col">Select</th><th hidden="true" scope="col">Reaso ID</th><th scope="col">Out Reason</th>
                </tr><tr><th scope="col">&nbsp</th>
                <th><img class="Clear" src="img/clear_1.png" onclick="Clear(1)"/></th>
                <th hidden="true" scope="col">Loc Int ID</th>
                <th scope="col"></th>
                </tr></thead><tbody>';
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td><input hidden='true' class='itemSearch' id='radiox' name='select' value='".$row['reason_id']."'/></td><td><img class='Selected' src='img/selected.png' style='display:none' alt='Selected' onclick='itemSelect(".$x.",2)'/><img id='Select' class='Select' src='img/select.png' alt='Select' onclick='itemSelect(".$x.",1)' />".
                            "<td><b>". $row['reason_desc']. "</b></td></tr>";
                    $x++;
                }
                echo "<tr><td colspan='3'>&nbsp</td></tr>";
                echo "<tr>";
                echo "<td colspan='2'><img class='Submit' src='img/submit.png' alt='Submit' onclick='submit_out()'/><img id='Clearx' class='Clearx' src='img/clear_0.png' alt='Clear' onclick='clear_out()' /></td>".
                            "<td>&nbsp</td></tr>";
                echo "</tbody></table>";
               }
               echo '<input id="reason_id" name="reason_id" /></form>';
               echo '<div id="out_reason_div" style="display:none"><b>Out Reason:</b><p id="rcorners1">'.$out.'<br /><br /></p>';
              
?>
</body>
</html>
    
    

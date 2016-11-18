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

function submitPunch(){
    var x=$("#pType").val();
    if(x.trim()==='Out'){
        alert('-'+ x +'-');
    }
    else{
        $("#frmVerify").attr('action', 'frmclocked.php');
        $("#frmVerify").submit();
    }
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
     
</style>
</head>
<body onload="startTime()" ondragstart="return false">
    <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
            
</body>
</html>

<?php
    require_once 'clk_functions.php';
    require_once 'test_functions.php';
    if (isset($_POST['intempclkid'])){
        $badge=$_POST['intempclkid'];
        $dbconn=getDB();
        $lastpunch_info=lastpunch2($dbconn, $badge);
        echo '<br /><br /><br /><br />Last Punch Info='.$lastpunch_info;
        if($lastpunch_info=="No"){
                punchverify();
                lastpunch_table("N/A", "N/A","N/A");
        }
        elseif($lastpunch_info=="Yes"){
            //repunch function will call punch verify info
            $date1=date_create($row['pdate']);
            $pDate=$date1->format('m-d-Y');
            $time= date("h:i:s A", strtotime($row['pTime']));
            $repunch_restrict=repunch2($row['nowTime'], $row['punch_time'], $pDate, $time, $row['punch_type']);
            if($repunch_restrict="No"){
                    punchverify();
                    lastpunch_table($pDate, $time,$punch_type);
            }
}

            $pType=$_POST['pType'];
            echo "<script type=\"text/javascript\">loadBadge('".$badge."','".$pType."')</script>";
            echo '<br />';
}

    echo '<br /><br />';
    //used to load name of employee
    empNamePunch($dbconn, $badge);
     
    
    

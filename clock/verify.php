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
    if (isset($_POST['intempclkid'])){
        $badge=$_POST['intempclkid'];
        $dbconn=getDB();
        lastpunch($dbconn, $badge, 'f');
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
            $pType=$_POST['pType'];
            echo "<script type=\"text/javascript\">loadBadge('".$badge."','".$pType."')</script>";
            echo '<br />';
        }

    echo '<br /><br />';
    //used to load name of employee
    empNamePunch($dbconn, $badge);
     
    
    

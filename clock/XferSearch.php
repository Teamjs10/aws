<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
<link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="../jquery/jquery.js" type="text/javascript"></script>
<script src="js/jtrscript.js" type="text/javascript"></script>
<script language="JavaScript">
function toXfer(){
        $("#myHiddenForm").submit();
    }
function loadBadge(x){
    $("#hBadge").attr("value",x);
}
function itemSelect(x,l){
        var d=document.forms[l];
        //value stored
        var v='input.itemSearch:eq('+x+')';
        var i='img.itemImg:eq('+x+')';
        var s='img.Selected:eq('+x+')';
        $('img.Selected', d).hide();
        $('img.itemImg', d).show();
        //itemImg in the context of form=d
        $(i,d).hide();
        $(s,d).show();
        var str=$(v, d).val();
        var myArray = str.split('|'); //explode
        $('.selID', d).attr("value",myArray[1]);
        $('.selValue', d).attr("value",myArray[2]);
        
        switch (l){
                 case 0: 
                    $("#hxferid1").attr('value', myArray[1]);
                    $("#hxferlocname1").attr('value', myArray[2]);
                    break;
                case 1: 
                    $("#hxferid2").attr('value', myArray[1]);
                    $("#hxferlocname2").attr('value', myArray[2]);
                    break;
                default : 
                    alert(l);
                }
}

function itemCount(){
    alert ($('.itemSearch').size());
    var str = '123|45|789';
    alert (str.substr(0,2));
    var myArray = str.split('|'); //explode
    alert (myArray[2]);
//This is all correct
}
function Clear(l){
    var d=document.forms[l];
    $('.selValue', d).attr("value","");
    $('img.Selected', d).hide();
    $('img.itemImg', d).show();
    switch (l){
                 case 0: 
                    $("#hxferid1").attr('value', "");
                    $("#hxferlocname1").attr('value', "");
                    break;
                case 1: 
                    $("#hxferid2").attr('value', "");
                    $("#hxferlocname2").attr('value', "");
                    break;
                default : 
                    alert(l);
                }
}

   
 </script>
<title>Transfer Search</title>
    </head>
    <body><br />
    
    <br />
        <?php
        session_start();
        require_once 'clk_functions.php';
        //require_once 'dbset.php';

        //$asites=array('employee.php', 'startinc.php');
        //refer($_SERVER, $asites); 
        $transfer1=$_POST['transfer1']; //not know when search is loaded
        $transfer2=$_POST['transfer2'];
        
        $db_conn=  getDB();
        //echo '<form action="" method="post" id="xfersearch" name="xfersearch">';
        if($transfer1<>""){
            xferlist($db_conn, $transfer1, 1);
        }
        
        if($transfer2<>""){
            xferlist($db_conn, $transfer2, 2);
        }
        //echo '</form>';
        ?>
        <form action="verify.php" method="post" name="myHiddenForm" id="myHiddenForm">
                <input type="hidden" id="hxferid1" name="hxferid1" />
                <input type="hidden" id="hxferlocname1" name="hxferlocname1" />
                <input type="hidden" id="hxferid2" name="hxferid2" />
                <input type="hidden" id="hxferlocname2" name="hxferlocname2" />
                <input type="hidden" id="hBadge" name="hBadge"  size="20" maxlength="11" tabindex="1" />
                <input type="hidden" name="hFrom" id="hFrom" value="xs" />
                <img id="Submit" src="img/submit.png" onclick="toXfer()" alt="Submit">
            </form>
    <?php      
        if (isset($_POST['hBadge'])){
            $badge=$_POST['hBadge'];
            echo "<script type=\"text/javascript\">loadBadge('".$badge."')</script>";
    }
    
    ?>
    </body>
</html>


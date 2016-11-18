<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
<link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="..img/favicon.ico">
<script src="../jquery/jquery.js" type="text/javascript"></script>
<script src="js/jtrscript.js" type="text/javascript"></script>
<script src="js/clock.js" type="text/javascript"></script>
<script language="JavaScript">
function loadBadge(x){
    
    $("#badge").attr("value",x);
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
                    //alert(l);
                }
}
function submit_out(){
                
    $("#frmOut").attr('action', 'frmclocked.php');
    $("#frmOut").submit();
                
}
   
 </script>
<title>Out Reason</title>
    </head>
        <body onload="startTime()" ondragstart="return false">
    <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
    
   <br /><br /><br />

        <?php
        session_start();
        require_once 'clk_functions.php';
        //$asites=array('employee.php', 'startinc.php');
        //refer($_SERVER, $asites); 
        //$transfer1=$_POST['transfer1']; //not know when search is loaded
        //$transfer2=$_POST['transfer2'];
        $badge=$_POST['badge'];
        $level=0;
        $db_conn=  getDB();
        $sql = "SELECT reason_id, reason_desc, reason_category FROM out_reason where reason_active='T'";
		$stmt = $db_conn->query($sql);
               if ($stmt->rowCount()){
                $x=0;
                //Start Building Results Table
                echo '<form style="display: none" id="frmOut" name="frmOut" action="" method="post">';
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
               echo '<input style="display:none" id="reason_id" name="reason_id" /><input style="display:none" id="pType" name="pType" value="Out" />'
               . '<input id="badge" name="badge" /></form>';
               echo "<script type=\"text/javascript\">loadBadge('".$badge."')</script>";
        ?>
        
    </body>
</html>


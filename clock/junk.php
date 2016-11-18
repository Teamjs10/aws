    <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
        <script src="../jquery/jquery.js" type="text/javascript"></script>

        <title>Total Junk</title>
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
        <script language="JavaScript">

function loadTextBtn(){
         alert('got here');
        $("#rcorners1").text("Was allowed to take all breaks / meals");
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
        </script>
    
    </head>
    <body>
        <?php
        require_once 'clk_functions.php';
        echo '<br><br><br>This is Test Return:<br>';
        $r=  test_return('X');
        echo '<br><br><br>these are the results:<br>';
        print_r($r);
        echo "<br><br><br> - This is result 2,0:";
        echo $r[2][0];
        
        
        
        echo '<br><br><br>This is time:<br>';
        echo time()."<br /><br />";
        //$week_start = date('m-d-Y h:i:s', time());
        $week_now = date('m/d/Y', time());
        echo 'This is today- '.$week_now . '<br />';
        $startweek='';
        echo '<br /><br /><br />';
        $d=$week_now;
        echo $d.' - this is Date<br />';
        
        $d=  strtotime($week_now);
        
        //echo $d . ' - this is d in mmddyy format<br />';
        //$d=  strtotime('2016/9/14');
        //echo $d . ' - this is d in yymmdd format<br />';
        
        $day = date('w', $d);
        echo $day . ' - This is Day - w<br />';
        if ($day<>0){
            
            $startweek=$d-($day*86400);
            echo $startweek.' - this is calculated start week<br /><br />';
        }
        else{
            $startweek=$d;
            echo 'today is Sunday!<br /><br />';
            $week_start = date('m-d-Y h:i:s', $d);
            echo 'today is Sunday! - '.$week_start.'<br /><br />';
            echo 'This is d - '.$d. '<br /><br />';
        }
        echo '<br /><br />This is start of last week'. date('m-d-Y h:i:s', $d-604800);
        /*
        switch ($day) {
            case 0:
                $startweek=$d;
            break;
            case 1:
                $startweek=$d-86400;
            break;
            case 2:
                $startweek=$d-172800;
            break;
            case 3:
                $startweek=$d-259200;
            break;
            case 4:
                $startweek=$d-345600;
            break;
            case 5:
                $startweek=$d-432000;
            break;
            case 6:
                $startweek=$d-518400;
            break;
            default:
                break;
}
*/

       
        /*
        $week_start = date('m-d-Y', strtotime('-'.(1-$day).' days'));
        $week_end = date('m-d-Y', strtotime('+'.(7-$day).' days'));
        echo 'This is Week Start - '.$week_start . '<br />';
        echo 'This is Week end - '.$week_end;
        */

        
        echo getClientIP();
       $jtr=  array(1,2,3);
       echo '<br />Before:<br />';
       print_r($jtr);
        
    //re-declaring the arry may not be needed
        $jtr=resetArray($jtr);
        array_push($jtr, 9,10,11);
        echo '<br />After:<br />';
        print_r($jtr);
        unset($jtr);
        $pdate='2/10/1964';
        $punchtime='7:00 AM';
        $punchtype="In";
        
        echo '<div><b>Out Reason:</b><p id="rcorners1">Junk</p>';
        echo '<br /><br />';
        echo '<table id="last_punch_table" name="last_punch_table">
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
        
            </table>';
        echo "<br />";
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
        <tr>
            <td colspan="2">Is this your <b><i>Final Punch</i></b> of your day/work shift?</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp</td>
        </tr>
        <tr>
            <td><img src="img/yes_red_1.png" style="display:none" alt="Submit" onclick="submitPunch()" />
            <img id="cancel" src="img/no_red_1.png" alt="Cancel" onclick="loadTextBtn()" /></td>
        </tr>
        </table>
        	</div>
		</form>';
      
        ?>
    </body>
</html>

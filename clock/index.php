<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
<script src="js/clock.js" type="text/javascript"></script>
<script src="../jquery/jquery.js" type="text/javascript"></script>
<link rel="shortcut icon" href="..img/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>EyerishSoft</title>
<script language="JavaScript">

            function updateEmpID(x){
                var enter="Enter Emp ID";
                if (enter == $("#intempclkid").val()){
                  var y="";
                  $("#intempclkid").attr("value", y);
                };
                var z=$("#intempclkid").val();
                z=z.concat(x);
                $("#intempclkid").attr("value", z);  
             }1
             function clearEmpID(){
                var enter="Enter Emp ID";
                $("#intempclkid").attr("value", enter); 
             }
             function backEmpID(){
                var x=$("#intempclkid").val();
                var y=x.length -1;
                x= x.substr(0, y);
                $("#intempclkid").attr("value", x); 
             }
            function verifyPunch(a){
                var z=$("#intempclkid").val();
                if (z=="" || z=="Enter Emp ID"){
                    alert("Empty")}
                else{
                    
                var ptype;
                switch (a) {
                    case 1: ptype = 'In';break; 
                    case 2: ptype = 'Out';break;
                    case 3: ptype = 'Meal';break;
                    case 4: ptype = 'Xfer';break;
                    case 5: ptype = 'History';break;
                    default: ptype = 'unknown';
                }
                  
                
                $("#pType").attr("value", ptype);
                }
                
                switch (ptype){
                 case "Xfer": 
                    $("#frmClock").attr('action', 'xfer.php');
                    $("#frmClock").submit();
                    break;
                case "History": 
                    $("#frmClock").attr('action', 'viewPunch.php');
                    $("#frmClock").submit();
                    break;
                case "Out":
                    $("#frmClock").attr('action', 'verify_out.php');
                    $("#frmClock").submit();
                    break;
                default : 
                    $("#frmClock").attr('action', 'verify_test.php');
                    $("#frmClock").submit();
                }                
           }
           function supv(){
               $("#frmClock").attr('action', 'choosegang.php');
               $("#frmClock").submit();
           }
           function fixpunch(){
               $("#frmClock").attr('action', 'fixpunch.php');
               $("#frmClock").submit();
           }
            function moreClock(){
               $(".more").removeAttr('style');
               $("#moreImg").attr('style', 'display: none');
           }
           function lessClock(){
                $("#moreImg").removeAttr('style');
                $(".more").attr('style', 'display: none');
           }
           function home(){
                window.location = "index.htm";
            }

             
</script>
</head>
<?php
    require_once 'clk_functions.php';
    checksession();
?>
<body onload="startTime()" ondragstart="return false">
    <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
                                        
<form action="" method="post" id="frmClock" name="frmClock">
    <div class="tdTable"><table id="hideHead" align="center" width="300">
        <tr>
            <td colspan="4">
                <label class="tdLabel" for="pDayDate">Date:</label>
                <input class="formInputText" type="text" name="pDayDate" id="pDayDate" size="20" maxlength="11" tabindex="1" readonly="true" />
            </td>
            
        </tr>
        <tr>
            <td colspan="4">
                <label for="pTimeActual" class="tdLabel">Time:</label>
                <input class="formInputText" type="text" name="pTime" id="pTime" readonly="true" size="20" maxlength="11" tabindex="1" />
            </td>
        </tr>
        <tr>    
            <td colspan="4">
    
    <label class="tdLabel" for="txtempid">Emp ID:</label>
    <input class="formInputText" type="text" name="intempclkid" id="intempclkid" value="Enter Emp ID" size="20" maxlength="11" tabindex="1" onfocus="clearField(this);"/>
            </td>
        </tr>
          <tr>    
            <td colspan="4">
    
    <label class="tdLabel" for="txtLocX">Location:</label>
    <input class="formInputText" type="text" name="txtLocX" id="txtLocX" readonly="true" value="La Canada Office" size="20" readonly="true" maxlength="11" tabindex="1" onfocus="clearField(this);"/>
            </td>
        </tr>
    </table>
        </div>
<!-- 
********************** End Clock Head ****************************************
-->
<div class="tdKeys">
    <table align="center" id="showme" width="300" border="0" cellpadding="4" cellspacing="4">
  <tr align="center">
      <td><img src="img/1_1.png" alt="1" onclick="updateEmpID(1)" /></td>
	
      <td><img src="img/2_1.png" alt="2" onclick="updateEmpID(2)"/></td>
	
    <td><img src="img/3_1.png" alt="3" onclick="updateEmpID(3)" /></td>
    <td>&nbsp;</td>
    <td class="more" style="display: none"><img src="img/meal.png" alt="3" onclick="verifyPunch(3)" /></td>
  </tr>
  <tr align="center">
      <td><img src="img/4_1.png" alt="4" onclick="updateEmpID(4)"  /></td>
	
    <td><img src="img/5_1.png"  alt="5" onclick="updateEmpID(5)" /></td>
	
    <td><img src="img/6_1.png" alt="6" onclick="updateEmpID(6)" /></td>
    <td>&nbsp;</td>
    <td class="more" style="display: none"><img src="img/view.png" alt="3" onclick="verifyPunch(5)" /></td>
  </tr>
    <tr align="center">
        <td><img src="img/7_1.png" alt="7" onclick="updateEmpID(7)"  /></td>
	
    <td><img src="img/8_1.png" alt="8" onclick="updateEmpID(8)"  /></td>
	
    <td><img src="img/9_1.png" alt="9"  onclick="updateEmpID(9)"/></td>
    <td>&nbsp;</td>
    <td class="more" style="display: none"><img src="img/dept.png" alt="3" onclick="verifyPunch(4)" /></td>
  </tr>
    <tr align="center">
        <td><img src="img/clear_1.png" alt="In" onclick="clearEmpID()"  /></td>

    <td><img src="img/0_1.png" alt="0" onclick="updateEmpID(0)" /></td>

    <td><img src="img/back_1.png" alt="Out" onclick="backEmpID()"  /></td>
    <td>&nbsp;</td>
    <td class="more" style="display: none"><img src="img/fix.png" alt="3" onclick="fixpunch()" /></td>
  </tr>
  <tr align="center">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="more" style="display: none">&nbsp;</td>
  </tr>
<!-- 
********************** End Clock ****************************************

********************** In / Out *****************************************

-->
  <tr align="center">
      <td><img src="img/in.png" alt="In" onclick="verifyPunch(1)" /></td>
	
      <td><img id="moreImg" src="img/more.png" alt="More" onclick="moreClock()" /><img class="more" style="display: none" src="img/less.png" alt="More" onclick="lessClock()" /></td>
	
    <td><img src="img/out.png" alt="Out" onclick="verifyPunch(2)" /></td>
    <td>&nbsp;</td>
    <td class="more" style="display: none"><img src="img/supv.png" alt="3" onclick="supv()" /></td>
  </tr>
  <tr>
      <td colspan="2" style="display: none"><input type="text" name="pUTime" id="pUTime" /><</td>
      <td colspan="1" style="display: none"><input type="text" name="hDept" id="hDept" /><</td>
      <td colspan="1" style="display: none"><input type="text" name="hFrom" id="hFrom" value="I" /><</td>
  </tr>
</table>
    </div>
 <!-- 
 ***************************************************************
 ***                                ***************** Display Punch ****************************
 ***************************************************************
-->
    <div style="display:none">
         
         <input type="text" name="pType" id="pType" size="20" maxlength="11" tabindex="1" />
    </div>


</form>
                                                                                                                                    
<?php
        require_once 'clk_functions.php';
        if(isset($_POST['hFrom'])){
        if ($_POST['hFrom']<>""){
        $x=$_POST['hFrom'];
        
        echo "<script type=\"text/javascript\">startTime()</script>";
      
        }
        
    }
    
        
    
        ?>
</body>
    </html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>Transfer</title>
<link rel="stylesheet" type="text/css" href="css/formx.css" media="screen">
<style>
            #errorbox {
                margin-left:auto;
                margin-right:auto;
                background-color: yellow;
                text-align:left;
                display: none;
                width: 30%;
            }
</style>
<script src="../jquery/jquery.js" type="text/javascript"></script>
<script src="../jquery/jquery.validate.js"></script>
<script src="js/clock.js" type="text/javascript"></script>
<script language="JavaScript">
$(document).ready(function(){
             $("#bClear").click(function(){
                window.location = "index.php";
            });
        });
function sXfer(a){
    $("#hTransfer").attr("value", a);
    $("#xfer").attr('action', 'frmXferSearch.php');
    $("#xfer").submit();
}

function fromSearch(x,y,a,b){
    $("#hTransfer1ID").attr("value", x);
    $("#transfer1").attr("value", y);
    $("#hTransfer2ID").attr("value", a);
    $("#transfer2").attr("value", b);
}

</script>
</head>
<body>
 <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
<form class="styleform" action="" method="post" id="xfer" name="xfer">
    <h1>Transfer</h1>
<table>
<tbody>
<tr>

    <td><div><label for="transfer1">Transfer 1:</label>
<input class="field required" name="transfer1" id="transfer1" size="25" maxlength="25" tabindex="2" type="text">
        </div></td>
        <td><input style="display: none" name="hTransfer1ID" id="hTransfer1ID" /></td>
</tr>
<tr>

    <td><div><label for="transfer2">Transfer 2:</label>
<input class="field required" name="transfer2" id="transfer2" size="25" maxlength="25" tabindex="2" type="text">
        </div></td>
        <td>&nbsp;</td>
</tr>

</tbody>
</table>

<table border="0" cellpadding="4" cellspacing="0" width="500">
<tbody>
<tr>
    <td colspan="3"><br /><img id="Search" src="img/search_1.png" alt="Search" onclick="sXfer(1)"><img id="bClear" src="img/clear_1.png" alt="Clear"></td>
</tr>
<tr>
    <td colspan="2" style="display: none"><input type="text" name="hTransfer" id="hTransfer" size="20" maxlength="11" tabindex="1" />
    <input type="text" name="hBadge" id="hBadge" size="20" maxlength="11" tabindex="1" /></td>
</tr>
</tbody>
</table>
</form>

<?php
    require_once 'clk_functions.php';
    //require_once 'dbset.php';
    if (isset($_POST['intempclkid'])){
        $badge=$_POST['intempclkid'];
        echo "<script type=\"text/javascript\">loadBadge('".$badge."')</script>";
    }
         ?>
     
</body></html>
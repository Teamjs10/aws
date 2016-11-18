<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<html>
    <head>
<link rel="stylesheet" type="text/css" href="form.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Clock Transfer</title>
<script language="JavaScript">
    function updateForm(){

        document.forms("myFormDept").intempid1.value = <?php echo $_POST['hempid'] ?>;
    }
</script>
    </head>
    <body onload="updateForm()">
    <div align="center">PunchTime</div>
<div align="center">Clock Transfer</div>

	  <h3>Transfer Info</h3>
        <form action="frmclocked.php" method="post" name="myFormDept">
            <fieldset>
            <legend>Time Clock Transfer</legend>
            <label for="txtempid">Emp ID:</label>
            <input class="formInputText" type="text" readonly="true" name="intempid1" id="intempid" size="20" maxlength="11" tabindex="1" /><br />
            <label for="txtclkll1">Labor Entry 1:</label>
            <input class="formInputText" type="text" name="txtclkll1" id="txtLL1" size="20" maxlength="11" tabindex="2" /><br />
            <label for="txtclkll2">Labor Entry 2:</label>
            <input class="formInputText" type="text" name="txtclkll2" id="txtclkll2" size="20" maxlength="11" tabindex="3" /><br />
            <label for="txtclkll3">Labor Entry 3:</label>
            <input class="formInputText" type="text" name="txtclkll3" id="txtclkll3" size="20" maxlength="11" tabindex="4" /><br />
            <label for="txtclkll4">Labor Entry 4:</label>
            <input class="formInputText" type="text" name="txtclkll4" id="txtclkll4" size="20" maxlength="11" tabindex="5" /><br />
            <label for="txtclkll5">Labor Entry 5:</label>
            <input class="formInputText" type="text" name="txtclkll5" id="txtclkll5" size="20" maxlength="11" tabindex="6" /><br />
            <label for="txtclkll6">Labor Entry 6:</label>
            <input class="formInputText" type="text" name="txtclkll6" id="txtclkll6" size="20" maxlength="11" tabindex="7" /><br />
            <br />
            <table width="300" border="0" cellpadding="4" cellspacing="4">
                <tr>
                    <td><img src="IN_1.png" alt="In" onclick="submitForm('IN')"  /></td>
                </tr>
            </table>

            </fieldset>
         </form>
    </body>
</html>
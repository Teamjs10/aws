<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<html>
    <head>
<link rel="stylesheet" type="text/css" href="form.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Employee Master</title>
<script language="JavaScript">
function submitForm(){
        document.forms('empmstr').action="frmempupdate.php";
        document.forms('empmstr').submit();
    }
 function submitSearch(){
        document.forms('empmstr').action="frmempsearch.php";
        document.forms('empmstr').submit();
    }
</script>
    </head>
    <body>
        <br /><br />
        <div align="center">ESaaS</div>
<div align="center">Employee Master</div>
<br /><br />
    <form action="" method="post" name="empmstr">
        
    <fieldset>
            <legend>Employee Info</legend>
            <label for="txtempid">Emp ID:</label>
            <input class="formInputText" type="text" readonly="true" name="intempid1" id="intempid" size="20" maxlength="11" tabindex="1" /><br />
            <label for="intempclkid">Clock ID:</label>
            <input class="formInputText" type="text" name="intempclkid" id="intempclkid" size="20" maxlength="10" tabindex="2" /><br />
            <label for="txtempfname">First Name:</label>
            <input class="formInputText" type="text" name="txtempfname" id="txtempfname" size="30" maxlength="30" tabindex="3" /><br />
            <label for="txtemplname">Last Name:</label>
            <input class="formInputText" type="text" name="txtemplname" id="txtemplname" size="30" maxlength="30" tabindex="4" /><br />
            <label for="txtsupv">Supervisor:</label>
            <input class="formInputText" type="text" name="intsupvid" id="intsupvid" size="30" maxlength="30" tabindex="5" /><br />
            <label for="bolempactive">Active?:</label>
            <input class="formInputText" type="checkbox" checked="true" name="bolactive" id="bolactive"  tabindex="6" /><br />
            <label for="dateempdeactive">Deactive Date:</label>
            <input class="formInputText" type="text" name="dateempdeactive" id="dateempdeactive" size="20" maxlength="10" tabindex="7" /><br />
            <label for="intemptimezone">Time Zone:</label>
            <select name="intemptimezone">
                <option value="1">Pacific</option>
                <option value="2">Arizona</option>
                <option value="3">Mountain</option>
                <option value="4">Central</option>
                <option value="5">Eastern</option>
                <option></option>
            </select>
                <table width="300" border="0" cellpadding="4" cellspacing="4">
                <tr>
                    <td><img src="update_1.png" alt="In" onclick="submitForm()"  /></td>
                    <td><img src="search_1.png" alt="Search" onclick="submitSearch()" /></td>
                </tr>
            </table>

            </fieldset>
          
         </form>
    </body>
</html>